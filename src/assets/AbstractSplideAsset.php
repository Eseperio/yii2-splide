<?php


namespace eseperio\splide\assets;


abstract class AbstractSplideAsset
{
    public $sourcePath = "@npm/splidejs--splide/dist";

    public $js = [
        'js/splide.min.js'
    ];

    public $css;
}
