<div id="pageContainer" class="container">
    <div class="subContainer">
        <?php $this->renderPartial('_sideBar', array()); ?>
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <h3><?php echo Yii::t('youtoo', 'Purchase Successful!') ?></h3>
                <p class="lead">
                    <?php //echo Yii::t('youtoo','CONGRATS!')?> <?php echo Yii::t('youtoo', 'Your order has been placed.') ?>
                </p>
<!--                <p>
                    <a href="<?php //echo $this->createUrl('/printreceipt', array());  ?>" target="_blank" class="btn btn-default btn-md" style="margin-right: 10px;" role="button"><?php //echo Yii::t('youtoo','Print Confirmation Receipt') ?></a>
                    <a href="<?php //echo $this->createUrl('/site/index', array()); ?>" class="btn btn-default btn-md" role="button"><?php //echo Yii::t('youtoo', 'Click here to play') ?></a>
                </p>-->
            </div>
            <div style="margin-top: 20px;">
<!--                <span><img src="/webassets/images/laliga/image_friday-night-futbol.png" style="padding-right: 13px;"/></span>
 -->               <span><img src="/webassets/images/laliga/image_win-1000_congrats.png" style="padding-right: 13px;"/></span>
      <!--          <span><img src="/webassets/images/laliga/image_redeem-points_congrats.png"/></span>
    -->        </div>
            <div class='congrats-buttons' style="margin-bottom: 80px;">
                <div class='row col-sm-12' style='padding-right: 0px;'>
                 <span class='col-sm-4' style='padding-left: 0px; visibility: hidden;'><a class='btn btn-default btn-md' href=''></a></span>
                    <span class='col-sm-4'><a class='btn btn-default btn-md' href='<?php echo $this->createUrl('/site/index', array()); ?>'><?php echo Yii::t('youtoo','Play Now'); ?></a></span>
<!--                    <span class='col-sm-4'><a class='btn btn-default btn-md' href='<?php echo $this->createUrl('/redeem', array()); ?>'><?php echo Yii::t('youtoo','Shop Now'); ?></a></span>-->
                </div>
            </div>
        </div>
    </div>
</div>



