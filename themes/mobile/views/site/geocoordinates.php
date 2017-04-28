<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.countdown.min.js', CClientScript::POS_END);
?>

<?php
    $playButtonMessage = "test";
    $playButtonURL = "";
    $playButtonStatus = "";

    $playFreeButtonURL = "";
    $playFreeButtonMessage = "";
    $playFreeButtonStatus = "";

    $geoLocation = GeoUtility::GeoLocation();

    foreach($games as $game) {
        if(date('U') > strtotime($game->open_date) && date('U') < strtotime($game->close_date)) {
            if(sizeof($game->gameChoiceAnswers) == 5) {
                $playButtonMessage = "Get Started";
                $playButtonURL = "/winlooseordraw/".$game->id;

                if(date('U') < strtotime($game->close_date)) {
                    $playButtonMessage = "Get Started";
                    $playButtonURL = "/winlooseordraw/".$game->id;
                } else {
                    $playButtonMessage = "Get Started";
                    $playButtonURL = "/winlooseordraw/.$game->id";
                    $playButtonStatus = "disabled";
                }

                if($geoLocation['isValid']) {

                }  else if($game->price > 0) {
                    $playButtonMessage = "Not Eligible";
                    $playButtonStatus = "disabled";
                }

                break;
            }
        }
    }

    foreach($games as $game) {
        if(date('U') < strtotime($game->close_date)) {
            if(sizeof($game->gameChoiceAnswers) != 5) {
                $nextGameCloseDate = $game->close_date;
                break;
            }
        }
    }

    foreach($games as $game) {
        if(date('U') > strtotime($game->open_date) && date('U') < strtotime($game->close_date)) {
            if(sizeof($game->gameChoiceAnswers) != 5) {
                $playFreeButtonURL = '/multiplechoice/'.$game->id;
                $playFreeButtonMessage = "Get Started";
                break;
            }
        }
    }

    if($playFreeButtonURL == "") {
        $playFreeButtonMessage = "Opening Soon";
        $playFreeButtonURL = "#";
        $playFreeButtonStatus = "disabled";
    }
 ?>
<script>
    $(document).ready(function(){
          $("#next-game-ends").countdown("<?php echo date('Y/m/d H:i:s', strtotime($nextGameCloseDate)); ?>", function(event) {
              var format = "%H:%M:%S";

              if(event.offset.days > 0) {
                format = '%-D day%!D ' + format;
              }

              $(this).text(event.strftime(format));
          });
    });
  </script>
<div class='as-table'>
    <div>
        <div class="homeTop" style="width: 60%; float: left;">
            <h4 style="margin-left: 40px; margin-bottom: 3px;">Participa antes de <span style="background-color: #fbd927;"></span></h4>
        </div>
        <div class="homeTop" style="width: 40%; float: left; background-color: #fbd927; padding-bottom: 0px; padding-top: 26px;"><h4 id="next-game-ends" style="margin-left: 25px; margin-bottom: 3px; font-size: 16px; margin-top: -5px;"></h4></div>
    </div>
    <div style='position: relative;'>
         <a onclick="window.location='<?php echo $playFreeButtonURL; ?>'"><img src="/webassets/mobile/images/image_mobile_background_landing.png" style="width: 100%;"/></a>
    </div>
    <div class="homeFooter text-center as-table-row">
<!--        <div style='height:34%; position: relative;'>
            <div style='height:100%; position: relative;'>
                <a onclick="window.location='<?php //echo $playButtonURL; ?>'"><img src="/webassets/mobile/images/Icon_team_win.png" style="width: 100%;"/></a>
            </div>
        </div>
        <div style='height:33%; position: relative;'>
            <div style='height:100%;'>
                <a class="btn btn-default btn-md <?php //echo $playFreeButtonStatus; ?>" style="font-weight: 700; font-size: 15px; min-width: 150px; min-height: 37px; margin-top: 10px;" href="<?php //echo $this->createUrl($playFreeButtonURL, array()); ?>"><?php //echo Yii::t('youtoo', $playFreeButtonMessage); ?></a>
               <a onclick="window.location='<?php //echo $playButtonURL; ?>'"><img class=homeImage src="/webassets/mobile/images/Image_Logo_Landing.png"/></a>
            </div>
        </div>-->
        <div style='height:34%; position: relative;'>
            <div style='height:100%;'>
                    <a onclick="window.location='<?php echo $playButtonURL; ?>'"><img src="/webassets/mobile/images/Icon_team_win.png" style="width: 100%;"/></a>
<!--                <a onclick="window.location='<?php //echo Yii::app()->createUrl('/redeem'); ?>'"><img src="/webassets/mobile/images/Icon_redeem.png" style="width: 100%;"/></a>-->
            </div>
        </div>

    </div>
</div>
<script>
    function showPopupWrap2(text) {
        $("#popupWrap2 .flashMobileContents2").html(text);
        $("#popupWrap2").css('display', 'table');
    }
</script>
