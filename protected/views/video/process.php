<?php
/* @var $this VideoController */
$cs = Yii::app()->getClientScript();
if(!file_exists(Yii::app()->params['paths']['video'].'/'.basename($videoInfo['videofile']))){
    $cs->registerScript('reloadVideo',"reloadVideo({$model->id});", CClientScript::POS_END);
}
?>
<div id="pageContainer" class="container">
    <div class="processing row" style="text-align: center;padding: 1%;">
        <div id="videoWindow" class="videoWindow col-sm-5 col-sm-offset-1">
            <?php
            $this->renderPartial('/video/_videoPlayer', array(
                'videoInfo' => $videoInfo,
            ));
            ?>
            <div><?php echo Yii::t('youtoo','Please review your video.'); ?></div>
            <div style="text-align:left;margin-top:4px;">
                <a href="/record" class="btn btn-default btn-lg active"><?php echo Yii::t('youtoo','Re-Record');?></a>
            </div>
        </div>
        <div class="entryWindow text-left col-sm-5">
            <?php
            $this->renderPartial('/video/_formProcess', array(
                'model' => $model,
            ));
            ?>
        </div>
    </div>
</div>