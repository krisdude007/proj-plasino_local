<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('/webassets/js/jquery.oauthpopup.js', CClientScript::POS_END);
?>
<div id="content" style="text-align: left">
    <div style="padding:1% 1%;">
        <div style="width: 300px; margin: 0 auto;">
        <h1>UPLOAD VIDEOS</h1>
        <?php
        $this->renderPartial('/video/_formUploadVideo', array(
            'uploadvideo' => $uploadvideo,
        ));
        ?>
        </div>
    </div>
</div>