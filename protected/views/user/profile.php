<div id="pageContainer" class="container" style="padding-left: 0px; background-color: #ffffff; min-height: 655px;">
    <?php //$this->renderPartial('_top', array()); ?>
    <div class='subContainer' style="padding: 0px;">
        <?php $this->renderPartial('_sidebar', array()); ?>
        <div class="col-sm-10 col-xs-12 floatRight">
            <p>&nbsp</p>
            <h3 style="font-weight: 300; margin-bottom: 40px;"><?php echo Yii::t('youtoo', 'Basic Info'); ?></h3>
            <div class="form">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'user-profile-form',
                    'enableAjaxValidation' => true,
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                ));
                ?>
                <div class="col-sm-12 col-md-12">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default" style="background-color: #ffffff; border: none;">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-sm-4" style="text-align: left;"><?php echo Yii::t('youtoo', 'Name'); ?></div>
                                    <div class="col-sm-4" style="text-align: left;"><?php echo empty($this->user->first_name) ? '' : $this->user->first_name; ?> <?php echo empty($this->user->last_name) ? '' : $this->user->last_name; ?></div>
                                    <div class="col-sm-4" style="text-align: right;">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" class="btn btn-default btn-md" style="min-width: 120px;" data-parent="#accordion" href="#collapseOne"><?php echo Yii::t('youtoo', 'Edit'); ?></a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" style="margin-bottom: 20px;">
                                <div class="panel-body" style="background-color: #ffffff;">
                                    <div class="col-sm-3 col-sm-offset-1" style="margin-top: 30px;"><?php echo Yii::t('youtoo', 'First Name'); ?></div>
                                    <div class="col-sm-7" style='margin-top: 25px;'>
                                        <?php echo $form->textField($user, 'first_name', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'First Name'))); ?>
                                        <?php echo $form->error($user, 'first_name'); ?>
                                    </div>
                                    <div class="col-sm-3 col-sm-offset-1" style="margin-top: 30px;"><?php echo Yii::t('youtoo', 'Last Name'); ?></div>
                                    <div class="col-sm-7" style='margin-top: 25px;'>
                                        <?php echo $form->textField($user, 'last_name', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'Last Name'))); ?>
                                        <?php echo $form->error($user, 'last_name'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default" style="background-color: #ffffff; border: none;">
                            <div class="panel-heading" style="text-align: right;">
                                <div class="row">
                                    <div class="col-sm-4" style="text-align: left;"><?php echo Yii::t('youtoo', 'Email'); ?></div>
                                    <div class="col-sm-4" style="text-align: left;"><?php echo $userEmail->email; ?></div>
                                    <div class="col-sm-4" style="text-align: right;">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" class="btn btn-default btn-md" style="min-width: 120px;" data-parent="#accordion" href="#collapseTwo"><?php echo Yii::t('youtoo', 'Edit'); ?></a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" style="margin-bottom: 20px;">
                                <div class="panel-body" style="background-color: #ffffff;">
                                    <div class="col-sm-3 col-sm-offset-1" style="margin-top: 30px;"><?php echo Yii::t('youtoo', 'Email'); ?></div>
                                    <div class="col-sm-7" style='margin-top: 25px;'>
                                        <?php echo $form->textField($userEmail, 'email', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'Email'),'readonly'=> true)); ?>
                                        <?php echo $form->error($userEmail, 'email'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default" style="background-color: #ffffff; border: none;">
                            <div class="panel-heading" style="text-align: right;">
                                <div class="row">
                                    <div class="col-sm-4" style="text-align: left;"><?php echo Yii::t('youtoo', 'State'); ?></div>
                                    <div class="col-sm-4" style="text-align: left;"><?php echo $userLocation->address1. ', '.$userLocation->city. ', '. $userLocation->state . ' - '. $userLocation->postal_code; ?></div>
                                    <div class="col-sm-4" style="text-align: right;">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" class="btn btn-default btn-md" style="min-width: 120px;" data-parent="#accordion" href="#collapseThree"><?php echo Yii::t('youtoo', 'Edit'); ?></a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" style="margin-bottom: 20px;">
                                <div class="panel-body" style="background-color: #ffffff;">
                                    <div class="col-sm-3 col-sm-offset-1" style="margin-top: 30px;"><?php echo Yii::t('youtoo', 'Address'); ?></div>
                                    <div class="col-sm-7" style='margin-top: 25px;'>
                                        <?php echo $form->textField($userLocation, 'address1', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'Address'))); ?>
                                        <?php echo $form->error($userLocation, 'address1'); ?>
                                    </div>
                                    <div class="col-sm-3 col-sm-offset-1" style="margin-top: 30px;"><?php echo Yii::t('youtoo', 'City'); ?></div>
                                    <div class="col-sm-7" style='margin-top: 25px;'>
                                        <?php echo $form->textField($userLocation, 'city', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'City'))); ?>
                                        <?php echo $form->error($userLocation, 'city'); ?>
                                    </div>
                                    <div class="col-sm-3 col-sm-offset-1" style="margin-top: 30px;"><?php echo Yii::t('youtoo', 'Zip'); ?></div>
                                    <div class="col-sm-7" style='margin-top: 25px;'>
                                        <?php echo $form->textField($userLocation, 'postal_code', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'Zip'))); ?>
                                        <?php echo $form->error($userLocation, 'postal_code'); ?>
                                    </div>
                                    <div class="col-sm-3 col-sm-offset-1" style="margin-top: 30px;"><?php echo Yii::t('youtoo', 'State'); ?></div>
                                    <div class="col-sm-7" style='margin-top: 25px;'>
                                        <?php echo $form->dropDownList($userLocation, 'state', ClientUtility::getUSStates(), array('placeholder' => 'States', 'class' => 'form-control')); ?>
                                        <?php echo $form->error($userLocation, 'state'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default" style="background-color: #ffffff; border: none;">
                            <div class="panel-heading" style="text-align: right;">
                                <div class="row">
                                    <div class="col-sm-4" style="text-align: left;"><?php echo Yii::t('youtoo', 'Phone Number'); ?></div>
                                    <div class="col-sm-4" style="text-align: left;"><?php echo "(".substr($userLocation->phone_number, 0, 3).") ".substr($userLocation->phone_number, 3, 3)."-".substr($userLocation->phone_number,6); ?></div>
                                    <div class="col-sm-4" style="text-align: right;">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" class="btn btn-default btn-md" style="min-width: 120px;" data-parent="#accordion" href="#collapseFour"><?php echo Yii::t('youtoo', 'Edit'); ?></a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" style="margin-bottom: 20px;">
                                <div class="panel-body" style="background-color: #ffffff;">
                                    <div class="col-sm-3 col-sm-offset-1" style="margin-top: 30px;"><?php echo Yii::t('youtoo', 'Phone Number'); ?></div>
                                    <div class="col-sm-7" style='margin-top: 25px;'>
                                        <?php echo $form->textField($userLocation, 'phone_number', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'Phone Number'))); ?>
                                        <?php echo $form->error($userLocation, 'phone_number'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--                <div class="col-sm-6" style='margin-top: 5px;'>
                <?php //echo $form->labelEx($userLocation, 'address1'); ?>
                <?php //echo $form->textField($userLocation, 'address1', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'Address'))); ?>
                <?php //echo $form->error($userLocation, 'address1'); ?>
                                </div>
                                <div class="col-sm-6" style="overflow: hidden;margin-top: 5px;">
                <?php //echo $form->labelEx($user, 'gender'); ?>
                <?php //echo $form->dropDownList($user, 'gender', array('' => Yii::t('youtoo', 'Gender'), 'M' => Yii::t('youtoo', 'Male'), 'F' => Yii::t('youtoo', 'Female')), array('class' => 'form-control')); ?>
                <?php //echo $form->error($user, 'gender'); ?>
                                </div>
                                <div class="col-sm-6" style="overflow: hidden;margin-top: 5px;"><div>
                                        <div><?php //echo $form->labelEx($user, 'birthday');  ?></div>
                                        <div class="col-xs-4" style="padding-left: 0px;">
                <?php //echo $form->dropDownList($user, 'birthMonth', DateTimeUtility::monthsOfYear(), array('class' => 'form-control')); ?>
                                        </div>
                                        <div class="col-xs-4">
                <?php //echo $form->dropDownList($user, 'birthDay', DateTimeUtility::daysOfMonth(), array('class' => 'form-control')); ?>
                                        </div>
                                        <div class="col-xs-4">
                <?php //echo $form->dropDownList($user, 'birthYear', DateTimeUtility::yearsOfCentury(), array('class' => 'form-control')); ?>
                                        </div>
                <?php //echo $form->error($user, 'birthday'); ?>
                                    </div>
                                </div>-->
                <!--                <div class="col-sm-6" style="padding-top:4px;margin-top: 20px;">
                <?php //echo $form->labelEx($image, 'image'); ?>
                                    <img style="width:50px; height:50px;" src="<?php //echo UserUtility::getAvatar($user);  ?>" /><br/><br/>
                                    <label for="upload"><?php //echo Yii::t('youtoo', 'Update Photo')  ?></label><br/>
                <?php //echo $form->fileField($image, 'image'); ?>
                <?php //echo $form->error($image, 'image'); ?>
                                </div>-->
            </div>
            <br/>
            <div class="row text-center">
                <div class="col-sm-12" style="padding-top:4px;">
                    <?php
                    echo CHtml::submitButton(Yii::t('youtoo', 'Save'), array('class' => 'btn btn-default btn-lg',
                        'style' => 'font-weight: 200',
                        'role' => 'button'));
                    ?>
                    <?php echo CHtml::resetButton(Yii::t('youtoo','Reset'), array('class' => 'btn btn-default-inverse btn-lg', 'style' => 'margin-left: 20px;background-color: #eeeeee !important; border-color: grey; font-weight: 200;', 'role' => 'button', 'onclick' => 'collapseMe();')); ?>
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
        $('#collapseTwo').addClass('collapse').removeClass('in');
        $('#collapseThree').addClass('collapse').removeClass('in');
        $('#collapseFour').addClass('collapse').removeClass('in');
        return true;
    }

</script>
