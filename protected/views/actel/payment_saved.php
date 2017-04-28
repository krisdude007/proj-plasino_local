<?php
$cs = Yii::app()->getClientScript();


?>
<div id="pageContainer" class="container">
    <div class="subContainer">
        <div class="row">&nbsp;</div>
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
<!--                <img src="/webassets/images/actel/slide1.png" style="margin-bottom: 20px;"/><br/>-->
                <h1><?php echo Yii::t('youtoo', 'Saved Payment Method') ?></h1>
                <p class="lead">
                    <?php echo Yii::t('youtoo', 'You already have saved your card info. Please click "Next" to authorize payment to be able to participate in the competition.') ?>
                </p>
            </div>
        </div>
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
        ?>

         <div class="row">
             <div style="max-width:800px;margin: 0 auto;">
                 <b>Saved Payment Method:</b> Visa ending in <?php echo 'XXXX-XXXX-XXXX-'.substr($location->card, -4); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a href="<?php echo $this->createUrl('/actel/payment', array()); ?>" class="btn btn-default btn-sm active" role="button"><?php echo Yii::t('youtoo','Edit')?></a>
             </div>
<!--             <br/>
             <div style="max-width:800px;margin: 0 auto;">
                 <b>Saved Payment ZipCode:</b> <?php echo $location->postal_code; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <a href="<?php //echo $this->createUrl('/actel/payment', array()); ?>" class="btn btn-default btn-sm active" role="button"><?php //echo Yii::t('youtoo','Edit')?></a>
             </div>-->
         </div>

        <?php

        $form = $this->beginWidget('CActiveForm', $arr);
        ?>
        <div>&nbsp;</div>
        <?php $url = '';
        $game = eGameChoice::model()->multiple()->isActive()->with('gameChoiceAnswers:isCorrect')->find();
        $answers = eGameChoiceResponse::model()->recent()->findByAttributes(array('game_choice_id' => $game->id, 'user_id' => Yii::app()->user->getId()));
 //echo 'user: '.$answers->game_choice_answer_id;
 //echo "correct: ".$game->gameChoiceAnswers[0]->id;

        if ($answers->game_choice_answer_id == $game->gameChoiceAnswers[0]->id) {
             $url = $this->createUrl('/actel/thankyou');
        } else {
             $url = $this->createUrl('/actel/sorry');
        }
         ?>
        <a href="<?php echo $this->createUrl($url, array()); ?>" class="btn btn-default btn-lg active" role="button"><?php echo Yii::t('youtoo','Next')?></a>
        <?php $this->endWidget(); ?>
        <div class="row">&nbsp;</div>
        <div class="row">&nbsp;</div>
        <div class="row">&nbsp;</div>
        <div class="row">&nbsp;</div>
        </div>
    </div>
</div>
