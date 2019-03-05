<?php
/**
 * Description of _item_chat
 * Sep 20, 2016 5:40:40 PM
 *
 * @author Jonmer Carpio <jonmer09@gmail.com>
 */
/* @var $model jonmercarpio\sms\models\SmsViewConversation */

$number = $model->direction == 'inbound-api' ? "to" : "from";
?>
<div class="row">
    <div class="<?= $model->direction ?> bubble col-sm-8">     
        <div class="col-sm-12">
            <div><?= $model->created_at ?> | <?= $model->$number ?></div>            
            <?= $model->body ?>
        </div>
    </div>
</div>