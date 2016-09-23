<?php
/**
 * Created by PhpStorm.
 * User: jcarpio
 * Date: 9/5/16
 * Time: 11:35 AM
 */
use kartik\helpers\Html;
use kartik\widgets\FileInput;

?>
<div>
    <?= Html::beginForm(['upload'], 'popst', [
        'enctype' => 'multipart/form-data',
        'ng-submit' => 'uploadform.$valid && uploadItems($event)',
        'onsubmit' => "return false;",
        'name' => 'uploadform'
    ]); ?>
    <div class="col-sm-11">
        <?= FileInput::widget([
            'name' => 'sms_list',
            'options' => [
                [
                    'required' => true,
                    'accept' => '.csv'
                ]
            ]
        ]) ?>
    </div>
    <div class="col-sm-1">
        <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
    </div>
    <?= Html::endForm(); ?>
</div>