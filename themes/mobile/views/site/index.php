<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.countdown.min.js', CClientScript::POS_END);
?>

<?php
$currentMultipleChoiceGame = GameUtility::getCurrentMultipleChoiceGame($games);
$currentWinLooseOrDrawGame = GameUtility::getCurrentWinLooseOrDrawGame($games);
?>
<?php
$env = getenv('YOUTOO_ENVIRONMENT');
if ($env == 'aws-development') {
    $url1 = $currentMultipleChoiceGame['url'];
    $url2 = $currentWinLooseOrDrawGame['url'];
} else {
    $url1 = '/winlooseordraw/157';
    $url2 = '/winlooseordraw/155';
}
?>
<script>
    $(document).ready(function() {
        $("#next-game-ends").countdown("<?php echo date('Y/m/d H:i:s', strtotime($currentWinLooseOrDrawGame['close_date'])); ?>", function(event) {
            var format = "%H:%M:%S";

            //if(event.offset.days > 0) {
            format = '%-D día%!D ' + format;
            //}

            $(this).text(event.strftime(format));
        });
    });
</script>
<div class='as-table'>
    <div>
        <div class="homeTop" style="width: 55%; float: left;">
            <h4 style="margin-left: 15px; margin-bottom: 3px;"><?php echo Yii::t('youtoo', 'Participa antes de'); ?> <span style="background-color: #fbd927;"></span></h4>
        </div>
        <div class="homeTop" style="width: 45%; float: left; background-color: #fbd927; padding-bottom: 0px; padding-top: 26px;"><h4 id="next-game-ends" style="margin-left: 15px; margin-bottom: 3px; font-size: 16px; margin-top: -5px;"></h4></div>
    </div>
    <div style='position: relative;'>
        <a onclick="window.location = '<?php echo $url1; ?>'"><img src="/webassets/mobile/images/image_mobile_background-la-liga.png" style="width: 100%;"/></a>
        <a onclick="window.location = '/site/marketinglinks'" style="position: absolute; z-index: 1020; top:93%; left: 29%; color: #ffffff;font-size: 16px; text-shadow: 2px 2px 5px #000000;">¿Quieres saber m&#225;s?&nbsp;&nbsp;&nbsp;<img src="/webassets/mobile/images/Button_Yellow-Arrow.png"/></a>
    </div>
    <div class="homeFooter text-center as-table-row">
        <!--        <div style='height:34%; position: relative;'>
                    <div style='height:100%; position: relative;'>
                        <a onclick="window.location='<?php //echo $playButtonURL;   ?>'"><img src="/webassets/mobile/images/Icon_team_win.png" style="width: 100%;"/></a>
                    </div>
                </div>
                <div style='height:33%; position: relative;'>
                    <div style='height:100%;'>
                        <a class="btn btn-default btn-md <?php //echo $playFreeButtonStatus;   ?>" style="font-weight: 700; font-size: 15px; min-width: 150px; min-height: 37px; margin-top: 10px;" href="<?php //echo $this->createUrl($playFreeButtonURL, array());   ?>"><?php //echo Yii::t('youtoo', $playFreeButtonMessage);   ?></a>
                       <a onclick="window.location='<?php //echo $playButtonURL;   ?>'"><img class=homeImage src="/webassets/mobile/images/Image_Logo_Landing.png"/></a>
                    </div>
                </div>-->
        <div style='height:34%; position: relative;'>
            <div style='height:100%;'>
                <a onclick="window.location = '<?php echo $url2; ?>'"><img src="/webassets/mobile/images/Image_Mobile_Viernes-Futbolero.png" style="width: 100%;"/></a>
<!--                <a onclick="window.location='<?php //echo Yii::app()->createUrl('/redeem');   ?>'"><img src="/webassets/mobile/images/Icon_redeem.png" style="width: 100%;"/></a>-->
            </div>
        </div>
    </div>
</div>
