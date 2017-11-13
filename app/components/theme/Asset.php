<?php

namespace app\components\theme;

use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    public $sourcePath = "@theme/assets";

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
