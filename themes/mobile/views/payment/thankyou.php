<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class='as-table'>
    <div class="fabmob_content-container text-center">
        <div style="padding-top: 30px;">
            <h1 style="font-weight: 300; margin-bottom: 30px;"><?php echo Yii::t('youtoo', 'SUCCESS!!'); ?></h1>
            <h4 style="margin-bottom: 40px; line-height: 2;"><?php
                echo Yii::t('youtoo', "Your payment was processed successfully, and your funds have been<br/> deposited in your account.");?>
            </h4>
            <p>
            <?php if (!$game_id == 0): ?>
                <div>
                    <a href='<?php echo $this->createUrl('/winlooseordraw/' . $game_id, array()); ?>'><button class="btn btn-default" style="min-width: 165px; min-height: 45px; width: 100%;"><?php echo Yii::t('youtoo', 'Continue'); ?></button></a>
                </div>
            <?php else: ?>
                <div>
                    <a href='<?php echo $this->createUrl('/site/indexlinks', array()); ?>'><button class="btn btn-default" style="min-width: 165px; min-height: 45px; width: 100%;"><?php echo Yii::t('youtoo', 'Continue'); ?></button></a>
                </div>
                </p>
            <?php endif; ?>
            <br/>
            <br/>
        </div>
        <div style="margin-top: 30px;">
            <?php echo Yii::t('youtoo', 'If you have any questions, please click'); ?> <a href="<?php echo $this->createUrl('/site/faq', array()); ?>" style="color: #ea8417;"><?php echo Yii::t('youtoo', 'FAQ'); ?></a> <?php echo Yii::t('youtoo', 'and'); ?> <a href="#" data-toggle='modal' data-target ='#modalRules' style="color: #ea8417;"><?php echo Yii::t('youtoo', 'Rules'); ?></a> <?php echo Yii::t('youtoo', 'to learn how to play.'); ?>
            <br/><br/> <?php echo Yii::t('youtoo', 'Good luck and have fun.'); ?>
        </div>
    </div>
</div>
