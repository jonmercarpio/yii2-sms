<?php
/**
 * Created by PhpStorm.
 * User: jcarpio
 * Date: 9/5/16
 * Time: 12:15 PM
 */

namespace jonmercarpio\sms\models;


use yii\base\Model;

class SmsInputForm extends Model
{
    public $phone;
    public $firstName;
    public $lastName;
    public $param1;
    public $param2;
    public $param3;
    public $param4;
    public $param5;
    public $param6;

    public function rules()
    {
        return [
            [['phone', 'firstName', 'lastName'], 'required'],
            [['param1', 'param2', 'param3', 'param4', 'param5', 'param6'], 'safe']
        ];
    }

}