<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/min/basic.min.css',
        'https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/min/dropzone.min.css',
        'css/site.css',
    ];
    public $js = [
        'https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/dropzone.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
