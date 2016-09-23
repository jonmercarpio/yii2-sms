<?php

/**
 * Created by PhpStorm.
 * User: jcarpio
 * Date: 9/1/16
 * Time: 3:43 PM
 */

namespace jonmer09\sms\controllers;

use jonmer09\sms\components\SMSHelper;
use jonmer09\sms\models\SmsQueue;
use common\components\Controller;
use jonmer09\sms\models\SmsReception;

class DefaultController extends Controller {

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $model = new SmsQueue();
        return $this->render('index', ['model' => $model]);
    }

    public function actionReceive() {
        $model = new SmsReception();
        $post = [];
        $post["SmsReception"] = $this->post();
        if ($model->load($post)) {
            $model->save();
        }
        file_put_contents(time(), json_encode($this->post()));
        \Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        $response = ["Message" => "hi, Monkey"];
        return $response;
    }

    public function actionSend() {
        $model = new SmsQueue();
        if ($model->load($this->post())) {
            $ms = SMSHelper::quickMessage($model->to, $model->body, $model->from);
            if (!$ms) {
                return $this->redirectToReferrer(null);
            } else {
                return $ms;
            }
        }
        return false;
    }

}
