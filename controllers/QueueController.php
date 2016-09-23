<?php
/**
 * Created by PhpStorm.
 * User: jcarpio
 * Date: 9/5/16
 * Time: 5:48 PM
 */

namespace jonmer09\sms\controllers;


use common\components\Controller;

class QueueController extends Controller
{
    public function actionIndex()
    {
        var_dump($this->post());
    }

}