<?php

/**
 * Description of index
 * Sep 20, 2016 3:37:59 PM
 *
 * @author Jonmer Carpio <jonmer09@gmail.com>
 */
?>
<div>
    <div class="col-sm-3">
        <?=
        yii\widgets\ListView::widget([
            'id' => 'sms_list_to',
            'dataProvider' => $provider,
            'summary' => "",
            'itemView' => "_item"
        ])
        ?>
    </div>
    <div class="col-sm-5">
        <div id="sms_chat_container">
        </div>
    </div>
</div>
<div class="clearfix">
</div>
<?php
$js = "
    $('#sms_list_to').on('click','.sms_item' , function(e){        
        var \$me = $(this);
        $('#sms_chat_container').load(\$me.attr('href'));
        return false;
    });
";
$this->registerJs($js);
