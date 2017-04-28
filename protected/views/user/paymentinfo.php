<?php
$cs = Yii::app()->getClientScript();


?>
<div id="pageContainer" class="container">
    <?php $this->renderPartial('_top', array()); ?>
    <div class="row">
        <div class="col-sm-3 col-xs-12 floatLeft">
            <?php $this->renderPartial('_sidebar', null); ?>
        </div>
        <div class="col-sm-9 col-xs-12 floatRight">
<!--                <img src="/webassets/images/actel/slide1.png" style="margin-bottom: 20px;"/><br/>-->
                <h1><?php echo Yii::t('youtoo', 'Payment Method') ?></h1>
                <p class="lead">
                    <?php echo Yii::t('youtoo', 'Please authorize payment to be able to participate in the competition!') ?>
                </p>
        <?php
        $arr = array(
            'id' => 'user-payment-form',
            'enableAjaxValidation' => false,
            'clientOptions' => array(
                'validateOnSubmit' => false,
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
                        //$params['placeholder'] = 'XXXX - XXXX - XXXX - XXXX';
                        //$params['readonly'] = 'true';
                        ?>
                        <?php
                        if (!Yii::app()->user->isGuest) {
                            $params['value'] = Yii::app()->user->getUsername();
                        }
                        ?>
                        <?php echo CHtml::textField('cardnumber', '', $params); ?>
                    </div>
                    <div>
                        <span class="help-block">
                            <?php //echo $form->error($user, 'username');  ?>
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
                    <div class="input-group input-group-md" style="width:100%;">
                        <span class="input-group-addon" style="width:30%;">Name on card</span>
                        <?php
                        $params['class'] = 'form-control';
                        ?>
                        <?php
                        if (!Yii::app()->user->isGuest) {
                            $params['value'] = Yii::app()->user->getUsername();
                        }
                        ?>
                        <?php echo CHtml::textField('nameoncard', '', $params); ?>
                    </div>
                    <div>
                        <span class="help-block">
                            <?php //echo $form->error($user, 'username');  ?>
                        </span>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-8" style="text-align: left; font-weight: bold; margin-top: 20px;">Billing Address</div>
                <div class="col-sm-offset-2 col-sm-8">&nbsp;</div>
                <div class="col-sm-offset-2 col-sm-8">
                    <div class="input-group input-group-md" style="width:100%;">
                        <span class="input-group-addon" style="width:30%;">Street</span>
                        <?php $params['class'] = 'form-control'; ?>
                        <?php echo CHtml::textField('street', '', $params); ?>
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
                            <?php echo CHtml::textField('city', '', array('class' => 'form-control')); ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-md">
                            <span class="input-group-addon" style="width:40%;">State</span>
                            <?php echo CHtml::dropDownList('state', 'state', StateUtility::getNamesAbbreviation(), array('style' => 'width:100%; height: 34px; -webkit-appearance: menulist-button;')); ?>
                        </div>
                    </div>
                    <div class="col-sm-4" style="padding: 0px 0px 0px 0px;">
                        <div class="input-group input-group-md" style="width:100%;">
                            <span class="input-group-addon" style="width:40%;">Zip Code</span>
                            <?php echo CHtml::textField('zip', '', array('class' => 'form-control')); ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-offset-3 col-sm-6">

                </div>
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2">
                        <br/>
                        <div>
                            <?php
//                            echo CHtml::submitButton(Yii::t('youtoo', 'Save'), array('class' => 'btn btn-default btn-lg',
//                                'id' => 'pincode',
//                                'role' => 'button',
//                                'onclick' => 'alert("Save Successful!");
//                                    $( "#pinSubmit" ).removeClass( "disabled" );
//                                    $("#twitter_pay").attr("disabled","disabled");
//                                    window.location.href = "/actel/thankyou";
//                                    return false;',
//                            ));
                            ?>
                        </div>
                    </div>
                </div>
<!--                <div class="row">
                    <div>&nbsp;</div>
                    <div>
                        <input id="screen_width" type="hidden" name="screen_width" value="" />
                        <input id="screen_height" type="hidden" name="screen_height" value="" />
                        <?php //echo CHtml::submitButton(Yii::t('youtoo', 'Submit'), array('class' => 'btn btn-default btn-lg', 'role' => 'button', 'id' => 'pinSubmit')); ?>
                    </div>-->
                </div>
                <?php $this->endWidget(); ?>
                <?php
                $arr = array(
                    'id' => 'user-twitterpay-form',
                    'enableAjaxValidation' => false,
                    'clientOptions' => array(
                        'validateOnSubmit' => false,
                        'validateOnChange' => false,
                        'validateOnType' => false,
                    )
                );

                $form = $this->beginWidget('CActiveForm', $arr);
                ?>
                <div class="col-sm-6 col-sm-offset-3">
                    <?php
                    echo CHtml::checkBox('twitter_pay', empty($model) ? true : $model->authorize_pay, array('value' => '1',
                        'onclick' => 'alert("Authorization Not Verified Via Twitter! Press Submit to continue.");$("#pincode").addClass( "disabled" );',
                    ));
                    ?>
                    <?php echo Yii::t('youtoo', 'Check to authorize payment via Twitter-Pay'); ?>
                    <div>&nbsp;</div>
                <?php echo CHtml::submitButton(Yii::t('youtoo', 'Save'), array('class' => 'btn btn-default btn-md', 'role' => 'button', 'id' => 'pinSubmit')); ?>
                <?php $this->endWidget(); ?>
                <div class="row">&nbsp;</div>
                </div>
            </div>
        </div>
     </div>
</div>
<script>
    function twit_check(me) {
        checked = document.getElementById('');
    }

</script>
