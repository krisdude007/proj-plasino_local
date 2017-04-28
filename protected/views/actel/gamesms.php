<div id="pageContainer" class="container">
    <div class="subContainer">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <h1><?php echo $replyTitle; ?></h1>
        <?php if (isset($gamesms) && $gamesms == '#fetch'): ?>
                <p class="lead">
                    <h4><?php echo $reply; ?></h4>
                    <?php echo $description . '. ';
                    echo 'Type #answer<space> 1,2,3 or 4 for your choice'; ?>
                </p>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'user-smsgame-form',
                    //'action'=>Yii::app()->createUrl('/actel/ThankYou'),
                    'enableAjaxValidation' => false,
                    'clientOptions' => array(
                        'validateOnSubmit' => false,
                        'validateOnChange' => false,
                        'validateOnType' => false,
                    )
                ));
                ?>
                <div>&nbsp;</div>
                <p class="lead"><?php echo $reply; ?></p>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">Reply</span>
                    <?php
                    $params['class'] = 'form-control';
                    $params['placeholder'] = 'Type your sms here.';
                    ?>
                    <?php
                    if (!Yii::app()->user->isGuest) {
                        $params['value'] = Yii::app()->user->getUsername();
                    }
                    ?>
                    <?php echo CHtml::textField('gamesms', '', $params); ?>
                </div>
                <div>&nbsp;</div>
                <div>
                    <?php
                    echo CHtml::submitButton('Send', array('class' => 'btn btn-default btn-lg active',
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