<?php

namespace jonmercarpio\sms\models;

use Yii;

/**
 * This is the model class for table "{{%sms_reception}}".
 *
 * @property integer $id
 * @property string $ToCountry
 * @property string $ToState
 * @property string $SmsMessageSid
 * @property string $NumMedia
 * @property string $ToCity
 * @property string $FromZip
 * @property string $SmsSid
 * @property string $FromState
 * @property string $SmsStatus
 * @property string $FromCity
 * @property string $Body
 * @property string $FromCountry
 * @property string $To
 * @property string $ToZip
 * @property string $NumSegments
 * @property string $MessageSid
 * @property string $AccountSid
 * @property string $From
 * @property string $ApiVersion
 * @property string $created_at
 */
class SmsReception extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sms_reception}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['ToCountry', 'ToState', 'SmsMessageSid', 'NumMedia', 'ToCity', 'FromZip', 'SmsSid', 'FromState', 'SmsStatus', 'FromCity', 'Body', 'FromCountry', 'To', 'ToZip', 'NumSegments', 'MessageSid', 'AccountSid', 'From', 'ApiVersion'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ToCountry' => Yii::t('app', 'To Country'),
            'ToState' => Yii::t('app', 'To State'),
            'SmsMessageSid' => Yii::t('app', 'Sms Message Sid'),
            'NumMedia' => Yii::t('app', 'Num Media'),
            'ToCity' => Yii::t('app', 'To City'),
            'FromZip' => Yii::t('app', 'From Zip'),
            'SmsSid' => Yii::t('app', 'Sms Sid'),
            'FromState' => Yii::t('app', 'From State'),
            'SmsStatus' => Yii::t('app', 'Sms Status'),
            'FromCity' => Yii::t('app', 'From City'),
            'Body' => Yii::t('app', 'Body'),
            'FromCountry' => Yii::t('app', 'From Country'),
            'To' => Yii::t('app', 'To'),
            'ToZip' => Yii::t('app', 'To Zip'),
            'NumSegments' => Yii::t('app', 'Num Segments'),
            'MessageSid' => Yii::t('app', 'Message Sid'),
            'AccountSid' => Yii::t('app', 'Account Sid'),
            'From' => Yii::t('app', 'From'),
            'ApiVersion' => Yii::t('app', 'Api Version'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
