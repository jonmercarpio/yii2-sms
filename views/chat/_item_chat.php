<?php
/**
 * Description of _item_chat
 * Sep 20, 2016 5:40:40 PM
 *
 * @author Jonmer Carpio <jonmer09@gmail.com>
 */
/* @var $model jonmer09\sms\models\SmsViewConversation */
?>
<div class="col-sm-12">
    <div class="<?= $model->direction ?> bubble">        
        <div class="col-sm-12">     
            <?= $model->to ?>
            <?= $model->body ?>
        </div>
    </div>
</div>