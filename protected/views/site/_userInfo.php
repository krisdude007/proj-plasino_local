<?php if (!Yii::app()->user->isGuest): ?>
    <li class="sidebar-brand" style="text-align: center; height: 40px; text-indent: 0px;"><a href="#" style="font-size: 17px; font-weight: 500;">
        <?php echo empty($this->user->first_name) ? '' : $this->user->first_name; ?> <?php echo empty($this->user->last_name) ? '' : $this->user->last_name; ?></a>
    </li>
    <?php if($geoLocation['isValid']): ?>
    <div style="text-align: center; color: #ffffff; font-size: 12px;"><?php echo Yii::t('youtoo', 'Cash Balance'); ?> : <?php echo '<span style="color: #f9d83d;">$' . GameUtility::getCashBalance(Yii::app()->user->getId()) . '</span>'; ?></div>
    <div style="text-align: center; color: #ffffff; font-size: 12px;"><?php echo Yii::t('youtoo', 'Credits'); ?> : <?php echo '<span style="color: #f9d83d;">' . ClientUtility::getTotalUserBalanceCredits() . '</span>'; ?></div>
    <a class="btn btn-default btn-sm startButton" style="text-indent: 0; line-height: normal; margin-top: 10px; font-size: 12px;" href="<?php echo $this->createUrl('/payment', array()); ?>"><?php echo Yii::t('youtoo', 'Add Funds'); ?></a>
    <?php endif; ?>
    <hr class='hr'/>
<?php else: ?>
    <li class="sidebar-brand" style="text-indent: 30px; height: 55px;"><a href="/register" style="font-size: 21px; font-weight: 500;"><?php echo Yii::t('youtoo', 'Join Now'); ?></a></li><a class="btn btn-default btn-sm startButton" style="text-indent: 0; line-height: normal;" href="<?php echo $this->createUrl('/login', array()); ?>"><?php echo Yii::t('youtoo', 'Get Started'); ?></a><hr class='hr'/>
<?php endif; ?>

