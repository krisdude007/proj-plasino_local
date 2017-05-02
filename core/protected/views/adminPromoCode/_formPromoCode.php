<?php
/* @var $this AdminPromoCodeController */
/* @var $model Language */
/* @var $form CActiveForm */

$cs = Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery-ui-1.10.0.css');
$cs->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery-ui-timepicker-addon.css');

// page specific js
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery-ui-timepicker-addon.js', CClientScript::POS_END);
//$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/adminVoting/index.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/spectrum.js', CClientScript::POS_END);
?>
<script>
$(document).ready(function() {
    $("#datetimepickerClose").datetimepicker({
        maxDate: "0",
        onSelect: function () {
            $(this).attr('value', this.value);
        }
    });
    
    $("#datetimepickerOpen").datetimepicker({
        maxDate: "0",
        onSelect: function () {
            $(this).attr('value', this.value);
        }
    });
});

</script>

<div class="form">
    <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'admin-promocode-form',
            'enableAjaxValidation' => true,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
    ?>
    <?php echo $form->errorSummary(Array($promo)); ?>

    <div class="floatLeft" style="width:48%;">
        <div class="clearfix" style="margin-top: 10px;">
        </div>
        <div class="clearfix" style="margin-top: 10px;">
            <div class="row" class="floatLeft marginRight10">
                <?php echo $form->labelEx($promo, 'user_email'); ?>
                <?php echo $form->textField($promo, 'user_email'); ?>
                <?php echo $form->error($promo, 'user_email'); ?>
            </div>
        </div>
        <div class="clearfix" style="margin-top: 10px;">
            <div class="row" class="floatLeft marginRight10">
                <?php echo $form->labelEx($promo, 'freecredit_key'); ?>
                <?php echo $form->textField($promo, 'freecredit_key'); ?>
                <?php echo $form->error($promo, 'freecredit_key'); ?>
            </div>
            <div class="row" class="floatLeft marginRight10">
                <?php echo $form->labelEx($promo, 'freecredit_price'); ?>
                <?php echo $form->textField($promo, 'freecredit_price',array('readonly' => true)); ?>
                <?php echo $form->error($promo, 'freecredit_price'); ?>
            </div>
        </div>
        <div class="clearfix" style="margin-top: 10px;">
            <div class="row" class="floatLeft marginRight10">
                <?php echo $form->labelEx($promo, 'start_date'); ?>
                <?php echo $form->textField($promo, 'start_date', array('id' => 'datetimepickerOpen', 'style' => 'width: 140px;', 'class' => ' datetimepicker')); ?>
                <?php echo $form->error($promo, 'start_date'); ?>
            </div>
            <div class="row" class="floatLeft marginRight10">
                <?php echo $form->labelEx($promo, 'end_date'); ?>
                <?php echo $form->textField($promo, 'end_date', array('id' => 'datetimepickerClose', 'style' => 'width: 140px;', 'class' => ' datetimepicker')); ?>
                <?php echo $form->error($promo, 'end_date'); ?>
            </div>
        </div>
        <div class="clearfix" style="margin-top: 10px;">
            <div class="row" class="floatLeft marginRight10">
                <?php echo $form->labelEx($promo, 'code_used_by'); ?>
                <?php echo $form->textField($promo, 'code_used_by'); ?>
                <?php echo $form->error($promo, 'code_used_by'); ?>
            </div>
            <div class="row" class="floatLeft marginRight10">
                <?php echo $form->labelEx($promo, 'is_code_used'); ?>
                <?php echo $form->textField($promo, 'is_code_used',array('readonly' => false)); ?>
                <?php echo $form->error($promo, 'is_code_used'); ?>
            </div>
        </div>
        <div class="clearfix">
            <div class="row buttons" style="margin-top:12px;margin-right:7px;">
                <?php echo CHtml::submitButton('Submit'); ?>
            </div>
            <div class="row buttons" style="margin-top:12px;margin-right:7px;">
                <button type='button' onclick="window.location.href = '/adminPromoCode/index';">Clear</button>
            </div>
        </div>
    </div>


<?php $this->endWidget(); ?>


</div><!-- form -->
