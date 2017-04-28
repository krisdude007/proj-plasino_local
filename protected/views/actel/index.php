<?php
$country = array(
    '' => Yii::t('youtoo', 'Select Country'),
    'uae' => Yii::t('youtoo','UAE'),
    'egypt' => Yii::t('youtoo','Egypt'),
    'qatar' => Yii::t('youtoo','Qatar'),
    'bahrain' => Yii::t('youtoo','Bahrain'),
    'iraq' => Yii::t('youtoo','Iraq'),
    'jordan' => Yii::t('youtoo','Jordan'),
    'oman' => Yii::t('youtoo','Oman'),
    'ksa' => Yii::t('youtoo','Saudi Arabia'),
);
$saudiOperators = array(
    '' => Yii::t('youtoo', 'Select Operator/Provider'),
    'zain' => Yii::t('youtoo','Zain'),
    'mobily' => Yii::t('youtoo','Mobily'),
    //'stc' => Yii::t('youtoo','STC'),
);
$egyptOperators = array(
    '' => Yii::t('youtoo', 'Select Operator/Provider'),
    //'etisalat' => Yii::t('youtoo','Etisalat'),
    'mobinil' => Yii::t('youtoo','Mobinil'),
    'vodafone' => Yii::t('youtoo','Vodafone'),
);
$uaeOperators = array(
    '' => Yii::t('youtoo', 'Select Operator/Provider'),
    'etisalat' => Yii::t('youtoo','Etisalat'),
    'du' => Yii::t('youtoo','DU'),
);
$qatarOperators = array(
    '' => Yii::t('youtoo', 'Select Operator/Provider'),
    'qtel' => Yii::t('youtoo','Qtel'),
    'vodafone' => Yii::t('youtoo','Vodafone'),
);
$bahrainOperators = array(
    '' => Yii::t('youtoo', 'Select Operator/Provider'),
    'batelco' => Yii::t('youtoo','Batelco'),
    //'zain' => Yii::t('youtoo','Zain'),
    'viva' => Yii::t('youtoo','Viva'),
);
$iraqOperators = array(
    '' => Yii::t('youtoo', 'Select Operator/Provider'),
    'asiacell' => Yii::t('youtoo','AsiaCell'),
//    'Iraqna' => Yii::t('youtoo','Iraqna'),
//    'korectel' => Yii::t('youtoo','korectel'),
//    'Sanatel' => Yii::t('youtoo','Sanatel'),
//    'Etisaluna' => Yii::t('youtoo','Etisaluna'),
    'zainiq' => Yii::t('youtoo','ZainIQ'),
);
$jordanOperators = array(
    '' => Yii::t('youtoo', 'Select Operator/Provider'),
    'zain' => Yii::t('youtoo','Zain'),
    'orange' => Yii::t('youtoo','Orange'),
    'umniah' => Yii::t('youtoo','Umniah'),
    'xpress' => Yii::t('youtoo','Xpress'),
    'jordantelecom' => Yii::t('youtoo','Jordan Telecom'),
);
$omanOperators = array(
    '' => Yii::t('youtoo', 'Select Operator/Provider'),
    'nawras' => Yii::t('youtoo','Nawras'),
    'omantel' => Yii::t('youtoo','Omantel'),
);
?>
<div id="pageContainer" class="container" style='min-height: 500px;'>
    <div class="subContainer">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <img src="/webassets/images/actel/slide1.png" style="margin-bottom: 20px;"/><br/>
