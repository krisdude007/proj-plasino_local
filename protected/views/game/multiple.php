
<?php
$cs = Yii::app()->clientScript;
$cs->registerCoreScript('jquery', CClientScript::POS_END);
$stripe = StripeUtility::config();

$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.countdown.min.js', CClientScript::POS_END);
?>

<style>
    input[type=radio] {
        display:none;
        margin:20px;
    }

    input[type=radio] + label {
        display:inline-block;
    }

    input[type=radio]:checked + label {
        background-image: none;
        background-color:#d0d0d0;
    }

    #countdown {
        color: #8F090A;
        font-size: 25px;
        font-weight: bold;
    }
</style>

<?php

$months = array(1 => "Enero", 2 => "Febrero",3 => "Marzo",4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio",  8 => "Agosto", 9 => "Septiembre", 10=> "Octubre", 11=> "Noviembre", 12=> "Diciembre");
$days = array(1 => "Lunes", 2 => "Martes", 3 => "Miércoles", 4 => "Jueves",5 => "Viernes", 6 => "Sábado", 7 => "Domingo");

if($game->type == 'sub') {
    $gameCloseDate = $mainGame->close_date;
} else {
    $gameCloseDate = $game->close_date;
}

$dy = date("N", strtotime($gameCloseDate));
$mj = date("n", strtotime($gameCloseDate));

$day = $days[$dy];
$month = $months[$mj];

?>

<?php
$anum = 0;

foreach ($game->gameChoiceAnswers as $answer) {
    if (in_array($answer->label, array('A', 'B', 'C', 'D'))) {
        $anum++;
    }
}
?>

<div id="pageContainer" class="container" style='padding-right: 0px; padding-left: 0px;'>
    <div class='subContainer' style='max-height: 672px;'>
        <?php $this->renderPartial('/site/_sideBar', array()); ?>
        <div class="row" style='margin-right: -30px; margin-left: -36px; position: relative; top: -31px; left: -1px;background-color: #303030;'>
            <div class="col-sm-12" style='padding-right: 0px; padding-left: 0px; top: -30px;'>
                <div class='col-sm-2' style='padding-left:0px; margin-left: 10px; margin-top: 47px;' ><img src="/webassets/images/laliga/image_game-thumbnail.png"/></div>
                <div class='col-sm-8' style="text-align: left; margin-left: 71px; margin-top: 50px; padding-right: 0px; width: 56.73%; padding-left: 0px;"><h3 style='margin-top: 0px; font-size: 25px; color: #f9d83d; text-transform: uppercase;'><?php echo Yii::t('youtoo','La Isla El Reality') ?></h3>
<!--                    <p style='font-size: 10px; margin: 0px 0px 5px;'><?php echo Yii::t('youtoo', 'Each Friday, Azteca will air a Futbol Match. You have to pick the winner. It\'s only $1.00 to select<br/>your answer. If you are right, then your will entered to win the weekly prize for this game.'); ?></p>
                        <p style='font-size: 10px; margin: 0px 0px 5px;'>
                    <?php echo Yii::t('youtoo', 'Players for Game #1 will be able to choose from the two playing teams or a tie. Example:<br/>Choose Team A, Team B or Tie.') ?>
                    </p>-->
                </div>
                <script>
                    $(document).ready(function() {
                        $("#game-ends").countdown("<?php echo date('Y/m/d H:i:s', strtotime($gameCloseDate)); ?>", function(event) {
                            var format = "%H:%M:%S";

                            if (event.offset.days > 0) {
                                format = '%-D día%!D ' + format;
                            }

                            $(this).text(event.strftime(format));
                        });
                    });
                </script>
                <div class='col-sm-2' style='background-color: #474747;padding-left: 0px; padding-right: 0px; min-height: 150px; position: relative; left: 2px; top: 31px;'>
                    <div style='background-color: #222222;'><h4 style='margin-top: 0px; color: #f9d83d; font-size: 15px; padding: 5px;'><?php echo Yii::t('youtoo', 'Countdown'); ?></h4></div>
                    <div><h5 style='margin-top: 0px; color: #f9d83d; font-size: 10px; padding: 5px; text-align: center;'><?php echo $day.', '.$month. date(' d, Y g:i A T',strtotime($game->close_date)); ?></h5></div>
                    <div id="game-ends" style="font-weight: lighter; color: #ffffff; font-size: 16px;"></div>
                </div>
            </div>
        </div>
        <div class='row' style='margin-top: -30px;'>
            <div class="col-sm-12" style="padding-right: 0px; padding-left: 0px; left: -23px;top: -50px;">
                <div class="form" style="position: relative; top: -10px; min-width: 823px; background: url('/webassets/images/laliga/image_game-background.png') no-repeat; min-height: 600px; clear: both;">
                    <div class='col-sm-10 col-sm-offset-1' style='clear: both; padding-right: 0px; padding-left: 0px; margin-top: 25px; width: 84.03%; margin-left: 7.6122%;'>
                        <div class='col-sm-4' style="padding-left: 0px; padding-right: 0px; background-color: #002132; min-height: 100px;">
                            <?php echo '<h4 style="margin-top: 20px; margin-bottom: 0px; padding: 10px 0px 0px 0px; margin-left: 10px; font-size: 16px; color: #ffffff; font-weight: lighter;"><span style="color: #f9d83d;">' .($game->num_plays_free + $game->num_plays_paid)  . '</span><br/> ' . Yii::t('youtoo', 'Entries'). '</h4>'; ?>
                        </div>
                        <div class='col-sm-4' style='padding-left: 0px; padding-right: 0px; background-color: #00283c; min-height: 100px;'>
                            <?php echo '<h4 style="margin-top: 20px; margin-bottom: 0px; padding: 10px; font-size: 16px; color: #ffffff; font-weight: lighter;"><span style="color: #f9d83d;">' . '$'.$game->price . '</span><br/> ' . Yii::t('youtoo', 'Entry fee') . '</h4>'; ?>
                        </div>
                        <div class='col-sm-4' style="padding-left: 0px; padding-right: 0px; background-color: #002132; min-height: 100px;">
                            <?php echo '<h4 style="margin-top: 20px; margin-bottom: 0px; padding: 10px; font-size: 16px; color: #ffffff; font-weight: lighter;"><span style="color: #f9d83d;">' . $game->prize . '</span><br/> ' . Yii::t('youtoo', 'Total prize') . '</h4>'; ?>
                        </div>
                    </div>
                    <div class="game" class="fab-left fab-voting-left" style='clear: both;'>
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'game-choice-form',
                            'enableAjaxValidation' => true,
                            'enableClientValidation' => true,
                            'clientOptions' => array(
                                'validateOnSubmit' => true,
                            )
                        ));
                        echo '<div>&nbsp;</div>';
                        //echo '<div class="question">' . $game->question . '</div>';
                        //echo '<div class="description">' . $game->description . '</div>';
                        echo '<div class="question col-sm-10 col-sm-offset-1" style="font-size: 23px; font-weight: 500; padding-top: 30px; color: #ffffff; margin-bottom: 30px;">' . $game->question . '</div>';
                        $answerArray = Array();
                        $answerAutoArray = Array();
                        $i = 1;
                        foreach ($game->gameChoiceAnswers as $answer) {
                            if ($i < sizeof($game->gameChoiceAnswers) - 1) {
                                $answerArray[$answer->id] = $answer->answer;
                            }
                            $i++;
                        }
                        echo '<div class="col-sm-8 col-sm-offset-3">';
                        echo '<div class="options" style="text-align: left;">' . $form->radioButtonList($response, 'game_choice_answer_id', $answerArray, array('labelOptions' => array('style' => "display:inline;')", 'class' => 'btn btn-default btn-md', 'style' => 'min-width: 183px; min-height: 43px;font-size: 15px; padding: 12px 12px;margin-right: 15px; margin-bottom: 30px;'), 'template' => "{input} {label}", 'separator' => '&nbsp&nbsp;&nbsp;', 'onclick' => 'submitOption();')) . '</div>';
                        echo '</div>';
                        echo $form->error($response, 'game_choice_answer_id');
                        echo $form->hiddenField($response, 'game_choice_id', array('value' => $game->id));

                        if (Utility::isMobile()) {
                            $source = 'mobile';
                        } else {
                            $source = 'web';
                        }

                        echo $form->hiddenField($response, 'source', array('value' => $source));
                        ?>
                        <!--                        <div class="submit_button" style="clear:both">
                        <?php //echo CHtml::submitButton(Yii::t('youtoo', 'Submit Answer'), array('class' => 'btn btn-default btn-lg', 'id' => 'gamebutton')); ?>
                                                </div>-->
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function submitOption(){
    $('input[type=radio]').on('change', function() {
        $('#game-choice-form').submit();
    });
    }
</script>