<?php


namespace eseperio\splide\widgets;


use eseperio\admintheme\helpers\Html;
use eseperio\proshop\common\helpers\ArrayHelper;
use eseperio\splide\assets\SplideAsset;
use yii\base\NotSupportedException;
use yii\base\Widget;
use yii\helpers\Json;

/**
 * Class Splide
 * @package eseperio\splide\widgets
 */
class Splide extends Widget
{

    /**
     *
     */
    const TYPE_VIDEO = 1;
    const TYPE_IMAGE = 2;
    const TYPE_GRID = 3;
    const TYPE_HTML = 4;
    public static $autoIdPrefix = 'splide';
    /**
     * Colecction of items to be rendered.
     * ```PHP
     *   $items = [
     *      [
     *          'url' => 'http://someurl.com/image.jpg'
     *      ],
     *      [
     *          'url' => ['some/yii2urlformat', 'param1' => 'example']
     *      ],
     *      [
     *          'type'=> Splide::TYPE_VIDEO,
     *          'url'=> 'http://youtube.com/xxxxxxxx',
     *          'poster'=> 'http://posterurl' // Optional. Can be in yii2 url format
     *      ]
     *  ];
     * ```
     *
     * @var array
     */
    public $items = [];
    /**
     * @var string|null Used to sync sliders. Set with the id of the splide you want to link. See Splide sliders syncing
     */
    public $syncWith;
    /**
     * @var bool Defaults to `true`. Whether call mount on slider. Set to false in primary slider when syncing sliders
     */
    public $mount = true;
    /**
     * Determine a slider type.
     **/
    public $type;

    /**
     * Whether to rewind a slider before the first slide or after the last one.
     **/
    public $rewind;

    /**
     * Transition speed in milliseconds.
     **/
    public $speed;

    /**
     * Transition speed on rewind in milliseconds.
     **/
    public $rewindSpeed;

    /**
     * Whether to prevent any actions while a slider is transitioning.
     **/
    public $waitForTransition;

    /**
     * Define slider max width.
     **/
    public $width;

    /**
     * Define slider height.
     **/
    public $height;

    /**
     * Fix width of slides.
     **/
    public $fixedWidth;

    /**
     * Fix height of slides.
     **/
    public $fixedHeight;

    /**
     * Determine height of slides by ratio to a slider width.
     **/
    public $heightRatio;

    /**
     * If true, slide width will be determined by the element width itself. This is for a horizontal slider.
     **/
    public $autoWidth;

    /**
     * If true, slide height will be determined by the element height itself. This is for a vertical slider.
     **/
    public $autoHeight;

    /**
     * Determine how many slides should be displayed per page.
     **/
    public $perPage;

    /**
     * Determine how many slides should be moved when a slider goes to next or previous page.
     **/
    public $perMove;

    /**
     * Manually determine how many clones should be generated on one side.
     **/
    public $clones;

    /**
     * Start index.
     **/
    public $start;

    /**
     * Determine which slide should be focused.
     **/
    public $focus;

    /**
     * Gap between slides.
     **/
    public $gap;

    /**
     * Set padding-left/right in horizontal mode or padding-top/bottom in vertical one.
     **/
    public $padding;

    /**
     * Animation timing function for CSS transition.
     **/
    public $easing;

    /**
     * Whether to append arrows.
     **/
    public $arrows;

    /**
     * Change the arrow SVG path.
     **/
    public $arrowPath;

    /**
     * Whether to append pagination(indicator dots).
     **/
    public $pagination;

    /**
     * Whether to enable autoplay.
     **/
    public $autoplay;

    /**
     * Autoplay interval in milliseconds.
     **/
    public $interval;

    /**
     * Whether to stop autoplay while a slider is hovered.
     **/
    public $pauseOnHover;

    /**
     * Whether to stop autoplay while a slider elements are focused.
     **/
    public $pauseOnFocus;

    /**
     * Whether to reset progress of the autoplay timer when resumed.
     **/
    public $resetProgress;

    /**
     * Enable lazy load for images.
     **/
    public $lazyLoad;

    /**
     * Determine how many pages around an active slide should be loaded beforehand. This only works the lazyLoad option
     * is “nearby”.
     **/
    public $preloadPages;

    /**
     * Whether to control a slider via keyboard.
     **/
    public $keyboard;

    /**
     * Whether to allow mouse drag and touch swipe.
     **/
    public $drag;

    /**
     * The angle threshold for drag.
     **/
    public $dragAngleThreshold;

    /**
     * Distance threshold for determining if the action is “flick” or “swipe”.
     **/
    public $swipeDistanceThreshold;

    /**
     * Velocity threshold for determining if the action is “flick” or “swipe”.
     **/
    public $flickVelocityThreshold;

    /**
     * Determine power of flick. The larger number this is, the farther a slider runs by flick.
     **/
    public $flickPower;

    /**
     * Limit a number of pages to move by flick.
     **/
    public $flickMaxPages;

    /**
     * Slider direction.
     **/
    public $direction;

    /**
     * Whether to convert an img src to background-image of its parent element. height, fixedHeight or heightRatio is
     * required. public
     **/
    public $cover;

    /**
     * Whether to enable accessibility(aria and screen reader texts) or not.
     **/
    public $accessibility;

