<?php

/**
 * Description of _item
 * Sep 20, 2016 5:14:20 PM
 *
 * @author Jonmer Carpio <jonmer09@gmail.com>
 */
use kartik\helpers\Html;

?>
<?=

Html::a($model->to, ['chat', 'to' => $model->to], ['class' => 'sms_item'])
?>