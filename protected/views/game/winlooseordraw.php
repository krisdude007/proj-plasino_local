<?php
$cs = Yii::app()->clientScript;
$cs->registerCoreScript('jquery', CClientScript::POS_END);
$stripe = StripeUtility::config();
?>

<?php
$anum = 0;
foreach ($game->gameChoiceAnswers as $answer) {
    if (in_array($answer->label, array('A', 'B', 'C', 'D'))) {
        $anum++;
    }
}
?>
<style>
    input[type=radio] {

        margin:20px;
        display:none;
    }

    input[type=radio] + label {
        display:inline-block;
        color: grey;
    }

    input[type=radio]:checked + label {
        background-image: none;
        background-color:#d0d0d0;
    }

/*    .count {
        color: #00cccc;
        margin-bottom: 10px;
    }*/

</style>

<div id="pageContainer" class="container" style='padding-right: 0px; padding-left: 0px;'>
    <div class='subContainer'>
        <?php $this->renderPartial('/site/_sideBar', array()); ?>

        <div class='row' style='margin-right: 0px;
margin-left: 0px;'>
            <div class="col-sm-12" style="padding-right: 0px; padding-left: 0px;top: -50px;">
                <div class="form" style="position: relative; top: 22px; min-height: 740px; background-color:#002E42; clear: both;">
                    <!--                <div class='gameEntry' style='width: 100%; background-color: #eeeeee; min-height: 299px; min-width: 823px;'>-->
                    <div class="game" class="fab-left fab-voting-left" style='clear: both;'>
                        <div class="col-xs-12 col-sm-12 col-lg-12" style="padding-left: 0px; padding-right: 0px; clear: both;">
                            <div id='resultCount' class='count' style="margin-top: 15px;">You have : <?php echo Yii::app()->session['noOfRemaining']; ?> answers left.</div>
                            <div class="table-responsive" style="height: 630px; overflow: auto; position: relative;  width: 98%; margin-top: 20px;">
                                <?php //var_dump(Yii::app()->session['choiceList']);  ?>
                                <table class="table">
                                    <thead style="background-color: #292929; border-color: #292929;">
                                        <tr>
                                            <th style="text-align: center; color: #ffffff; width: 40%;"><?php echo Yii::t('youtoo', 'Game Question') ?></th>
                                            <th style="text-align: center; color: #ffffff;"><?php echo Yii::t('youtoo', 'Game Answers') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q = 1;
                                        ?>
                                        <?php
                                        foreach ($games as $game) {
                                            ?>
                                            <tr class="<?php echo $q % 2 == 0 ? 'even' : 'odd'; ?>" style="cursor: default; border-top: 3px solid #292929;">
                                                <td class="alignLeft gamechoice-<?php echo $q; ?>" style="vertical-align: middle; text-align: left; color: #f9d83d; border-top: none; font-size: 15px;"><?php echo $game->question; ?></td>
                                                <td style="vertical-align: middle; border-top: none; border-right: 1px solid #424242; color: #ffffff;">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'htmlOptions' => array(),
    ));

    $answerArray = Array();
    $answerAutoArray = Array();
    $i = 1;
    $op = 1;

    if (Utility::isMobile()) {
        $source = 'mobile';
    } else {
        $source = 'web';
    }

    if (sizeof($game->gameChoiceAnswers) > 4) {
        $i = 1;
        echo '<div class="col-sm-11 ">';
        foreach ($game->gameChoiceAnswers as $ans) {
            if ($i < sizeof($game->gameChoiceAnswers) - 1) {
            echo '<button id="game_choice_answer_id_'.$ans->id.'" class="btn btn-primary" style="background-color: transparent; margin-right: 10px; margin-bottom: 5px;" onclick="submitChoice(this,'.$ans->id.', '.GameUtility::checkIfAnswerIsCorrect($ans->id).');">'.$ans->answer.'</button>';
            } 
            $i++;
        }
        echo $form->hiddenField($response, 'game_choice_id', array('value' => $game->id));
        echo $form->hiddenField($response, 'game_choice_answer_id', array('value' => $ans->id));
        echo '</div>';
        $op++;
    } else {
        $i = 1;
        echo '<div class="col-sm-11 ">';
        foreach ($game->gameChoiceAnswers as $ans) {
            if ($i < sizeof($game->gameChoiceAnswers) - 1) {
            echo '<button id="game_choice_answer_id_'.$ans->id.'" class="btn btn-primary" style="background-color: transparent; margin-right: 10px; margin-bottom: 5px;" onclick="submitChoice(this,'.$ans->id.', '.GameUtility::checkIfAnswerIsCorrect($ans->id).');">'.$ans->answer.'</button>';
            }
            $i++;
        }
        echo $form->hiddenField($response, 'game_choice_id', array('value' => $game->id));
        echo $form->hiddenField($response, 'game_choice_answer_id', array('value' => ''));
        echo '</div>';
        $op++;
    }
    echo $form->hiddenField($response, 'source', array('value' => $source));
    echo '<br/>';
    $this->endWidget();
    ?></td>
                                                    <?php
                                                    $q++;
                                                    ?>
                                            </tr>
                                                <?php
                                            }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function submitChoice(me, answerId, responseIsCorrect) {
        //console.log(responseIsCorrect);
            var row = $(me).closest("tr");
            if (responseIsCorrect === 1) {
            $(me).attr('style', $(me).attr('style') + 'background-color: yellow');
            row.css('background-color', '#142E02');
            $(me).siblings('#eGameChoiceResponse_game_choice_answer_id').each(function () {
                $(this).val(answerId);
                //console.log(this);
            });
        } else {
            $(me).attr('style', $(me).attr('style') + 'background-color: yellow');
            row.css('background-color', '#ff4c4c');
            $(me).siblings('#eGameChoiceResponse_game_choice_answer_id').each(function () {
                $(this).val(answerId);
            });
        }
    }
    
    var submittedAnswers = JSON.parse('<?php echo json_encode($_SESSION['choiceList']); ?>');
    for (i = 0; i < submittedAnswers.length; i++) {
        value = submittedAnswers[i].game_choice_answer_id;
        
        answerButton = $('#game_choice_answer_id_'+value);//console.log(answerButton);
        answerButton.attr('style', answerButton.attr('style') + 'background-color: yellow');
        var row = answerButton.closest("tr");
        row.css('background-color', '#142E02');
        $(row).find('button').each(function () {
                        $(this).prop('disabled',true);
                    });
    }

    $('form').submit(function (event) {
        thisform = this;
        //var row = $(this).closest("tr");
        
        $.ajax({
            type: 'post',
            url: '/game/ajaxWinLooseOrDraw',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.completed) {
                    window.location = "/index.php?f=g";
                }
                if (data.success) {
                    if (data.remainingSubmissions) {
                        countChoice = data.remainingSubmissions;
                        var divData = document.getElementById("resultCount");
                        if (countChoice === 1) {
                            divData.innerHTML = "You have : " + countChoice + " answer left.";
                        } else {
                            divData.innerHTML = "You have : " + countChoice + " answers left.";
                        }
                    }
                    
                    $(thisform).find('button').each(function () {
                        $(this).prop('disabled',true);
                    });
                }
                if (data.error) {
                    alert(data.error);
                }
            }
        });
        return false;
    });

</script>
