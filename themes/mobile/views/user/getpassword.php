<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('/webassets/js/jquery.oauthpopup.js', CClientScript::POS_END);
?>
<br/>
<div class="fabmob_content-container text-center">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-retrieve-form',
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'validateOnType' => false,
        ),
        'htmlOptions' => array(
            'class' => 'form-horizontal fabmob_condensed-form',
        ),
    ));
    ?>
    <h3 class="text-center text"><?php echo Yii::t('youtoo', 'Forgot Password'); ?></h3>
    <div class="form-group" style='border: 2px solid #cfcfcf; border-radius: 4px; margin-bottom: 10px;'>
        <?php echo $form->textField($model, 'username', array('class' => 'form-control fabmob_round-border-top', 'placeholder' => Yii::t('youtoo','Email'))); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>
    <?php echo $form->hiddenField($model, 'source', array('value' => 'mobile web')); ?>
    <a id="fabmob_login-forgot-password-link" class="active" style="font-size: 16px; color:#ea8417 !important; text-decoration: none; font-weight: 300; margin-bottom: 200px;" href="/login"><?php echo Yii::t('youtoo','Remember your password?'); ?></a>
    <div>
        <button type="submit" class="btn btn-default" style="min-width: 165px; min-height: 45px; width: 100%;"><?php echo Yii::t('youtoo', 'Get Password') ?></button>
    </div>
    <?php $this->endWidget(); ?>

    <p id="fabmob_login-register-copy" class="text">
        <a id="fabmob_login-register-link" class="active" style="color:#ea8417 !important; text-decoration: none; font-size: 16px; font-weight: 300;" href="/register"><?php echo Yii::t('youtoo','Don\'t have an account?'); ?></a>
    </p>
</div>
