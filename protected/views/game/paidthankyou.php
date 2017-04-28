
<?php
$cs = Yii::app()->clientScript;
$cs->registerCoreScript('jquery', CClientScript::POS_END);
$stripe = StripeUtility::config();

$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.countdown.min.js', CClientScript::POS_END);
?>

<?php
$nextGameCloseDate = $game->close_date;

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

<div id="pageContainer" class="container" style='padding-right: 0px; padding-left: 0px;'>
    <div class='subContainer' style='max-height: 672px;'>
        <?php $this->renderPartial('/site/_sideBar', array()); ?>
        <div class="row" style='margin-right: -30px; margin-left: -36px; position: relative; top: -31px; left: -1px;background-color: #303030;'>
            <div class="col-sm-12" style='padding-right: 0px; padding-left: 0px; top: -30px;'>
                <div class='col-sm-2' style='padding-left:0px; margin-left: 10px; margin-top: 47px;' ><?php if ($game->description == 'Liga MX - Sábado Estelar'):?><img src="/webassets/images/laliga/1.jpg"/><?php else:?><img src="/webassets/images/laliga/2.png"/><?php endif;?></div>
                <div class='col-sm-8' style="text-align: left; margin-left: 71px; margin-top: 50px; padding-right: 0px; width: 56.73%; padding-left: 0px;"><h4 style='margin-top: 0px; font-size: 15px; color: #f9d83d;'><?php echo Yii::t('youtoo', 'LIGA MX - ') . $game->prize; ?></h4>
                    <p style='font-size: 10px; margin: 0px 0px 5px; color: #ffffff;'><?php echo Yii::t('youtoo', 'Each Friday, Azteca will air a Futbol Match. You have to pick the winner. It\'s only $1.00 to select<br/>your answer. If you are right, then your will entered to win the weekly prize for this game.'); ?></p>
                    <p style='font-size: 10px; margin: 0px 0px 5px; color: #ffffff;'>
                        <?php echo Yii::t('youtoo', 'Players for Game #1 will be able to choose from the two playing teams or a tie. Example:<br/>Choose Team A, Team B or Tie.') ?>&nbsp;&nbsp;<a href="<?php echo $this->createUrl('/site/marketingpage', array()); ?>" style="cursor: pointer; position: relative; z-index: 1020;"><span style=" color: #f9d83d;">¿Quieres saber m&#225;s?&nbsp;&nbsp;<img src="/webassets/images/laliga/Button_Yellow-Arrow.png" style="height:9px;"/></span></a>
                    </p>
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
                <div class="form" style="position: relative; top: -10px; min-width: 823px; background: url('/webassets/images/laliga/image_background-la-liga.png') no-repeat; min-height: 600px; clear: both;">
                    <div class='col-sm-10 col-sm-offset-1' style='clear: both; padding-right: 0px; padding-left: 0px; margin-top: 25px; width: 84.03%; margin-left: 7.6122%;'>
                        <div class='col-sm-4' style="padding-left: 0px; padding-right: 0px; background-color: #002132; min-height: 100px;">
                            <?php echo '<h4 style="margin-top: 20px; margin-bottom: 0px; padding: 10px 0px 0px 0px; margin-left: 10px; font-size: 16px; color: #ffffff; font-weight: lighter;"><span style="color: #f9d83d;">' . ($game->num_plays_free + $game->num_plays_paid) . '</span><br/> ' . Yii::t('youtoo', 'Entries'). '</h4>'; ?>
                        </div>
                        <div class='col-sm-4' style='padding-left: 0px; padding-right: 0px; background-color: #00283c; min-height: 100px;'>
                            <?php echo '<h4 style="margin-top: 20px; margin-bottom: 0px; padding: 10px; font-size: 16px; color: #ffffff; font-weight: lighter;"><span style="color: #f9d83d;">' . '$'. $game->price . '</span><br/> ' . Yii::t('youtoo', 'Entry fee') . '</h4>'; ?>
                        </div>
                        <div class='col-sm-4' style="padding-left: 0px; padding-right: 0px; background-color: #002132; min-height: 100px;">
                            <?php echo '<h4 style="margin-top: 20px; margin-bottom: 0px; padding: 10px; font-size: 16px; color: #ffffff; font-weight: lighter;"><span style="color: #f9d83d;">' . $game->prize . '</span><br/> ' . Yii::t('youtoo', 'Total prize') . '</h4>'; ?>
                        </div>
                    </div>
                    <div class="game" class="fab-left fab-voting-left" style='clear: both;'>
                        <?php

                        echo '<div>&nbsp;</div>';
                        //echo '<div class="question">' . $game->question . '</div>';
                        //echo '<div class="description">' . $game->description . '</div>';
                        echo '<div class="question col-sm-10 col-sm-offset-1" style="font-size: 18px; font-weight: 500; padding-top: 20px; color: #ffffff; margin-bottom: 5px;">' . '¡Gracias por jugar!' . '</div>';
                        echo '<div class="question col-sm-10 col-sm-offset-1" style="font-size: 23px; font-weight: 500; padding-top: 20px; color: #ffffff; margin-bottom: 30px;">' . ' ¿Te gustaría jugar trivia por $1 y tener aún mas posibilidades de ganar?' . '</div>';
                        //$answerArray = Array();
                        //$answerAutoArray = Array();
                        //$i = 1;?>
                        <a href="/winlooseordraw/<?php echo $subgameId?>"><button class="btn btn-default btn-md" style="margin-right: 20px;" id="goToShareLocation"><?php echo Yii::t('youtoo','Sí, muéstrame la pregunta'); ?></button></a>
                        <a href="<?php echo Yii::app()->createUrl('/site/index'); ?>"><button class="btn btn-default btn-md" id="notShareLocation"><?php echo Yii::t('youtoo','No, ir a página principal'); ?></button></a>

                        <!--                        <div class="submit_button" style="clear:both">
                        <?php //echo CHtml::submitButton(Yii::t('youtoo', 'Submit Answer'), array('class' => 'btn btn-default btn-lg', 'id' => 'gamebutton')); ?>
                                                </div>-->
                    </div><br/>
                    <div class="col-sm-10 col-sm-offset-1">
                        <div style="text-align: center; color: #ffffff; font-size: 12px;"><?php echo Yii::t('youtoo', 'Cash Balance'); ?> : <?php echo '<span style="color: #35aae5;">$' . $balance . '</span>'; ?></div>
                        <div style="text-align: center; color: #ffffff; font-size: 12px;"><?php echo Yii::t('youtoo', 'Credits'); ?> : <?php echo '<span style="color: #35aae5;">' . $credits . '</span>'; ?></div>
                        <br/>
                        <a href="/payment?gid=<?php echo $subgameId; ?>"><button class="btn btn-default btn-md" style="margin-right: 20px;" id="goToShareLocation"><?php echo Yii::t('youtoo','Agregar más fondos'); ?></button></a>
                    </div>
                    <?php //$this->endWidget(); ?>
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