<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('/webassets/js/jquery.oauthpopup.js', CClientScript::POS_END);
?>
<script>
   function are_cookies_enabled()
    {
        var cookieEnabled = (navigator.cookieEnabled) ? true : false;
        if (typeof navigator.cookieEnabled === "undefined" && !cookieEnabled)
        {
            document.cookie = "testcookie";
            cookieEnabled = (document.cookie.indexOf("testcookie") !== -1) ? true : false;
        }
        if (cookieEnabled === false) {
            alert('Usted no puede entrar porque has bloqueado las cookies en la configuración del teléfono. Por favor permita estas cookies con el fin de participar en el Sorteo.');
            //alert('You are unable to Sign In because you have blocked cookies in your phone Settings. Please allow these cookies in order to participate in the Sweepstakes.');
        }
    }
</script>
<div class="fabmob_content-container text-center">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-registernew-form',
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'clientOptions' => array(
          'validateOnSubmit' => true,
                    'afterValidate' => 'js:function(form, data, hasError) {
                if(!hasError) {
                are_cookies_enabled(); return true;
                }
            }',
        ),
        'htmlOptions' => array(
            'class' => 'form-horizontal fabmob_condensed-form',
        ),
    ));
    ?>
    <h3 class="text-center text" style="padding: 0; margin-top: 10px;"><?php echo Yii::t('youtoo','Create an Account'); ?></h3>
    <div style='border:2px solid #cfcfcf; border-radius: 4px;'>
    <div class="form-group">
        <?php echo $form->textField($user, 'first_name', array('class' => 'form-control fabmob_round-border-top', 'placeholder' =>'Nombre')); ?>
        <?php echo $form->error($user, 'first_name'); ?>
        <span class="help-block hidden"></span>
    </div>
    <div class="form-group">
        <?php echo $form->textField($user, 'last_name', array('class' => 'form-control fabmob_round-border-top', 'placeholder' => 'Apellido')); ?>
        <?php echo $form->error($user, 'last_name'); ?>
        <span class="help-block hidden"></span>
    </div>
    <div class="form-group">
        <?php echo $form->passwordField($user, 'password', array('class' => 'form-control', 'placeholder' => 'Contraseña')); ?>
        <?php echo $form->error($user, 'password'); ?>
        <span class="help-block hidden"></span>
    </div>
    <div class="form-group">
        <?php echo $form->passwordField($user, 'confirm_password', array('class' => 'form-control', 'placeholder' => 'Confirmar contraseña')); ?>
        <?php echo $form->error($user, 'confirm_password'); ?>
        <span class="help-block hidden"></span>
    </div>
    <div class="form-group">
        <?php echo $form->textField($user, 'username', array('class' => 'form-control', 'placeholder' => 'Correo Electrónico')); ?>
        <?php echo $form->error($user, 'username'); ?>
        <span class="help-block hidden"></span>
    </div>
    <div class="form-group">
        <?php echo $form->dropDownList($userLocation, 'state', ClientUtility::getUSStates(),array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'State'))); ?>
        <?php echo $form->error($userLocation, 'state'); ?>
        <span class="help-block hidden"></span>
    </div>
    </div>
    <div class="form-group text" style='padding: 0px;'>
        <span id="fabmob_sign-up-terms-input-label" style="font-size: 12px; width: 100%; font-weight: 300; margin-bottom: 0px;"><?php echo $form->checkBox($user, 'terms_accepted'); ?>
            <?php echo Yii::t('youtoo','I agree to'); ?>
            <a class="active" style="text-decoration:none; font-size: 12px; color:#ea8417 !important; font-weight: 300;" href="<?php echo Yii::app()->createUrl('site/terms'); ?>">
               <?php echo Yii::t('youtoo','Terms of Use'); ?></a>, <?php //echo Yii::t('youtoo','and the'); ?>
            <a class="active" style="text-decoration:none; font-size: 12px; color:#ea8417 !important; font-weight: 300;" href="<?php echo Yii::app()->createUrl('site/privacy'); ?>">
                <?php echo Yii::t('youtoo','Privacy Policy'); ?></a>,
            <a class="active" style="text-decoration:none; font-size: 12px; color:#ea8417 !important; font-weight: 300;" href="<?php echo Yii::app()->createUrl('site/rules'); ?>">
                <?php echo Yii::t('youtoo','General Rules and Rules of the individual competetion'); ?></a>.
        </span>
        <?php echo $form->error($user, 'terms_accepted'); ?>
    </div>
    <div class="form-group text" style='padding: 0px;'>
    <span id="fabmob_sign-up-terms-input-label" style="font-size: 12px; width: 100%; font-weight: 300; margin-top: 0px;"><?php echo $form->checkbox($user, 'age_accepted', '', array('checked' => '', 'value' => 1)); ?>
                <span class='over_18'>
                    <?php echo Yii::t('youtoo','I confirm that I am atleast 21 years of age.'); ?>
                </span>
    </span>
                <?php echo $form->error($user, 'age_accepted'); ?>
    </div>
    <div class="form-group text" style="font-size: 12px; width: 100%; font-weight: 300; margin-top: 0px;">
                <span>Este juego no está disponible en:
                    California, Nex Mexico, Louisiana, Massachusetts,<br/> Georgia, Montana</span>
    </div>
    <div class="form-group text" style='padding: 0px;'>
    <span id="fabmob_sign-up-terms-input-label" style="font-size: 12px; width: 100%; font-weight: 300; margin-top: 0px;"><?php echo $form->checkbox($user, 'eligibility_accepted', '', array('checked' => '', 'value' => 1)); ?>
                <span class='eligiblity_accepted'>
                    <?php echo Yii::t('youtoo','I hereby confirm that I am not playing in one of the above mentioned states.'); ?>
                </span>
    </span>
                <?php echo $form->error($user, 'eligibility_accepted'); ?>
    </div>
    <button id="signUpButton" class="btn btn-default" style="min-width: 165px; min-height: 45px; font-size: 19px; width: 100%;"><?php echo Yii::t('youtoo','Sign Up'); ?></button>
    <?php $this->endWidget(); ?>
    <p id="fabmob_login-register-copy" class="text">
        <a id="fabmob_login-register-link" class="active" style="color:#ea8417 !important; text-decoration: none; font-size: 18px;" href="/login"><?php echo Yii::t('youtoo','Already have an account?'); ?></a>
    </p>
</div>