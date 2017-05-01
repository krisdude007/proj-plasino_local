<?php
// page specific css
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery-ui-1.10.0.css');
Yii::app()->clientScript->registerScriptFile('http://cdn.jquerytools.org/1.2.7/all/jquery.tools.min.js', CClientScript::POS_END);
?>
  <h1 style=""><?php echo Yii::t('youtoo', 'Log In and Play!'); ?></h1>
<div id="wrapper">
<div id="pageContainer" class="container">
    <div class="subContainer" style="max-width: 550px;">
        <?php $this->renderPartial('_sidebar', array()); ?>
        <div class="form-box">
          <div class="login-container">
        <?php
        $form = $this->beginWidget('CActiveForm', array('id' => 'user-loginnew-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
                ),
            'htmlOptions' => array(
                ),
            )
           );
        ?>
      
        <br/>
        <br/>
        <div class="row">
            <div class='form group col-sm-12'>
                <?php echo $form->textField($user, 'username', array('placeholder' => Yii::t('youtoo','Email'), 'class' => 'form-control')); ?>
                <?php echo $form->error($user, 'username'); ?>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class='form group col-sm-12'>
                <?php echo $form->passwordField($user, 'password', array('placeholder' => Yii::t('youtoo','Password'), 'class' => 'form-control')); ?>
                <?php echo $form->error($user, 'password'); ?>
            </div>
        </div>
        <br/>
        <div class="row" style="margin-bottom: 10px;">
            <div class='col-sm-12' >
                <a  href="/getpassword" style='color:#ea8417;'><?php echo Yii::t('youtoo','Forgot Password?'); ?></a>
            </div>
        </div>
        <br/>
        <div class='row'>
            <div class="col-sm-12">
                <?php echo $form->hiddenField($user, 'source', array('value' => 'web')); ?>
                <input id="screen_width" type="hidden" name="screen_width" value="" />
                <input id="screen_height" type="hidden" name="screen_height" value="" />
                <?php echo CHtml::submitButton(Yii::t('youtoo', 'Login'), array('class' => 'btn btn-default', 'role' => 'button', 'style' => 'width: 40%')); ?>
            </div>
        </div>
        <br/>
        <br/>
        <div class='row'>
            <div class='col-sm-12' ><a  href="<?php echo '/register'; ?>" style='color:#ea8417;'><?php echo Yii::t('youtoo','Don\'t have an account?'); ?></a>
            </div>
        </div>
        <br/>
        <br/>
        <?php $this->endWidget(); ?>
        </div>
		</div>
    </div>
</div>
</div>