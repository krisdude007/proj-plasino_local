<?php
// page specific css
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery-ui-1.10.0.css');
Yii::app()->clientScript->registerScriptFile('http://cdn.jquerytools.org/1.2.7/all/jquery.tools.min.js', CClientScript::POS_END);
?>
<div id="wrapper">
    <div id="pageContainer" class="container">
        <div class="subContainer" style="max-width: 550px;">
            <?php $this->renderPartial('_sidebar', array()); ?>
            <h1 style="font-weight: 300; font-size: 30px;color:white;"><?php echo Yii::t('youtoo', 'Create an Account'); ?></h1>
            <div class="form-box">
                <div style='background-color:white;'>
                    <?php
                    $form = $this->beginWidget('CActiveForm', array('id' => 'user-registerimported-form',
                        'enableAjaxValidation' => true,
                        'enableClientValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        ),
                        'htmlOptions' => array(
                        ),));
                    ?>

                    <br/>
                    <div class="row">
                        <div class='form group col-sm-12'>
                            <?php echo $form->textField($user, 'username', array('placeholder' => Yii::t('youtoo', 'Email'), 'class' => 'form-control')); ?>
                            <?php echo $form->error($user, 'username'); ?>
                        </div>
                    </div>
                    <br/>
                    <br/>
<!--                    <div class="row" style="margin-bottom: 10px;">
                        <div class='col-sm-12' >
                            <a  href="/login" style='color:#ea8417;'><?php //echo Yii::t('youtoo', 'Remember your password?'); ?></a>
                        </div>
                    </div>-->
                    <div class='row'>
                        <div class="col-sm-12">
                            <?php echo $form->hiddenField($user, 'source', array('value' => 'web')); ?>
                            <input id="screen_width" type="hidden" name="screen_width" value="" />
                            <input id="screen_height" type="hidden" name="screen_height" value="" />
                            <?php echo CHtml::submitButton(Yii::t('youtoo', 'Sign Up'), array('class' => 'btn btn-default', 'role' => 'button', 'style' => 'width: 40%')); ?>
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
<?php //$this->renderPartial('/site/modalTerms', array()); ?>
<?php //$this->renderPartial('/site/modalPrivacy', array()); ?>
