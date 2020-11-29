<?php


namespace eseperio\splide\assets;


use yii\web\AssetBundle;

abstract class AbstractSplideAsset extends AssetBundle
{
    public $sourcePath = "@npm/splidejs--splide/dist";

    public $js = [
        'js/splide.min.js'
    ];

    public $css;
}
