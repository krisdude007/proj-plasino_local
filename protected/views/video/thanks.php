<div id="pageContainer" class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <h1><?php echo Yii::t('youtoo','CONGRATS!') ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <p><?php echo Yii::t('youtoo',"Your video has been submitted and will be approved shortly.") ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <a class="btn btn-default btn-lg active" href="<?php echo $this->createUrl('/site/redeem'); ?>"><?php echo Yii::t('youtoo','Back to Redeem') ?></a>
        </div>
    </div>
</div>