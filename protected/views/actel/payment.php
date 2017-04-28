<?php
$cs = Yii::app()->getClientScript();
?>
<div id="pageContainer" class="container">
    <div class="subContainer">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <h1><?php echo Yii::t('youtoo', 'Payment Method') ?></h1>
                <?php if (isset(Yii::app()->session['twitter'])): ?>
                    <p>
                        <img src="/webassets/images/progress/3.png" style="max-width: 500px;"/>
                    </p>
                <?php endif; ?>
                <p class="lead">
                    <?php echo Yii::t('youtoo', 'Please authorize payment to be able to participate in the competition.') ?>
                </p>
            </div>
        </div>
        <?php
        $arr = array(
            'id' => 'user-payment-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
                'onsubmit' => 'return checkChecked();',
            ),
            'clientOptions' => array(

                'validateOnSubmit' => true,
                'validateOnChange' => false,
                'validateOnType' => false,
            )
        );

        $form = $this->beginWidget('CActiveForm', $arr);
        ?>
        <div class="row">
            <div style="max-width:800px;margin: 0 auto;">
                <div class="col-sm-offset-2 col-sm-8" style="text-align: left; font-weight: bold; margin-top: 20px;">Credit card</div>
                <div class="col-sm-offset-2 col-sm-8" style="text-align: right;"><img src="/core/webassets/images/creditcards.png" width="200"/></div>
                <div class="col-sm-offset-2 col-sm-8">
                    <div class="input-group input-group-md" style="width:100%;">
                        <span class="input-group-addon" style="width:30%;">Card number</span>
                        <?php
                        $params['class'] = 'form-control';
                        //$params['placeholder'] = 'XXXX - XXXX - XXXX - ' .$location->card;
                        //$params['maxlength'] = 16;
                        ?>
                        <?php echo $form->textField($location, 'card', $params, array('value' => '', 'maxlength' => 16)); ?>
                    </div>
                    <div>
                        <span class="help-block">
                            <?php echo $form->error($location, 'card'); ?>
                        </span>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-8">
                    <div class="col-sm-4" style="padding: 0px 0px 0px 0px;">
                        <div class="input-group input-group-md" style="width:100%;">
                            <?php echo CHtml::dropDownList('month', 'month', DateTimeUtility::monthsOfYear(), array('style' => 'width:100%;height: 34px;-webkit-appearance: menulist-button;')); ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-md" style="width:100%;">
                            <?php echo CHtml::dropDownList('year', 'year', DateTimeUtility::yearsThisAndNextTwenty(), array('style' => 'width:100%;height: 34px;-webkit-appearance: menulist-button;')); ?>
                        </div>
                    </div>
                    <div class="col-sm-4" style="padding: 0px 0px 0px 0px;">
                        <div class="input-group input-group-md" style="width:100%;">
                            <span class="input-group-addon" style="width:40%;">CVN</span>
                            <?php echo CHtml::textField('cvn', '', array('class' => 'form-control')); ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-8">&nbsp;</div>
                <div class="col-sm-offset-2 col-sm-8">
                    <div class="col-sm-6" style="padding: 0px 0px 0px 0px;">
                        <div class="input-group input-group-md" style="width:100%;">
                            <span class="input-group-addon" style="width:30%;">First Name</span>
                            <?php
                            $params['class'] = 'form-control';
                            ?>
                            <?php echo $form->textField($user, 'first_name', $params); ?>
                        </div>
                        <div>
                            <span class="help-block">
                                <?php echo $form->error($user, 'first_name'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6" style="padding: 0px 0px 0px 15px;">
                        <div class="input-group input-group-md" style="width:100%;">
                            <span class="input-group-addon" style="width:30%;">Last Name</span>
                            <?php
                            $params['class'] = 'form-control';
                            ?>
                            <?php echo $form->textField($user, 'last_name', $params); ?>
                        </div>
                        <div>
                            <span class="help-block">
                                <?php echo $form->error($user, 'last_name'); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-8" style="text-align: left; font-weight: bold; margin-top: 20px;">Billing Address</div>
                <div class="col-sm-offset-2 col-sm-8">&nbsp;</div>
                <div class="col-sm-offset-2 col-sm-8">
                    <div class="input-group input-group-md" style="width:100%;">
                        <span class="input-group-addon" style="width:30%;">Street</span>
                        <?php $params['class'] = 'form-control'; ?>
                        <?php echo $form->textField($location, 'address1', $params); ?>
                    </div>
                    <div>
                        <span class="help-block">
                        </span>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-8">
                    <div class="col-sm-4" style="padding: 0px 0px 0px 0px;">
                        <div class="input-group input-group-md">
                            <span class="input-group-addon" style="width:40%;">City</span>
                            <?php echo $form->textField($location, 'city', array('class' => 'form-control')); ?>
                        </div>
                        <div>
                            <span class="help-block">
                                <?php echo $form->error($location, 'city'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-md">
                            <span class="input-group-addon" style="width:40%;">State</span>
                            <?php echo $form->dropDownList($location, 'state', StateUtility::getNamesAbbreviation(), array('style' => 'width:100%; height: 34px; -webkit-appearance: menulist-button;')); ?>
                        </div>
                    </div>
                    <div class="col-sm-4" style="padding: 0px 0px 0px 0px;">
                        <div class="input-group input-group-md" style="width:100%;">
                            <span class="input-group-addon" style="width:40%;">Zip Code</span>
                            <?php echo $form->textField($location, 'postal_code', array('class' => 'form-control', 'maxlength' => 5)); ?>
                        </div>
                    </div>
                    <div>
                        <span class="help-block">
                            <?php echo $form->error($location, 'postal_code'); ?>
                        </span>
                    </div>
                </div>

                <div class="col-sm-offset-3 col-sm-6">

                </div>
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2">
                        <br/>
                        <div>
                        </div>
                    </div>
                </div>
                <div>
                    <?php
                    echo CHtml::checkBox('twitter_pay', empty($model) ? true : $model->authorize_pay, array('value' => '1',
                        'onclick' => '$("#pincode").addClass( "disabled" );',
                    ));
                    ?>
                    <?php echo Yii::t('youtoo', 'Check to authorize payment via Twitter-Pay'); ?>

                </div>
                <div>
                    <span class="help-block">
                        <div class="errorMessage" id="twitter_pay_error_mg" style=""></div>
                    </span>
                </div>
                <div>&nbsp;</div>
                <?php echo CHtml::submitButton(Yii::t('youtoo', 'Save'), array('class' => 'btn btn-default btn-md', 'role' => 'button', 'id' => 'pinSubmit')); ?>
                <?php $this->endWidget(); ?>
            </div>

        </div>
    </div>
</div>

<script>
    function twit_check(me) {
        checked = document.getElementById('');
    }

</script>
<script>
    function checkChecked() {
        if (!document.getElementById('twitter_pay').checked) {
            document.getElementById('twitter_pay_error_mg').innerHTML = 'Please Authorize payment via Twitter-Pay to continue';
            return false;
        }
        else{
            document.getElementById('twitter_pay_error_mg').innerHTML = '';
            return true;
        }
    }

</script>
