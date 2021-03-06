<?php

$cs = Yii::app()->clientScript;
$cs->registerCssFile('/core/webassets/css/game/reveal.css');
$cs->registerCoreScript('jquery', CClientScript::POS_END);

?>

<style type="text/css">
    
</style>

<div>
    
    <?php 
    if($isSubmit)
    {
        echo 'Your answer has been recorded! Thank You';
    }
    else
    {
    ?>
    <div class="form">
        <div style="width:600px" class="fab-left fab-voting-left">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'game-choice-form',
                'enableAjaxValidation' => true,
            ));
            
            echo '<div>'.$game->question.'</div>';
            
            echo $form->radioButtonList($response, 'game_choice_answer_id', 
                                        array($game->gameChoiceAnswers[0]->id => $game->gameChoiceAnswers[0]->answer, 
                                              $game->gameChoiceAnswers[1]->id => $game->gameChoiceAnswers[1]->answer));
            echo $form->error($response, 'game_choice_answer_id');
            
            echo $form->hiddenField($response, 'game_choice_id', array('value' => $game->id));
            echo $form->hiddenField($response, 'source', array('value' => 'web'));

            ?>
            <div style="clear:both">
                <?php echo CHtml::submitButton('Submit'); ?>
            </div>
        </div>

        <?php $this->endWidget(); ?>
    </div>
    <?php
    }
    ?>
    
</div>
