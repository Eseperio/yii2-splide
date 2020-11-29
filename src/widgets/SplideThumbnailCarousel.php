<?php


namespace eseperio\splide\widgets;


use yii\base\Widget;

/**
 *
 * @package eseperio\splide\widgets
 */
class SplideThumbnailCarousel extends Widget
{

    /**
     * @var string
     */
    public static $autoIdPrefix = 'splide_thumbnail';
    /**
     * @var string
     */
    public $layout = "{slider}</br>{thumbnails}";
    /**
     * @see Splide::$items
     * @var array
     */
    public $items = [];
    /**
     * @var array
     */
    public $mainSliderConfig = [
        'pagination' => false,
        'arrows' => false,
        'heightRatio' => 0.66666667,
        'cover'=> true
    ];
    /**
     * @var array
     */
    public $thumbnailSliderConfig = [
        'fixedWidth' => 100,
        'height' => 60,
        'gap' => 10,
        'cover' => true,
        'isNavigation' => true,
        'focus' => 'center',
        'rewind' => true,
        'pagination' => false
    ];
    private $mainSliderHtml = "";
    private $thumbnailSliderHtml = "";

    public function run()
    {

        $mainSliderId = $this->id . "_main";
        $this->mainSliderConfig['id'] = $mainSliderId;
        $secondarySliderId = $this->id . "_secondary";
        $this->thumbnailSliderConfig['id'] = $secondarySliderId;

        $this->mainSliderConfig['syncWith'] = $secondarySliderId;
        $this->mainSliderConfig['items'] = $this->thumbnailSliderConfig['items'] = $this->items;
        /**
         * Due to Splide sync mode requirements we need to render first the thumbnails slider
         */
        $this->thumbnailSliderHtml = Splide::widget($this->thumbnailSliderConfig);
        $this->mainSliderHtml = Splide::widget($this->mainSliderConfig);

        $content = preg_replace_callback('/{\\w+}/', function ($matches) {
            $content = $this->renderSection($matches[0]);

            return $content === false ? $matches[0] : $content;
        }, $this->layout);

        return $content;


    }

    private function renderSection($section)
    {

        switch ($section) {
            case '{slider}':
                return $this->renderMainSlider();
                break;
            case '{thumbnails}':
                return $this->renderThumbnailSlider();
                break;
        }
    }

    private function renderMainSlider()
    {
        return $this->mainSliderHtml;
    }

    private function renderThumbnailSlider()
    {
        return $this->thumbnailSliderHtml;
    }
}
