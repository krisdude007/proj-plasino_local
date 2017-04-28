<?php
// page specific css
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery-ui-1.10.0.css');
Yii::app()->clientScript->registerScriptFile('http://cdn.jquerytools.org/1.2.7/all/jquery.tools.min.js', CClientScript::POS_END);
?>
<?php if (!Yii::app()->user->isGuest): ?>
   <div id="wrapper">
    <div id="pageContainer" class="container">
        <div class="subContainer">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                    <h1><?php echo Yii::t('youtoo', 'You are already registered') ?></h1>
                    <div>&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else : ?>
   <div id="wrapper">
    <div id="pageContainer" class="container">
        <div class="subContainer">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2">
                    <h1><?php echo Yii::t('youtoo', 'Registration') ?></h1>
                    <?php if(isset($_GET['actel'])): ?>
                    <?php echo '<h3>' . Yii::t('youtoo', 'Already have an account?'); ?> <a href="<?php echo $this->createUrl('/user/login?actel=1', array()); ?>" style="font-size: 25px;"><?php echo Yii::t('youtoo', 'Login Here') ?></a><?php echo '</h3>'; ?>
                    <?php else: ?>
                    <?php echo '<h3>' . Yii::t('youtoo', 'Already have an account?'); ?> <a href="<?php echo $this->createUrl('/user/login', array()); ?>" style="font-size: 25px;"><?php echo Yii::t('youtoo', 'Login Here') ?></a><?php echo '</h3>'; ?>
                    <?php endif; ?>
                    <div>&nbsp;</div>
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'user-register-form',
                        'enableAjaxValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                            'validateOnChange' => true,
                            'validateOnType' => false,
                        )
                    ));
                    ?>
                    <div>&nbsp;</div>
                    <p class="lead" style="margin-bottom: 10px;"><?php echo Yii::t('youtoo', 'Enter phone number') ?></p>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">+</span>
                        <?php echo $form->textField($user, 'username', array('class' => 'form-control', 'placeholder' => '000-00-000-0000')); ?>
                    </div>
                    <div>
                        <span class="help-block">
                            <?php echo $form->error($user, 'username'); ?>
                        </span>
                    </div>

                    <div>&nbsp;</div>
                    <p class="lead" style="margin-bottom: 10px;"><?php echo Yii::t('youtoo', 'Password') ?></p>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <?php echo $form->passwordField($user, 'password', array('class' => 'form-control', 'placeholder' => 'xxxxx')); ?>
                    </div>
                    <div>
                        <span class="help-block">
                            <?php echo $form->error($user, 'password'); ?>
                        </span>
                    </div>


                    <div>&nbsp;</div>
                    <div class="input-group input-group-lg">
                        <?php echo $form->checkBox($user, 'terms_accepted', array('checked' => '', 'value' => 1)); ?>
                        <?php echo CHtml::link(Yii::t('youtoo', 'I agree to terms of use'), array('#'), array('data-toggle' => 'modal', 'data-target' => '#modalTerms')); ?> &nbsp;
                        <?php echo CHtml::link(Yii::t('youtoo', 'And Privacy Policy'), array('#'), array('data-toggle' => 'modal', 'data-target' => '#modalPrivacy')); ?>
                    </div>
                    <div>
                        <span class="help-block">
                            <?php echo $form->error($user, 'terms_accepted'); ?>
                        </span>
                    </div>
                    <div class="input-group input-group-lg">
                        <?php echo $form->checkBox($user, 'age_accepted', array('checked' => '', 'value' => 1)); ?>
                        <?php echo Yii::t('youtoo', 'I am at least 21 years of age'); ?>
                    </div>
                    <div>
                        <span class="help-block">
                            <?php echo $form->error($user, 'age_accepted'); ?>
                        </span>
                    </div>

                    <?php echo $form->hiddenField($user, 'source', array('value' => 'web')); ?>
                    <input id="screen_width" type="hidden" name="screen_width" value="" />
                    <input id="screen_height" type="hidden" name="screen_height" value="" />
                    <div>&nbsp;</div>
                    <div>
                        <?php
                        echo CHtml::submitButton(Yii::t('youtoo', 'Submit'), array('class' => 'btn btn-default btn-lg active',
                            'role' => 'button'));
                        ?>
                    </div>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                    <?php $this->endWidget(); ?>
                </div>
                <div class="col-xs-3 hidden-xs" style="margin-top: 80px;">
<!--                    <h3 style="margin-bottom: 0px;"><?php //echo Yii::t('youtoo', 'Watch video to learn how to play') ?></h3>-->
                    <div>&nbsp;</div>
                    <a href="https://www.youtube.com/watch?v=tz9nTboYYk0" target="_blank"><img src="/webassets/images/previewIframe_old.png"/></a>
                    <div>&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
    </div> <!--end wrapper-->
<?php endif; ?>