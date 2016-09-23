<?php
/**
 * Created by PhpStorm.
 * User: jcarpio
 * Date: 9/5/16
 * Time: 11:34 AM
 */

use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\helpers\Html;

?>
<div>
    <div>
        <?php
        $form = ActiveForm::begin([
            'id' => 'sms-input-tab-form',
            'options' => [
                'ng-submit' => 'inputform.$valid && addItem($event)',
                'onsubmit' => "return false;",
                'name' => 'inputform',
            ]
        ]);
        ?>
        <div class="col-sm-11">
            <?= Form::widget([
                'form' => $form,
                'model' => $model,
                'columns' => 3,
                'attributes' => [
                    'phone' => ['type' => Form::INPUT_TEXT, 'options' => ['ng-model' => 'phone', 'required' => true]],
                    'firstName' => ['type' => Form::INPUT_TEXT, 'options' => ['ng-model' => 'firstName', 'required' => true]],
                    'lastName' => ['type' => Form::INPUT_TEXT, 'options' => ['ng-model' => 'lastName', 'required' => true]],
                    'param1' => ['type' => Form::INPUT_TEXT],
                    'param2' => ['type' => Form::INPUT_TEXT],
                    'param3' => ['type' => Form::INPUT_TEXT],
                    'param4' => ['type' => Form::INPUT_TEXT],
                    'param5' => ['type' => Form::INPUT_TEXT],
                    'param6' => ['type' => Form::INPUT_TEXT],
                ]
            ]) ?>
        </div>
        <div class="col-sm-1">
            <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
