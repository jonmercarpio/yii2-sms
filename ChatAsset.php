<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace jonmercarpio\sms;

use yii\web\AssetBundle;

/**
 * Description of ChatAsset
 *
 * @author jcarpio
 */
class ChatAsset extends AssetBundle
{

    public $js = [
        'js/chat.js'
    ];
    public $css = [
        'css/chat.css'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset'
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets/';
        parent::init();
    }

}
