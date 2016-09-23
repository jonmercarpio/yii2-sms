<?php

/**
 * Created by PhpStorm.
 * User: jcarpio
 * Date: 9/2/16
 * Time: 11:31 AM
 */
use kartik\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;

jonmer09\sms\SMSAsset::register($this);

/* @var $this \yii\web\View */
?>
<div class="row" ng-app="myApp" ng-controller="tableController">
    <div class="error-summary" ng-show="status">
        {{ status}}
    </div>
    <div class="col-sm-7">
        <?=
        TabsX::widget([
            'items' => [
                [
                    'label' => "Input",
                    'content' => $this->render('input-tab', ['model' => $smsInputModel])
                ],
                [
                    'label' => "Upload",
                    'content' => $this->render('upload-tab', [])
                ]
            ]
        ])
        ?>
    </div>
    <div class="col-sm-5">
        <?= Html::label('Template') ?>
        <div class="">
            <?=
            Html::textarea('template', '', [
                'class' => 'col-sm-12',
                'placeholder' => 'Body template... {phone} {firstName} {lastName} {param1}, {param2}',
                'rows' => 11,
                'ng-model' => 'template'
            ])
            ?>
        </div>
    </div>
    <div class="col-sm-12">
        <?= Html::hiddenInput('url', Url::to(['queue']), ['id' => 'urlPost']) ?>
        <div class="form-group col-sm-5 row">
            <div class="pull-left">
                <?= Html::textInput('list_name', '', ['ng-model' => 'listName', 'class' => 'form-control', 'placeholder' => 'List Name']) ?>
            </div>
            <div class="pull-left">
                &nbsp;
                <?= Html::submitButton('Send', ['ng-click' => 'sendSms($event)', 'class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <table class="kv-grid-table table table-bordered kv-table-wrap condensed">
            <thead>
                <tr>
                    <th ng-repeat="h in headers">
                        {{ h }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="d in rows">
                    <td ng-repeat="x in d">
                        {{ x.value}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>