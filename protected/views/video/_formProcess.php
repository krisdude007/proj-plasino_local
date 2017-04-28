<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'video-process-form',
        'enableAjaxValidation' => true,
    ));
    ?>
    <p class="note"><?php echo Yii::t('youtoo','Fields with * are required.'); ?></p>
    <div class="">
        <?php echo Yii::t('youtoo','Video Title'); ?><sup>*</sup>
        <div class="helperText"><?php echo Yii::t('youtoo','This will help you find your video.'); ?></div>
        <?php echo $form->textField($model, 'title'); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>
    <div class="">
        <?php echo Yii::t('youtoo','Video Description'); ?><sup>*</sup>
        <div class="helperText"><?php echo Yii::t('youtoo','Describe your video so people know what your video is about'); ?></div>
        <?php echo $form->textArea($model, 'description'); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
    <div class="buttons" style="margin-top:30px;text-align:center;">
        <?php echo $form->hiddenField($model, 'source', array('value' => 'web')); ?>
        <?php echo CHtml::submitButton(Yii::t('youtoo','Submit'),array('class'=>'btn btn-default btn-lg active')); ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
