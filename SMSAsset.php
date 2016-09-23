<?php

namespace jonmer09\sms;

use yii\web\AssetBundle;

/**
 * Description of SMSAsset
 * Sep 20, 2016 11:35:26 AM
 * @author Jonmer Carpio <jonmer09@gmail.com>
 * 
 */
class SMSAsset extends AssetBundle {

    public $js = [
        'js/angular.min.js',
        'js/wall.js'
    ];
    public $css = [];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset'
    ];

    public function init() {
        $this->sourcePath = __DIR__ . '/assets/';
        parent::init();
    }

}
