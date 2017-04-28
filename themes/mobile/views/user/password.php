<div class="fabmob_content-container text-center" style="padding: 2%;">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-password-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => array(
            'class' => 'form-horizontal fabmob_condensed-form'),
    ));
    ?>
    <br/>
    <div class="form-group" style='border: 2px solid #cfcfcf; border-radius: 4px; margin-bottom: 10px;'>
        <?php echo $form->passwordField($user, 'newPassword', array('value'=>'','class' => 'form-control', 'placeholder' => Yii::t('youtoo','New Password'))); ?>
        <?php echo $form->error($user, 'newPassword'); ?>
        <span class="help-block hidden"></span>
    </div>
    <div class="form-group" style='border: 2px solid #cfcfcf; border-radius: 4px;'>
        <?php echo $form->passwordField($user, 'newPasswordConfirm', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo','Confirm Password'))); ?>
        <?php echo $form->error($user, 'newPasswordConfirm'); ?>
        <span class="help-block hidden"></span>
    </div>
    <br/>
    <button id="js-forgot-password-btn" type="submit" class="btn btn-default"><?php echo Yii::t('youtoo','Save'); ?></button>
    <?php $this->endWidget(); ?>
</div>
