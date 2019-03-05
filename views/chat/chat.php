<?php

/**
 * Description of chat
 * Sep 20, 2016 5:27:31 PM
 *
 * @author Jonmer Carpio <jonmer09@gmail.com>
 */
use jonmer09\sms\ChatAsset;
use kartik\helpers\Html;
use yii\web\View;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this View */
$this->title = $to;

ChatAsset::register($this);
?>
<div id="sms_chat">
    <div id="sms_chat_list_scroll" class="col-sm-12 pre-scrollable">
        <?php
        Pjax::begin([
            'id' => 'chat-list',
            'enablePushState' => false
        ]);
        ?> 
        <?=
        ListView::widget([
            'id' => 'sms_chat_list',
            'dataProvider' => $provider,
            'summary' => "",
            'itemView' => "_item_chat"
        ])
        ?>
        <?php Pjax::end(); ?>
    </div> 
    <div class="col-sm-12 row" id="sms_chat_form">
        <div class="error-summary col-sm-12" id="error-summary">
        </div>
        <div>
            <?= Html::beginForm(['default/send', 'redirect' => false], 'post', ['id' => "chat_form", 'data' => ['url' => $url]]) ?>
            <?= Html::hiddenInput("SmsQueue[to]", $to) ?>
            <div class="row">
                <div class="col-xs-10">
                    <?= Html::textarea('SmsQueue[body]', null, ['class' => 'form-control', 'maxlength' => "100"]) ?>                
                </div>
                <div class="col-xs-1 row">
                    <?= Html::submitButton('&gt;', ['class' => 'btn btn-success']) ?>    
                </div>    
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>