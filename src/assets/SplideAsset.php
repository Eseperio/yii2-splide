<?php


namespace eseperio\splide\assets;


use yii\web\AssetBundle;

/**
 * Contains ready to use styles and javascript for Splide. Use this if your are not customizing splide.
 * @package eseperio\splide\assets
 */
class SplideAsset extends AbstractSplideAsset
{

    public $css = [
        'css/splide.min.css',
        'css/themes/splide-default.min.css'
    ];
}
