<?php
// page specific css
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery-ui-1.10.0.css');
Yii::app()->clientScript->registerScriptFile('http://cdn.jquerytools.org/1.2.7/all/jquery.tools.min.js', CClientScript::POS_END);
?>

<div id="pageContainer" class="container">
    <div class="subContainer" style="max-width: 550px;">
        <?php $this->renderPartial('_sidebar', array()); ?>
        
        <div class="form-box" style=''>
        <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'user-retrieve-form',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => true,
                        'validateOnType' => false,
                    )
                ));
                ?>
        <h1 style="font-weight: 300; font-size: 30px;"><?php echo Yii::t('youtoo', 'Forgot Password'); ?></h1>
        <br/>
        <br/>
        <div class="row">
            <div class='form group col-sm-12'>
                <?php echo $form->textField($model, 'username', array('placeholder' => Yii::t('youtoo','Email'), 'class' => 'form-control')); ?>
                <?php echo $form->error($model, 'username'); ?>
            </div>
        </div>
        <br/>
        <div class="row" style="margin-bottom: 10px;">
            <div class='col-sm-12' >
                <a  href="/login" style='color:#ea8417;'><?php echo Yii::t('youtoo','Remember your password?'); ?></a>
            </div>
        </div>
        <br/>
        <div class='row'>
            <div class="col-sm-12">
                <?php echo $form->hiddenField($model, 'source', array('value' => 'web')); ?>
                <input id="screen_width" type="hidden" name="screen_width" value="" />
                <input id="screen_height" type="hidden" name="screen_height" value="" />
                <?php echo CHtml::submitButton(Yii::t('youtoo', Yii::t('youtoo','Get Password')), array('class' => 'btn btn-default', 'role' => 'button', 'style' => 'width: 50%')); ?>
            </div>
        </div>
        <br/>
        <br/>
        <div class='row'>
            <div class='col-sm-12' ><a  href="/register" style='color:#ea8417;'><?php echo Yii::t('youtoo','Don\'t have an account?'); ?></a>
            </div>
        </div>
        <br/>
        <br/>
        <?php $this->endWidget(); ?>
        </div>
    </div>
</div>