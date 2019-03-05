<?php

/**
 * Created by PhpStorm.
 * User: jcarpio
 * Date: 9/2/16
 * Time: 11:41 AM
 */
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\helpers\Html;

/* @var $this \yii\web\View */
?>
<div>
    <div class="col-sm-4">
        <?php
        $form = ActiveForm::begin([
                    'id' => 'quick-sms-form',
                    'action' => ['default/send'],
                    'formConfig' => [
                        'showLabels' => false
                    ],
                    'options' => []
        ]);
        ?>
        <?=
        Form::widget([
            'form' => $form,
            'model' => $model,
            'columns' => 1,
            'attributes' => [
                'to' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Phone Number']],
                'body' => ['type' => Form::INPUT_TEXTAREA, 'options' => ['placeholder' => 'Body Message']]
            ]
        ])
        ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-sm-6">
        
    </div>
</div>
<?php
$js = <<<EOF

    $('form#quick-sms-form').on('beforeSubmit', function(e){
        var form = $(this);
        if (form.find('.required.has-error').length) {
             return false;
        }
        var data = new FormData(this);
        $.ajax({
             url: form.attr('action'),
             type: 'post',
             data: data,
             processData: false,
             contentType: false,
             success: function (response) {
                $('#smsqueue-to').next().html(response);
             }
        });
       return false;
    });

EOF;

$this->registerJs($js);
