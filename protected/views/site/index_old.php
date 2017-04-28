<?php
//Yii::import('ext.EGeoIP');
//$geoIp = new EGeoIP();
$cs = Yii::app()->clientScript;
$cs->registerCoreScript('jquery', CClientScript::POS_END);
?>

<style type="text/css">
    .message {
        margin: 150px 0px 150px 0px;
        font-size: 25px;
        text-align: center;
        color: #5C5E5B;
    }

    .game {
        margin: 50px 0px 50px 0px;
        direction: ltr;
        text-align: center;
    }

    .game .question {
        margin: 0px 0px 30px 0px;
        font-size: 38px;
        text-align: center;
        font-weight: bold;
    }

    .game .description {
        font-size: 16px;
        font-weight: 200;
        line-height: 1.4;
        margin-bottom: 20px;
        color: #df9721;
    }

    .game .options {
        color: #ffffff;
        font-size: 20px;
        display:inline-block;
        margin: 10px auto;
        text-align: left;
    }

    .game .submit_button {
        margin: 50px 0px 0px 0px;
        text-align: center;
    }
</style>

<div id="pageContainer" class="container">
     <?php
//    if (!empty($_GET['ip'])) {
//        if (preg_match('!^([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3}$!', $_GET['ip'])) {
//            $ip_address = $_GET['ip'];
//        } else {
//            print ("invalid ip address");
//        }
//    } else {
//        $ip_address = $_SERVER['REMOTE_ADDR'];
//    }
//
//    $geoIp->locate($ip_address);
//
//    echo 'Information regarding IP: <b>' . $geoIp->ip . '</b><br/>';
//    echo 'City: ' . $geoIp->city . '<br>';
//    echo 'Region: ' . $geoIp->region . '<br>';
//    echo 'Area Code: ' . $geoIp->areaCode . '<br>';
//    echo 'Postal Code: ' . $geoIp->postalCode . '<br>';
//    echo 'DMA: ' . $geoIp->dma . '<br>';
//    echo 'Country Code: ' . $geoIp->countryCode . '<br>';
//    echo 'Country Name: ' . $geoIp->countryName . '<br>';
//    echo 'Continent Code: ' . $geoIp->continentCode . '<br>';
//    echo 'Latitude: ' . $geoIp->latitude . '<br>';
//    echo 'Longitude: ' . $geoIp->longitude . '<br>';
//    echo 'Currency Symbol: ' . $geoIp->currencySymbol . '<br>';
//    echo 'Currency Code: ' . $geoIp->currencyCode . '<br>';
//    echo 'Currency Converter: ' . $geoIp->currencyConverter . '<br/>';
//
//    echo 'Converting $10.00 to ' . $geoIp->currencyCode . ': <b>' . $geoIp->currencyConvert(10) . '</b><br/>';
//
//    echo '----------------------------------------';

    ?>
    <div class="form">
        <div class="game" class="fab-left fab-voting-left">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'game-choice-form',
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'clientOptions' => array(
                        'validateOnSubmit' => true,
                    )
            ));

    echo '<div class="question">' . $game->question . '</div>';

    echo '<div class="description">' . $game->description . '</div>';

            $answerArray = Array();
            $i = 0;
            foreach ($game->gameChoiceAnswers as $answer) {
                if($i < sizeof($game->gameChoiceAnswers)-1) {
                    $answerArray[$answer->id] = $answer->answer;
                }
                $i++;
            }

            echo '<div class="options">'.$form->radioButtonList($response, 'game_choice_answer_id', $answerArray).'</div>';

            echo $form->error($response, 'game_choice_answer_id');

            echo $form->hiddenField($response, 'game_choice_id', array('value' => $game->id));

     if (Utility::isMobile()) {
                $source = 'mobile';
            } else {
                $source = 'web';
            }

            echo $form->hiddenField($response, 'source', array('value' => $source));
            ?>
            <div class="submit_button" style="clear:both">
                <?php echo CHtml::submitButton(Yii::t('youtoo', 'Submit'), array('class' => 'btn btn-default btn-lg')); ?>
            </div>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>
