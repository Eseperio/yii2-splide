<?php


namespace eseperio\splide\widgets;


use yii\base\Widget;
use yii\helpers\Json;

class Splide extends Widget
{

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
     * Registers the needed JavaScript.
     * @since 2.0.8
     */
    public function registerClientScript()
    {
        $id = $this->grid->options['id'];
        $options = Json::encode([

        ]);
        $this->getView()
            ->registerJs("new Splide('#$id',$options).mount();");
    }

    public function run()
    {

    }
}
