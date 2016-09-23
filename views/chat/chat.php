<?php

/**
 * Description of chat
 * Sep 20, 2016 5:27:31 PM
 *
 * @author Jonmer Carpio <jonmer09@gmail.com>
 */
use yii\widgets\ListView;
use kartik\helpers\Html;

/* @var $this \yii\web\View */
$this->title = $to;
?>
<div id="sms_chat">
    <div class="col-sm-12 pre-scrollable">
        <?=
        ListView::widget([
            'id' => 'sms_chat_list',
            'dataProvider' => $provider,
            'summary' => "",
            'itemView' => "_item_chat"
        ])
        ?>    
    </div>
    <div class="row">
        <div>
            <?= Html::beginForm(['default/send']) ?>
            <?= Html::hiddenInput("SmsQueue[to]", $to) ?>    
            <div class="col-sm-10">
                <?= Html::textarea('SmsQueue[body]', null, ['class' => 'form-control', 'maxlength' => "100"]) ?>
            </div>        
            <?= Html::submitButton('>', ['class' => 'btn btn-success pull-left']) ?>        
            <?= Html::endForm() ?>
        </div>
    </div>
</div>
<style type="text/css">
    #sms_chat #sms_chat_list .bubble{
        padding: 5px;
        border: 1px solid #FFF;
        border-radius: 5px;
        margin: 5px;
        background-color: white;
    }

    #sms_chat #sms_chat_list span{
        float: left;
        padding: 2px;
        width: 100%;
    }

    #sms_chat #sms_chat_list .inbound-api{
        float: left;
        text-align: left;
    }

    #sms_chat #sms_chat_list .outbound-api{
        float: right;
        text-align: right;
        background-color: #ececec;
        border: 1px solid #D5F9BA;
    }

</style>