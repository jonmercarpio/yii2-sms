<?php

/**
 * Created by PhpStorm.
 * User: jcarpio
 * Date: 9/2/16
 * Time: 11:16 AM
 */

namespace jonmer09\sms\components;

use jonmer09\sms\models\SmsInputForm;
use jonmer09\sms\models\SmsQueue;
use Twilio\Exceptions\TwilioException;

class SMSHelper {

    /**
     * @var TwilioSMS $twilio_sms
     */
    private static $twilio_sms;

    /**
     * @return TwilioSMS
     */
    private static function sms() {
        if (self::$twilio_sms == null) {
            self::$twilio_sms = \Yii::$app->sms;
        }
        return self::$twilio_sms;
    }

    /**
     * @param string $to
     * @param string $body
     * @param null $from
     * @return \Twilio\Rest\Api\V2010\Account\MessageInstance
     */
    static function sendMessage($to, $body, $from = null) {
        return self::sms()->sendMessage($to, $body, $from);
    }

    /**
     * @param string $to
     * @param string $body
     * @param null $from
     * @return string
     */
    static function quickMessage($to, $body, $from = null) {
        try {
            $message = self::sendMessage($to, $body, $from);
            self::queue($message);
            return $message->errorMessage;
        } catch (TwilioException $e) {
            return $e->getMessage();
        }
    }

    /**
     * 
     * @param type $message
     */
    private static function queue($message) {
        if ($message) {
            $model = new SmsQueue();
            $model->to = $message->to;
            $model->body = $message->body;
            $model->from = $message->from;
            $model->created_by = \Yii::$app->user->id;
            $model->error_code = $message->errorCode;
            $model->error_message = $message->errorMessage;
            $model->date_sent_utc = $message->dateSent->format("Y-m-d H:i:s");
            $model->sid = $message->sid;
            $model->direction = $message->direction;
            $model->account_sid = $message->accountSid;
            $model->save();
        }
    }

    static function queueMessage(SmsInputForm $form, $template) {
        foreach ($form->attributes as $key => $value) {
            $template = str_replace("{{$key}}", $value, $template);
        }
        $message = self::sendMessage($form->phone, $template);
        self::queue($message);
    }

    public static function getCSVData($file) {
        $csv_data = [];
        $key = [];
        $header = null;
        while ($row = fgetcsv($file)) {
            if ($header === null) {
                $header = $row;
                continue;
            }
            $csv_data[$row[0]] = array_combine($header, $row);
            $key[] = $row[0];
        }
        return $csv_data;
    }

}