<!--                <h1><?php echo Yii::t('youtoo', 'Payment method') ?></h1>-->
                <p class="lead">
                    <?php echo Yii::t('youtoo', 'Please verify your country and mobile provider in order to play the game!') ?>
                </p>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2">
                <?php
                $testno = '111222333444';

                $arr = array(
                    'id' => 'user-payment-form',
                    'enableAjaxValidation' => false,
                    'clientOptions' => array(
                        'validateOnSubmit' => false,
                        'validateOnChange' => false,
                        'validateOnType' => false,
                    )
                 );

                if ($user->username == $testno){
                    $arr['action'] = Yii::app()->createUrl('/actel/otp');
                }
                $form = $this->beginWidget('CActiveForm', $arr);
                ?>

                <div>&nbsp;</div>
                <p class="lead"><?php echo Yii::t('youtoo', 'Select Country') ?></p>
                <div class="input-group input-group-lg">
                    <?php echo $form->dropDownList($actelForm, 'country', $country, array('onchange' => 'countrySelected(this);')); ?>
                    <?php echo $form->error($actelForm, 'country'); ?>
                </div>

                <div>&nbsp;</div>
                <p class="lead"><?php echo Yii::t('youtoo', 'Select Operator') ?></p>
                <div class="input-group input-group-lg">
                    <?php echo $form->dropDownList($actelForm, 'operator', array()); ?>
                    <?php echo $form->error($actelForm, 'operator'); ?>
                </div>


                <div>&nbsp;</div>
                <p class="lead"><?php echo Yii::t('youtoo', 'Enter phone number') ?></p>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">+</span>
                    <?php
                    $params['class'] = 'form-control';
                    $params['placeholder'] = '+000-000-0000';
                    $params['readonly'] = 'true';
                    ?>
                    <?php
                    if (!Yii::app()->user->isGuest) {
                        $params['value'] = Yii::app()->user->getUsername();
                    }
                    ?>
                    <?php echo $form->textField($user, 'username', $params); ?>
                </div>
                <div>
                    <span class="help-block">
                        <?php echo $form->error($user, 'username'); ?>
                    </span>
                </div>


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
        </div>


    </div>
</div>
<script>
    var saudiOperators = <?php echo json_encode($saudiOperators) ?>;
    var egyptOperators = <?php echo json_encode($egyptOperators) ?>;
    var uaeOperators = <?php echo json_encode($uaeOperators) ?>;
    var qatarOperators = <?php echo json_encode($qatarOperators) ?>;
    var bahrainOperators = <?php echo json_encode($bahrainOperators) ?>;
    var iraqOperators = <?php echo json_encode($iraqOperators) ?>;
    var jordanOperators = <?php echo json_encode($jordanOperators) ?>;
    var omanOperators = <?php echo json_encode($omanOperators) ?>;

    var initCountry = document.getElementById('FormActelTransaction_country').value;
    var initOperator = document.getElementById('FormActelTransaction_operator').value;
    function countrySelected(me) {
        operator = document.getElementById('FormActelTransaction_operator');
        operator.options.length = 0;
        if (me.value === 'ksa') {
            for (var key in saudiOperators) {
                operator.options[operator.length] = new Option(saudiOperators[key], key);
            }
        }
        if (me.value === 'uae') {
            for (var key in uaeOperators) {
                operator.options[operator.length] = new Option(uaeOperators[key], key);
            }
        }
        else if (me.value === 'egypt') {
            for (var key in egyptOperators) {
                operator.options[operator.length] = new Option(egyptOperators[key], key);
            }
        }
        else if (me.value === 'qatar') {
            for (var key in qatarOperators) {
                operator.options[operator.length] = new Option(qatarOperators[key], key);
            }
        }
        else if (me.value === 'bahrain') {
            for (var key in bahrainOperators) {
                operator.options[operator.length] = new Option(bahrainOperators[key], key);
            }
        }
        else if (me.value === 'iraq') {
            for (var key in iraqOperators) {
                operator.options[operator.length] = new Option(iraqOperators[key], key);
            }
        }
        else if (me.value === 'jordan') {
            for (var key in jordanOperators) {
                operator.options[operator.length] = new Option(jordanOperators[key], key);
            }
        }
        else if (me.value === 'oman') {
            for (var key in omanOperators) {
                operator.options[operator.length] = new Option(omanOperators[key], key);
            }
        }
        //select back on change to initital select
        else if (me.value === initCountry) {
            operator.value = initOperator;
        }
    }
</script>
