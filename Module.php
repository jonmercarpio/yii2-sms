<?php
/**
 * Created by PhpStorm.
 * User: jcarpio
 * Date: 9/1/16
 * Time: 3:32 PM
 */

namespace jonmer09\sms;


class Module extends  \yii\base\Module
{
    public $controllerNamespace = 'jonmer09\sms\controllers';

    public function init() {
        parent::init();
    }

}