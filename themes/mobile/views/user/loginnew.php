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
<br/>
<div class="fabmob_content-container text-center">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-loginnew-form',
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'validateOnType' => false,
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
    <h3 class="text-center text"><?php echo Yii::t('youtoo', 'Log In and Play!'); ?></h3>
    <div class="form-group" style='border: 2px solid #cfcfcf; border-radius: 4px; margin-bottom: 10px;'>
        <?php echo $form->textField($user, 'username', array('class' => 'form-control fabmob_round-border-top', 'placeholder' => Yii::t('youtoo','Email'))); ?>
        <?php echo $form->error($user, 'username'); ?>
    </div>
    <div id="fabmob_login-password-form-input" class="form-group" style='border: 2px solid #cfcfcf; border-radius: 4px;'>
        <?php echo $form->passwordField($user, 'password', array('class' => 'form-control fabmob_round-border-top', 'placeholder' => Yii::t('youtoo','Password'))); ?>
        <?php echo $form->error($user, 'password'); ?>
    </div>
    <?php echo $form->hiddenField($user, 'source', array('value' => 'mobile web')); ?>
    <a id="fabmob_login-forgot-password-link" class="active" style="font-size: 16px; color:#ea8417 !important; text-decoration: none; font-weight: 300; margin-bottom: 100px;" href="/getpassword"><?php echo Yii::t('youtoo','Forgot Password?'); ?></a>
    <div>
        <button type="submit" class="btn btn-default" style="min-width: 165px; min-height: 45px; width: 100%;"><?php echo Yii::t('youtoo', 'Login') ?></button>
    </div>
    <?php $this->endWidget(); ?>

    <p id="fabmob_login-register-copy" class="text">
        <a id="fabmob_login-register-link" class="active" style="color:#ea8417 !important; text-decoration: none; font-size: 16px; font-weight: 300;" href="/register"><?php echo Yii::t('youtoo','Don\'t have an account?'); ?></a>
    </p>
</div>