    /**
     * Whether to add tabindex = ”0″ to visible slides or not.
     **/
    public $slideFocus;

    /**
     * Determine if a slider is navigation for another.
     **/
    public $isNavigation;

    /**
     * Whether to trim spaces before the first slide or after the last one.
     **/
    public $trimSpace;

    /**
     * If true, is-active class added to the slide element before transition.
     **/
    public $updateOnMove;

    /**
     * Throttle duration for the resize event.
     **/
    public $throttle;

    /**
     * Breakpoints definitions.
     **/
    public $breakpoints;

    /**
     * Collection of class names.
     **/
    public $classes;

    /**
     * Collection of texts for i18n.
     **/
    public $i18n;
    /**
     * @var array options for slider main container
     */
    public $containerOptions = [];

    /**
     * @return string
     * @throws NotSupportedException
     */
    public function run()
    {
        $this->registerClientScript();
        Html::addCssClass($this->containerOptions,'splide');
        $containerOptions = array_merge_recursive($this->containerOptions, [
            'id' => $this->id,
        ]);
        $html = Html::beginTag('div', $containerOptions) . PHP_EOL;

        $html .= $this->renderItems();
        $html .= Html::endTag('div');

        return $html;

    }

    /**
     * Registers the needed JavaScript.
     * @since 2.0.8
     */
    public function registerClientScript()
    {
        $this->getView()->registerAssetBundle(SplideAsset::class);
        $params = [
            'type' => $this->type,
            'rewind' => $this->rewind,
            'speed' => $this->speed,
            'rewindSpeed' => $this->rewindSpeed,
            'waitForTransition' => $this->waitForTransition,
            'width' => $this->width,
            'height' => $this->height,
            'fixedWidth' => $this->fixedWidth,
            'fixedHeight' => $this->fixedHeight,
            'heightRatio' => $this->heightRatio,
            'autoWidth' => $this->autoWidth,
            'autoHeight' => $this->autoHeight,
            'perPage' => $this->perPage,
            'perMove' => $this->perMove,
            'clones' => $this->clones,
            'start' => $this->start,
            'focus' => $this->focus,
            'gap' => $this->gap,
            'padding' => $this->padding,
            'easing' => $this->easing,
            'arrows' => $this->arrows,
            'arrowPath' => $this->arrowPath,
            'pagination' => $this->pagination,
            'autoplay' => $this->autoplay, 'interval' => $this->interval,
            'pauseOnHover' => $this->pauseOnHover,
            'pauseOnFocus' => $this->pauseOnFocus,
            'resetProgress' => $this->resetProgress,
            'lazyLoad' => $this->lazyLoad,
            'preloadPages' => $this->preloadPages,
            'keyboard' => $this->keyboard,
            'drag' => $this->drag,
            'dragAngleThreshold' => $this->dragAngleThreshold,
            'swipeDistanceThreshold' => $this->swipeDistanceThreshold,
            'flickVelocityThreshold' => $this->flickVelocityThreshold,
            'flickPower' => $this->flickPower,
            'flickMaxPages' => $this->flickMaxPages,
            'direction' => $this->direction,
            'cover' => $this->cover,
            'accessibility' => $this->accessibility,
            'slideFocus' => $this->slideFocus,
            'isNavigation' => $this->isNavigation,
            'trimSpace' => $this->trimSpace,
            'updateOnMove' => $this->updateOnMove,
            'throttle' => $this->throttle,
            'breakpoints' => $this->breakpoints,
            'classes' => $this->classes,
            'i18n' => $this->i18n
        ];
        $paramsWithValue = array_filter($params, function ($value) {
            return !is_null($value);
        });
        $options = Json::encode($paramsWithValue);
        $link = "";
        if (!empty($this->syncWith))
            $link = ".sync({$this->syncWith})";

        $mount = $this->mount ? ".mount()" : "";
        $this->getView()->registerJs("var {$this->id} = new Splide('#{$this->id}',$options){$link}{$mount}");
    }

    /**
     * @return string
     * @throws NotSupportedException
     */
    private function renderItems()
    {
        $html = Html::beginTag('div', ['class' => 'splide__track']) . PHP_EOL;
        $html .= Html::beginTag('ul', ['class' => 'splide__list']) . PHP_EOL;

        foreach ($this->items as $item) {

            $html .= Html::tag('li', $this->renderItem($item), ['class' => 'splide__slide']) . PHP_EOL;

        }

        $html .= Html::endTag('ul');
        $html .= Html::endTag('div');

        return $html;
    }

    /**
     * @param $item
     * @param string $html
     * @return string|null
     * @throws NotSupportedException
     */
    private function renderItem($item)
    {

        if (!isset($item['type']) || $item['type'] == self::TYPE_IMAGE) {
            return Html::img(ArrayHelper::getValue($item, 'url'));
        } else {
            switch ($item['type']) {
                case self::TYPE_VIDEO:
                    throw new NotSupportedException('Video in slider is not yet supported by yii2-splide wrapper.');
                    break;
                case self::TYPE_GRID:
                    throw new NotSupportedException('Grid in slider is not yet supported by yii2-splide wrapper.');
                    break;
                case self::TYPE_HTML:
                    return $item['html'];
                    break;
            }
        }

        return null;
    }
}
