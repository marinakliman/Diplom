<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AuthAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl  = '@web';

    public $css = [
        'https://fonts.googleapis.com/css?family=Open+Sans:300,400&subset=cyrillic',
        'css/auth.css',
        'fonts/icomoon/icomoon.css',
        'fonts/simple-line-icons/simple-line-icons.css'
    ];
}