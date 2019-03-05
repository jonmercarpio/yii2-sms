<?php

namespace jonmercarpio\sms\models;

use Yii;

/**
 * This is the model class for table "{{%sms_view_conversation}}".
 *
 * @property string $to
 * @property string $body
 * @property string $created_at
 * @property string $direction
 * @property string $from
 */
class SmsViewConversation extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%sms_view_conversation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['created_at', 'direction', 'from'], 'safe'],
            [['to'], 'string', 'max' => 100],
            [['body'], 'string', 'max' => 160],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'to' => Yii::t('app', 'To'),
            'body' => Yii::t('app', 'Body'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public static function primaryKey() {
        return ['to', 'created_at'];
    }

}
