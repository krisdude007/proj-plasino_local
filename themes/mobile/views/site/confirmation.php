<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class='as-table'>
    <div class="fabmob_content-container text-center">
        <div style='position: relative;'>
            <h3><?php echo Yii::t('youtoo', 'Purchase Successful!') ?></h3>
            <p class="lead">
                <?php //echo Yii::t('youtoo','CONGRATS!') ?> <?php echo Yii::t('youtoo', 'Your order has been placed.') ?>
            </p>
            <img class=homeImage src="/webassets/images/laliga/confirm/<?php echo rand(1,3)?>.png"/>
        </div><br/>
        <div>
            <a href='<?php echo Yii::app()->createUrl('site/indexlinks'); ?>'><button class="btn btn-default" style="min-width: 145px; min-height: 40px; font-size: 16px; "><?php echo Yii::t('youtoo', 'Play Now'); ?></button></a>
        </div>
        <br/>
        <div>
            <a href='<?php echo Yii::app()->createUrl('/site/index'); ?>'><button class="btn btn-default" style="min-width: 145px; min-height: 40px; font-size: 16px; "><?php echo Yii::t('youtoo', 'View Games'); ?></button></a>
        </div>
        <br/>
        <div>
            <a href='<?php echo Yii::app()->createUrl('/redeem'); ?>'><button class="btn btn-default" style="min-width: 145px; min-height: 40px; font-size: 16px; "><?php echo Yii::t('youtoo', 'Shop Again'); ?></button></a>
        </div>
    </div>
</div>
