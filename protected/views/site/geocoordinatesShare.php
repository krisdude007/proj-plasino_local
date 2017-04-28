<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.countdown.min.js', CClientScript::POS_END);
?>

<div id="pageContainer" class="container" style="padding-left: 0px; padding-right: 0px; background: url('/webassets/images/laliga/image_game-background.png');">
    <div class="subContainer" style="padding: 0px;">
        <?php $this->renderPartial('_sideBar', array()); ?>

        <?php
        $geoLocation = GeoUtility::GeoLocation();
        $geoLocation['isOtherGeoLocationShare'] = 0;
        if($geoLocation['isOtherGeoLocationShare']) {
            $message = "Looks like your location or your ip address has changed, please wait a moment while we adjust our software.";
        } else {
            $message = "Please share your location at the top of the page.";
        }
        ?>

        <div style="text-align: center; color: #FFFFFF; margin: 150px 0px 0px 0px; font-weight: bold;"><?php echo $message; ?></div>
        <input id="game_id" type="hidden" name="game_id" value="<?php echo $game_id; ?>">
        <div><img src="/webassets/images/final_instructions.png" style="max-width: 450px; margin-top: 20px;"/></div>
    </div>
</div>

<script>
    function showPopupWrap2(text) {
        $("#popupWrap2 .flashMobileContents2").html(text);
        $("#popupWrap2").css('display', 'table');
    }
</script>
