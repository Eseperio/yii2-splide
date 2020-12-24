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
    public $mainSliderConfig = [];
    /**
     * @var array
     */
    public $thumbnailSliderConfig = [];
    /**
     * @var string
     */
    private $mainSliderHtml = "";
    /**
     * @var string
     */
    private $thumbnailSliderHtml = "";

    /**
     * @return string|string[]|null
     * @throws \Exception
     */
    public function run()
    {

        $mainSliderId = $this->id . "_main";
        $this->mainSliderConfig= array_merge_recursive($this->mainSliderConfig,[
            'pagination' => false,
            'arrows' => false,
            'heightRatio' => 0.66666667,
            'cover'=> true,
            'id'=> $mainSliderId
        ]);

        $secondarySliderId = $this->id . "_secondary";

        $this->thumbnailSliderConfig= array_merge_recursive($this->thumbnailSliderConfig,[
            'fixedWidth' => 100,
            'height' => 60,
            'gap' => 10,
            'cover' => true,
            'isNavigation' => true,
            'focus' => 'center',
            'rewind' => true,
            'pagination' => false,
            'id'=> $secondarySliderId
        ]);

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

    /**
     * @param $section
     * @return string
     */
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

    /**
     * @return string
     */
    private function renderMainSlider()
    {
        return $this->mainSliderHtml;
    }

    /**
     * @return string
     */
    private function renderThumbnailSlider()
    {
        return $this->thumbnailSliderHtml;
    }
}
