<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.countdown.min.js', CClientScript::POS_END);

$nextGameCloseDate = $game->close_date;

$months = array(1 => "Enero", 2 => "Febrero",3 => "Marzo",4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio",  8 => "Agosto", 9 => "Septiembre", 10=> "Octubre", 11=> "Noviembre", 12=> "Diciembre");
$days = array(1 => "Lunes", 2 => "Martes", 3 => "Miércoles", 4 => "Jueves",5 => "Viernes", 6 => "Sábado", 7 => "Domingo");

$dy = date("N", strtotime($nextGameCloseDate));
$mj = date("n", strtotime($nextGameCloseDate));

$day = $days[$dy];
$month = $months[$mj];
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

</style>
<script>
    $(document).ready(function(){
          $("#next-game-ends").countdown("<?php echo date('Y/m/d H:i:s', strtotime($nextGameCloseDate)); ?>", function(event) {
              var format = "%H:%M:%S";

              //if(event.offset.days > 0) {
                format = '%-D día%!D ' + format;
              //}

              $(this).text(event.strftime(format));
          });
    });
  </script>
<div class='as-table'>
    <div style='margin-bottom: 10px;'>
        <div class="homeTop" style="width: 33%; max-height: 51px; float: left; background-color: #292929;">
            <h5 style="margin-left: 15px; margin-bottom: 6px; color: #ffffff;"><?php echo Yii::t('youtoo','Countdown'); ?> <span style="background-color: #fbd927;"></span></h5>
        </div>
        <div class="homeTop" style="width: 33%; max-height: 51px; float: left; background-color: #303030;">
            <h6 style="margin-left: 10px; margin-bottom: 0px; color: #f9d83d; font-size: 10px; text-align: center;"><?php echo $day.', '.$month. date(' d, Y g:i A T',strtotime($game->close_date)); ?> <span style="background-color: #fbd927;"></span></h6>
        </div>
        <div class="homeTop" style="width: 34%; float: left;max-height: 51px; min-height: 51px; background-color: #303030;"><h5 id="next-game-ends" style="margin-left: 25px; margin-bottom: 0px; font-size: 16px; color: #ffffff;"></h5></div>
    </div>
    <div class="fabmob_content-container text-center" style='padding: 0px; max-width: none;'>
        <?php //if($game->price != 0) { ?>
<!--        <div style="text-align: left;margin-top: 20px;"><h4 style='margin-top: 0px; font-size: 13px; font-weight: 400;padding: 0px 15px 0px;'><?php echo Yii::t('youtoo', 'Azteca Friday Night Futbol ') . $game->prize; ?></h4>
            <p style='font-size: 10px; margin: 0px 0px 5px; color: #474747; padding: 0px 15px 0px;'><?php //echo Yii::t('youtoo', 'Each Friday, Azteca will air a Futbol Match. You have to pick the winner. It\'s only $1.00 to select<br/>your answer. If you are right, then your will entered to win the weekly prize for this game.'); ?></p>
            <p style='font-size: 10px; margin: 0px 0px 5px; color: #474747; padding: 0px 15px 0px;'>
                <?php //echo Yii::t('youtoo', 'Players for Game #1 will be able to choose from the two playing teams or a tie. Example:<br/>Choose Team A, Team B or Tie.') ?>
            </p>
        </div>-->
        <?php // ?>
        <div style='background-color: #f9cb3d; width: 98.1%; max-height: 40px; min-height: 40px; clear: both; padding-bottom:5px; margin-left: 1%; margin-top: 2%;'>
                    <div class='col-sm-4' style="padding-left: 0px; padding-right: 0px; float: left; min-width: 33%; max-width: 33%; background-color: #002132; min-height: 70px; max-height: 70px;">
                        <?php echo '<h4 style="margin-top: 10px; margin-bottom: 0px; padding: 10px 0px 0px 0px; margin-left: 10px; font-size: 10px; color: #ffffff; font-weight: lighter;"><span style="color: #f9d83d;">' .($game->num_plays_free + $game->num_plays_paid)  . '</span><br/> ' . Yii::t('youtoo', 'Entries'). '</h4>'; ?>
                    </div>
                    <div class='col-sm-4' style='padding-left: 0px; padding-right: 0px; float: left; min-width: 33%; max-width: 33%; background-color: #00283c; min-height: 70px; max-height: 70px;'>
                         <?php echo '<h4 style="margin-top: 10px; margin-bottom: 0px; padding: 10px; font-size: 10px; color: #ffffff; font-weight: lighter;"><span style="color: #f9d83d;">' . '$'.$game->price . '</span><br/> ' . Yii::t('youtoo', 'Entry fee') . '</h4>'; ?>
                    </div>
                    <div  class='col-sm-4' style="padding-left: 0px; padding-right: 0px; float: left; min-width: 34%; max-width: 34%; background-color: #002132; min-height: 70px; max-height: 70px;">
                         <?php echo '<h4 style="margin-top: 8%; margin-bottom: 0px; padding: 10px; font-size: 10px; color: #ffffff; font-weight: lighter;"><span style="color: #f9d83d;">' . $game->prize . '</span><br/> ' . Yii::t('youtoo', 'Total prize') . '</h4>'; ?>
                    </div>
        </div>
        <div class="form" style='margin-top: 20px;'>
            <div class="game">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'game-choice-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    )
                ));
                echo '<div class="question" style="font-size: 21px; font-weight: 500; padding: 40px 30px 0px; color: #ffffff; margin-bottom: 45px;">' . $game->question . '</div>';
                $answerArray = Array();
                $answerAutoArray = Array();
                $i = 1;
                $op = 1;

                foreach ($game->gameChoiceAnswers as $answer) {
                    if ($i < sizeof($game->gameChoiceAnswers) - 1) {
                        $answerArray[$answer->id] = $answer->answer;
                    }
                    $i++;
                }
//
//                echo "<div class='optionsButton'>";
//                echo "<div style='padding: 30px; padding-top: 0px;'>";
//                echo "<img style='padding: 20px 58px 0px 0px;' src='/webassets/images/laliga/teamOption_1.png'/>";
//                echo "<img style='padding: 20px 58px 0px;' src='/webassets/images/laliga/teamOption_2.png'/>";
//                echo "<img style='padding: 20px 0px 0px 58px;' src='/webassets/images/laliga/teamOption_3.png'/>";
//                echo "</div>";

                echo $form->radioButtonList($response, 'game_choice_answer_id', $answerArray, array('labelOptions' => array('style' => "display:inline;')", 'class' => 'btn btn-default btn-md', 'style' => 'min-width: 183px; min-height: 43px;font-size: 15px; padding: 3% 1% !important; margin-bottom: 10px; margin-top: 10px;'), 'template' => "{input} {label}", 'onclick' => 'submitOption();'));
                echo "</div>";
                echo $form->error($response, 'game_choice_answer_id');
                echo $form->hiddenField($response, 'game_choice_id', array('value' => $game->id));
                $op++;
                if (Utility::isMobile()) {
                    $source = 'mobile';
                } else {
                    $source = 'web';
                }
                echo $form->hiddenField($response, 'source', array('value' => $source));
                ?>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<script>

    $('input[type=radio]').on('change', function() {
        $('#game-choice-form').submit();
    });
</script>
