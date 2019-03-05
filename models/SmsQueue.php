<?php
/**
 * Created by PhpStorm.
 * User: jcarpio
 * Date: 9/2/16
 * Time: 4:11 PM
 */

namespace jonmercarpio\sms\models;

use Yii;

/**
 * This is the model class for table "{{%sms_queue}}".
 *
 * @property integer $id
 * @property string $to
 * @property string $from
 * @property string $body
 * @property string $error_code
 * @property string $error_message
 * @property string $date_sent_utc
 * @property string $sid
 * @property string $direction
 * @property string $account_sid
 * @property string $created_at
 * @property integer $created_by
 */
class SmsQueue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sms_queue}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['to', 'from', 'body'], 'required'],
            [['date_sent_utc', 'created_at'], 'safe'],
            [['created_by'], 'integer'],
            [['to', 'from', 'direction'], 'string', 'max' => 16],
            [['body'], 'string', 'max' => 160],
            [['error_code', 'error_message'], 'string', 'max' => 255],
            [['sid', 'account_sid'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'to' => Yii::t('app', 'To'),
            'from' => Yii::t('app', 'From'),
            'body' => Yii::t('app', 'Body'),
            'error_code' => Yii::t('app', 'Error Code'),
            'error_message' => Yii::t('app', 'Error Message'),
            'date_sent_utc' => Yii::t('app', 'Date Sent Utc'),
            'sid' => Yii::t('app', 'Sid'),
            'direction' => Yii::t('app', 'Direction'),
            'account_sid' => Yii::t('app', 'Account Sid'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }
}
