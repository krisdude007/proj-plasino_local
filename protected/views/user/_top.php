<div class="row">
    <div class='col-sm-10 col-sm-offset-2' style='margin-bottom: -50px;'>
<h3 style="font-weight: 300; margin-bottom: 40px;"><?php echo Yii::t('youtoo', 'Credits'); ?></h3>
    </div>
    <div class="col-sm-10 col-xs-12 col-sm-offset-2" style="overflow: hidden; margin-bottom: -20px;">
        <div class="col-xs-4"><br/><h6 style='font-weight: 300'><?php echo Yii::t('youtoo','Credits Spent')?>: <b style='font-size: 21px;font-weight: 100; color: #f17100;'> <?php echo '&nbsp;'. $this->userBalance['credits_spent']; ?></b></h6></div>
        <div class="col-xs-4"><br/><h6 style='font-weight: 300'><?php echo Yii::t('youtoo','Credits Earned')?>: <b style='font-size: 21px;font-weight: 100; color: #f17100;'> <?php echo '&nbsp;'. $this->userBalance['credits_earned']; ?></b></h6></div>
        <div class="col-xs-4"><br/><h6 style='font-weight: 300'><?php echo Yii::t('youtoo','Total Credits')?>: <b style='font-size: 21px;font-weight: 100; color: #f17100;'> <?php echo '&nbsp;'. $this->userBalance['credits_total']; ?></b></h6></div>
    </div>
</div>