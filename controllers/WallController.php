<?php

/**
 * Created by PhpStorm.
 * User: jcarpio
 * Date: 9/2/16
 * Time: 11:30 AM
 */

namespace jonmercarpio\sms\controllers;

use jonmercarpio\sms\components\SMSHelper;
use jonmercarpio\sms\components\Controller;
use jonmercarpio\sms\models\SmsInputForm;
use jonmercarpio\sms\models\SmsQueue;
use yii\web\Response;
use yii\web\UploadedFile;

class WallController extends Controller {

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        if (!\Yii::$app->user->identity) {
            $this->layout = "remote";
        }
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $smsQueueModel = new SmsQueue();
        $smsInputModel = new SmsInputForm();
        return $this->render('index', ['smsQueueModel' => $smsQueueModel, 'smsInputModel' => $smsInputModel]);
    }

    public function actionUpload() {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $instance = UploadedFile::getInstanceByName('sms_list');
        return SMSHelper::getCSVData(fopen($instance->tempName, 'r'));
    }

    public function actionQueue() {
        $template = $this->post('template');
        $name = $this->post('name', 'default_' . time());
        foreach ($this->post('rows', []) as $row) {
            $model = new SmsInputForm();
            $model->load($this->parseRow($row));
            SMSHelper::queueMessage($model, $template);
        }
        return "ok";
    }

    private function parseRow($row) {
        $data = [];
        foreach ($row as $r) {
            $formName = preg_replace('/\[(.*)\]/i', '', $r['name']);
            preg_match('/\[(.*)\]/i', $r['name'], $result);
            $data[$formName][$result[1]] = $r['value'];
        }
        return $data;
    }

}
