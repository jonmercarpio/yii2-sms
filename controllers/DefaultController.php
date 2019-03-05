<?php

/**
 * Created by PhpStorm.
 * User: jcarpio
 * Date: 9/1/16
 * Time: 3:43 PM
 */

namespace jonmercarpio\sms\controllers;

use common\components\Controller;
use jonmercarpio\sms\components\SMSHelper;
use jonmercarpio\sms\models\SmsQueue;
use jonmercarpio\sms\models\SmsReception;
use Yii;
use yii\httpclient\Client;
use yii\web\Response;

class DefaultController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        if (!Yii::$app->user->identity)
        {
            $this->layout = "remote";
        }
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $model = new SmsQueue();
        return $this->render('index', ['model' => $model]);
    }

    public function actionReceive()
    {
        $model = new SmsReception();
        $post = [];
        $post["SmsReception"] = $this->post();
        if ($model->load($post))
        {
            $model->save();            
        }
        file_put_contents(time(), json_encode($this->post()));
//        \Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
//        $response = ["Message" => "hi, Monkey"];
//        return $response;
    }

    public function actionReceiveFails()
    {
        file_put_contents("fail-" . time(), json_encode($this->post()));
    }

    public function actionSend()
    {
        $model = new SmsQueue();
        if ($model->load($this->post()))
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $ms = SMSHelper::quickMessage($model->to, $model->body, $model->from);
            if (!$ms)
            {
                return ['done' => true];
            } else
            {
                return ['error' => $ms];
            }
        }
        return false;
    }

}
