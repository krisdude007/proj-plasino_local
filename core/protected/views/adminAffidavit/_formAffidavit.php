<?php
/* @var $this AdminController */
/* @var $model Language */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'admin-affidavit-form',
            'enableAjaxValidation' => true,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
    ?>
    <?php echo $form->errorSummary(Array($program)); ?>

    <div class="floatLeft" style="width:48%;">
        <div class="clearfix" style="margin-top: 10px;">
        </div>
        <div class="clearfix" style="margin-top: 10px;">
            <div class="row" class="floatLeft marginRight10">
                <?php echo $form->labelEx($program, 'program_name'); ?>
                <?php echo $form->textField($program, 'program_name'); ?>
                <?php echo $form->error($program, 'program_name'); ?>
            </div>
        </div>
        <div class="clearfix" style="margin-top: 10px;">
            <div class="row" class="floatLeft marginRight10">
                <?php echo $form->labelEx($program, 'aired'); ?>
                <?php echo $form->textField($program, 'aired'); ?>
                <?php echo $form->error($program, 'aired'); ?>
            </div>
            <div class="row" class="floatLeft marginRight10">
                <?php echo $form->labelEx($program, 'air_time'); ?>
                <?php echo $form->dropDownList($program, "air_time",ClientUtility::getHoursOfAirTime()); ?>
                <?php echo $form->error($program, 'air_time'); ?>
            </div>
        </div>
        <div class="clearfix" style="margin-top: 10px;">
            <div class="row" class="floatLeft marginRight10">
                <?php echo $form->labelEx($program, 'aired_day'); ?>
                <?php echo $form->dropDownList($program, "aired_day", ClientUtility::getDaysOfWeek()); ?>
                <?php echo $form->error($program, 'aired_day'); ?>
            </div>
        </div>
        <div class="clearfix">
           <div class="row" class="floatLeft marginRight10">
                <?php echo $form->labelEx($program, 'aired_month'); ?>
                <?php echo $form->dropDownList($program, "aired_month", ClientUtility::getMonthsOfYear()); ?>
                <?php echo $form->error($program, 'aired_month'); ?>
            </div>
        </div>
        <div class="clearfix">
           <div class="row" class="floatLeft marginRight10">
                <?php echo $form->labelEx($program, 'station'); ?>
                <?php echo $form->textField($program, "station", array('readonly' => true)); ?>
                <?php echo $form->error($program, 'station'); ?>
            </div>
        </div>
        <div class="clearfix">
            <div class="row buttons" style="margin-top:12px;margin-right:7px;">
                <?php echo CHtml::submitButton('Submit'); ?>
            </div>
            <div class="row buttons" style="margin-top:12px;margin-right:7px;">
                <button type='button' onclick="window.location.href = '/adminAffidavit/index';">Clear</button>
            </div>
        </div>
    </div>


<?php $this->endWidget(); ?>


</div><!-- form -->
