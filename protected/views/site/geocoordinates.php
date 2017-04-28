<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.countdown.min.js', CClientScript::POS_END);

?>
<div id="pageContainer" class="container" style="padding-left: 0px; padding-right: 0px; background: url('/webassets/images/laliga/image_game-background.png')">
    <div class="subContainer" style="padding: 0px;">
        <?php $this->renderPartial('_sideBar', array()); ?>

        <div style="text-align: center; color: #FFFFFF; margin: 175px 0px 0px 0px; font-weight: bold;">Would you like to share your location to have an option to play payed games?</div>

        <div style="text-align: center; margin: 30px 0px 0px 0px;">
            <button class="btn btn-default btn-md" style="margin-right: 20px;" id="goToShareLocation">Yes, take me to share my location.</button>
            <button class="btn btn-default btn-md" id="notShareLocation">No</button>
            <input id="game_id" type="hidden" name="game_id" value="<?php echo $game_id; ?>">
        </div>

    </div>
</div>
