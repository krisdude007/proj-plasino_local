<?php
// page specific css
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery-ui-1.10.0.css');
Yii::app()->clientScript->registerScriptFile('http://cdn.jquerytools.org/1.2.7/all/jquery.tools.min.js', CClientScript::POS_END);
?>

<div id="pageContainer" class="container" style="padding-left: 0px; background-color: #ffffff; min-height: 655px;">
    <?php //$this->renderPartial('_top', array()); ?>
    <div class='subContainer' style="padding: 0px;">
        <?php $this->renderPartial('_sidebar', array()); ?>
        <div class="col-sm-10 col-xs-12 floatRight">
            <p>&nbsp</p>
            <h3 style="font-weight: 300; margin-bottom: 40px;"><?php echo Yii::t('youtoo', 'Change Password'); ?></h3>
            <div class="form">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'user-password-form',
                    'enableAjaxValidation' => true,
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                ));
                ?>
                <div class="col-sm-12 col-md-12">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default" style="background-color: #ffffff; border: none;">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-sm-4" style="text-align: left;"><?php echo Yii::t('youtoo', 'Password'); ?></div>
                                    <div class="col-sm-4" style="text-align: left;"></div>
                                    <div class="col-sm-4" style="text-align: right;">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" class="btn btn-default btn-md" style="min-width: 120px;" data-parent="#accordion" href="#collapseOne"><?php echo Yii::t('youtoo', 'Edit'); ?></a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" style="margin-bottom: 20px;">
                                <div class="panel-body" style="background-color: #ffffff;">
                                    <div class="col-sm-3 col-sm-offset-1" style="margin-top: 30px;"><?php echo Yii::t('youtoo', 'New Password'); ?></div>
                                    <div class="col-sm-7" style='margin-top: 25px;'>
                                        <?php echo $form->passwordField($user, 'newPassword', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'Password'))); ?>
                                        <?php echo $form->error($user, 'newPassword'); ?>
                                    </div>
                                    <div class="col-sm-3 col-sm-offset-1" style="margin-top: 30px;"><?php echo Yii::t('youtoo', 'Confirm Password'); ?></div>
                                    <div class="col-sm-7" style='margin-top: 25px;'>
                                        <?php echo $form->passwordField($user, 'newPasswordConfirm', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'Confirm Password'))); ?>
                                        <?php echo $form->error($user, 'newPasswordConfirm'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
            </div>
            <br/>
            <div class="row text-center">
                <div class="col-sm-12" style="padding-top:4px;">
                    <?php
                    echo CHtml::submitButton(Yii::t('youtoo', 'Save'), array('class' => 'btn btn-default btn-lg active',
                        'role' => 'button'));
                    ?>
                    <?php echo CHtml::resetButton(Yii::t('youtoo','Reset'), array('class' => 'btn btn-default btn-lg', 'style' => 'margin-left: 20px;background-color: #eeeeee !important; border-color: grey; font-weight: 200;', 'role' => 'button', 'onclick' => 'collapseMe();')); ?>
<!--                    <a class='btn btn-default btn-lg' style='margin-left: 20px;background-color: #eeeeee !important; border-color: grey;font-weight: 200;' type="button" onclick="window.location.href = '/user/profile'">Cancel</a>-->
                </div>
            </div>
            <p>&nbsp</p>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<script>
    function collapseMe() {
        $('#collapseOne').addClass('collapse').removeClass('in');
        return true;
    }

</script>
