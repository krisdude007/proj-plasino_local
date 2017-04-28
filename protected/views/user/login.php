<div id="pageContainer" class="container">
    <div class="subContainer">
        <div class="row">
            <div>
                <?php
                if (Yii::app()->session['return'] == "actel/payment") {
                    ?>
                    <h1><?php echo Yii::t('youtoo', 'Play Now') ?></h1>
                    <p class="lead">
                        <?php echo GameUtility::getActiveGameDesc(); ?>
                    </p>
                    <?php if (isset($twitterSession)): ?>
                    <p>
                        <img src="/webassets/images/progress/1.png" style="max-width: 500px;"/>
                    </p>
                    <?php endif; ?>
                    <?php
                } else {
                    ?>
                    <h1><?php echo Yii::t('youtoo', 'You’re almost entered to win $3500 this week!'); ?></h1>
                    <p class="lead">
                        <?php echo "Thanks for your answer!  To complete your entry, log in or register to pay $1 below.";//echo GameUtility::getActiveGameDesc(); ?>
                    </p>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="row" style="max-width: 900px;margin: 0 auto;">
            <div class="col-sm-6" style="padding: 0 30px;">
                <h1 style="color:#df9721;"><?php echo Yii::t('youtoo', 'New Player') ?></h1>
                <div>&nbsp;</div>
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'action' => Yii::app()->createUrl('/user/register'),
                    'id' => 'user-register-form',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => true,
                        'validateOnType' => false,
                    ),
                    'htmlOptions' => array('autoComplete' => 'off'),
                ));
                ?>
                <p class="lead" style="margin-bottom: 10px;"><?php echo Yii::t('youtoo', 'Enter Email') ?></p>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">+</span>
                    <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => '')); ?>
                </div>
                <div>
                    <span class="help-block">
                        <?php echo $form->error($model, 'username'); ?>
                    </span>
                </div>

                <p class="lead" style="margin-bottom: 10px;"><?php echo Yii::t('youtoo', 'Password') ?></p>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => '')); ?>
                </div>
                <div>
                    <span class="help-block">
                        <?php echo $form->error($model, 'password'); ?>
                    </span>
                </div>
                <div class="input-group input-group-lg" style="text-align: left;width: 100%;">
                    <?php echo $form->checkBox($model, 'terms_accepted', array('checked' => '', 'value' => 1)); ?>
                    <?php echo Yii::t('youtoo', 'I agree to')?> <?php echo CHtml::link(Yii::t('youtoo', 'Terms of Use'), array('#'), array('data-toggle' => 'modal', 'data-target' => '#modalTerms')); ?> &nbsp;
                    <?php echo Yii::t('youtoo', ' & ')?> <?php echo CHtml::link(Yii::t('youtoo', 'Privacy Policy'), array('#'), array('data-toggle' => 'modal', 'data-target' => '#modalPrivacy')); ?>
                </div>
                <div>
                    <span class="help-block">
                        <?php echo $form->error($model, 'terms_accepted'); ?>
                    </span>
                </div>
                <div class="input-group input-group-lg" style="text-align: left;width: 100%;">
                    <?php echo $form->checkBox($model, 'age_accepted', array('checked' => '', 'value' => 1)); ?>
                    <?php echo Yii::t('youtoo', 'I am at least 21 years of age'); ?>
                </div>
                <div>
                    <span class="help-block">
                        <?php echo $form->error($model, 'age_accepted'); ?>
                    </span>
                </div>
                <?php echo $form->hiddenField($model, 'source', array('value' => 'web')); ?>
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
                <?php $this->endWidget(); ?>
                <div class="hidden-xs" style="position: absolute;right:0;top:0;">
                    <img src="/webassets/images/horizontalRule.png">
                </div>

            </div>

            <div class="col-sm-6" style="padding: 0 30px;">
                <h1 style="color:#df9721;"><?php echo Yii::t('youtoo', 'Login') ?></h1>
                <div>&nbsp;</div>
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'action' => Yii::app()->createUrl('/user/login'),
                    'id' => 'user-login-form',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => true,
                        'validateOnType' => false,
                    )
                ));
                ?>
                <p class="lead" style="margin-bottom: 10px;"><?php echo Yii::t('youtoo', 'Enter Email') ?></p>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">+</span>
                    <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => '')); ?>
                </div>
                <div>
                    <span class="help-block">
                        <?php echo $form->error($model, 'username'); ?>
                    </span>
                </div>

                <p class="lead" style="margin-bottom: 10px;"><?php echo Yii::t('youtoo', 'Password') ?></p>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => '')); ?>
                </div>
                <div>
                    <span class="help-block">
                        <?php echo $form->error($model, 'password'); ?>
                    </span>
                </div>
                <div style="text-align: left;">
                    <?php echo Yii::t('youtoo', 'You don&#39;t have a password?') ?> <a href="<?php echo $this->createUrl('/user/getpassword', array()); ?>"><?php echo Yii::t('youtoo', 'Get it here') ?></a>
                </div>
                <div>&nbsp;</div>
                <?php echo $form->hiddenField($model, 'source', array('value' => 'web')); ?>
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
                <?php $this->endWidget(); ?>

            </div>

        </div>
        <div style="margin:10px 0px 20px 0px;">Each entry earns you food, beverages, free play and merchandise from Laligas!</div>
    </div>
</div>
