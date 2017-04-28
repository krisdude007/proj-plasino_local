<div id="pageContainer" class="container">
    <div class="subContainer">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <br/>
                <div>
                  <?php
                            echo CHtml::submitButton(Yii::t('youtoo', 'Get temporary pin'), array('class' => 'btn btn-default btn-lg active',
                                'role' => 'button',
                                'onclick' => 'getOTPincode();',
                                ));
                   ?>
             </div>
                <h1><?php echo Yii::t('youtoo','Temporary Password')?></h1>
                <p class="lead">
                    <?php echo Yii::t('youtoo','A temporary pin will be sent to your mobile device')?>
                </p>
            </div>


        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2">
                <?php
                $testno = '111222333444';
                if ($phonenumber != $testno){
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'user-otp-form',
                    //'action'=>Yii::app()->createUrl('/game/multiple'),
                    'enableAjaxValidation' => false,
                    'clientOptions' => array(
                        'validateOnSubmit' => false,
                        'validateOnChange' => false,
                        'validateOnType' => false,
                    )
                ));
                } else {
                   $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'user-otp-form',
                    'action'=>Yii::app()->createUrl('/game/multiple'),
                    'enableAjaxValidation' => false,
                    'clientOptions' => array(
                        'validateOnSubmit' => false,
                        'validateOnChange' => false,
                        'validateOnType' => false,
                    )
                ));
                }
                ?>

                <div>&nbsp;</div>
                <p class="lead">
                    <?php echo Yii::t('youtoo','Please enter the pincode sent to your mobile:')?>
                </p>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon"><?php echo Yii::t('youtoo','Pin')?></span>
                    <?php $params['class'] = 'form-control';
                    $params['placeholder'] = '00000';
                    $params['style'] = 'padding: 10px 14px;';
                    ?>
                    <?php echo CHtml::textField('otpassword', '', $params); ?>
                </div>

                <div>&nbsp;</div>
                <div>
                    <input id="screen_width" type="hidden" name="screen_width" value="" />
                    <input id="screen_height" type="hidden" name="screen_height" value="" />
                    <?php echo CHtml::submitButton(Yii::t('youtoo','Submit'), array('class' => 'btn btn-default btn-lg active', 'role' => 'button')); ?>
                </div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>