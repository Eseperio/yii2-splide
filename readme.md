# Yii2-Splide
 
A yii2 wrapper for [SplideJs slider](https://github.com/Splidejs/splide).

## License 
MIT license. See [license](license.md)
## Content
- Assets
    - Asset bundle with main styles (SplideCoreAsset)
    - Asset bundle with main styles and default theme (SplideAsset)
- Widgets
    - Splide: Widget to render a splide slider
    - SplideThumbnailCarousel: Renders two sliders synced, one for main slider and other for thumbnails. 

## Installation:

Using composer:

`composer require eseperio/yii2-splide`


## Usage

### Widgets

There are two widgets. The former, a simple Splide slide, while the latter is a combination of two Splide slider for creating
a carousel with thumbnail navigation (See [thumbnail slider](https://splidejs.com/thumbnail-slider/))

    Video and grid not yet supported in current version of the wrapper.
```PHP
echo Splide::widget([
    'items' => [
                   [
                       'url' => 'http://someurl.com/image.jpg'
                   ],
                   [
                       'url' => ['some/yii2urlformat', 'param1' => 'example']
                   ],
                   [
                       'type'=> Splide::TYPE_HTML,
                       'html'=> 'htmlcodegoeshere',
                   ]
               ],
   
]);
```

**Thumbnail slider**

```php
echo \eseperio\splide\widgets\SplideThumbnailCarousel::widget([
                    'items' => $items
                ]);
```

### Options

All options of Splide can be defined through widget properties

### Properties of widget only
|Property|Description|
|--------|-----------|
|syncWith|Used to link sliders. Set with the id of the splide you want to link. See Splide sliders linking|
|mount|Defaults to `true`. Whether call mount on slider. 

### Properties from Splidejs
|Property|Description|
|--------|-----------|
|**type**|Determine a slider type.|
|**rewind**|Whether to rewind a slider before the first slide or after the last one.|
|**speed**|Transition speed in milliseconds.|
|**rewindSpeed**|Transition speed on rewind in milliseconds.|
|**waitForTransition**|Whether to prevent any actions while a slider is transitioning.|
|**width**|Define slider max width.|
|**height**|Define slider height.|
|**fixedWidth**|Fix width of slides.|
|**fixedHeight**|Fix height of slides.|
|**heightRatio**|Determine height of slides by ratio to a slider width.|
|**autoWidth**|If true, slide width will be determined by the element width itself. This is for a horizontal slider.|
|**autoHeight**|If true, slide height will be determined by the element height itself. This is for a vertical slider.|
|**perPage**|Determine how many slides should be displayed per page.|
|**perMove**|Determine how many slides should be moved when a slider goes to next or previous page.|
|**clones**|Manually determine how many clones should be generated on one side.|
|**start**|Start index.|
|**focus**|Determine which slide should be focused.|
|**gap**|Gap between slides.|
|**padding**|Set padding-left/right in horizontal mode or padding-top/bottom in vertical one.|
|**easing**|Animation timing function for CSS transition.|
|**arrows**|Whether to append arrows.|
|**arrowPath**|Change the arrow SVG path.|
|**pagination**|Whether to append pagination(indicator dots).|
|**autoplay**|Whether to enable autoplay.|
|**interval**|Autoplay interval in milliseconds.|
|**pauseOnHover**|Whether to stop autoplay while a slider is hovered.|
|**pauseOnFocus**|Whether to stop autoplay while a slider elements are focused.|
|**resetProgress**|Whether to reset progress of the autoplay timer when resumed.|
|**lazyLoad**|Enable lazy load for images.|
|**preloadPages**|Determine how many pages around an active slide should be loaded beforehand. This only works the lazyLoad option is “nearby”.|
|**keyboard**|Whether to control a slider via keyboard.|
|**drag**|Whether to allow mouse drag and touch swipe.|
|**dragAngleThreshold**|The angle threshold for drag.|
|**swipeDistanceThreshold**|Distance threshold for determining if the action is “flick” or “swipe”.|
|**flickVelocityThreshold**|Velocity threshold for determining if the action is “flick” or “swipe”.|
|**flickPower**|Determine power of flick. The larger number this is, the farther a slider runs by flick.|
|**flickMaxPages**|Limit a number of pages to move by flick.|
|**direction**|Slider direction.|
|**cover**|Whether to convert an img src to background-image of its parent element. height, fixedHeight or heightRatio is required.|
|**accessibility**|Whether to enable accessibility(aria and screen reader texts) or not.|
|**slideFocus**|Whether to add tabindex=”0″ to visible slides or not.|
|**isNavigation**|Determine if a slider is navigation for another.|
|**trimSpace**|Whether to trim spaces before the first slide or after the last one.|
|**updateOnMove**|If true, is-active class added to the slide element before transition.|
|**throttle**|Throttle duration for the resize event.|
|**breakpoints**|Breakpoints definitions.|
|**classes**|Collection of class names.|
|**i18n**|Collection of texts for i18n.|
