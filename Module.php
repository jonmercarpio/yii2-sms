<?php
/**
 * Created by PhpStorm.
 * User: jcarpio
 * Date: 9/1/16
 * Time: 3:32 PM
 */

namespace jonmercarpio\sms;


class Module extends  \yii\base\Module
{
    public $controllerNamespace = 'jonmercarpio\sms\controllers';

    public function init() {
        parent::init();
    }

}