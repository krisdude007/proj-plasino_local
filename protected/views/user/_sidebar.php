<div id="sidebar-wrapper" style='margin-left: -230px; overflow-y: hidden;'>
    <ul class="sidebar-nav" style="top: 20px;">
        <?php if (!Yii::app()->user->isGuest): ?>
            <li class="sidebar-brand" style="text-align: center; height: 40px; text-indent: 0px;"><a href="<?php echo $this->createUrl('/user/profile', array()); ?>" style="font-size: 17px; font-weight: 500;"><?php echo empty($this->user->first_name) ? '' : $this->user->first_name; ?> <?php echo empty($this->user->last_name) ? '' : $this->user->last_name; ?></a></li>
            <?php //$geoLocation = GeoUtility::GeoLocation(); ?>
            <?php //if ($geoLocation['isValid']): ?>
                <div style="text-align: center; color: #ffffff; font-size: 12px;"><?php echo Yii::t('youtoo', 'Game Credits'); ?> : <?php echo '<span style="color: #35aae5;">$' . GameUtility::getCashBalance(Yii::app()->user->getId()) . '</span>'; ?></div>
                <div style="text-align: center; color: #ffffff; font-size: 12px;"><?php echo Yii::t('youtoo', 'Bonus Bucks'); ?> : <?php echo '<span style="color: #35aae5;">' . ClientUtility::getTotalUserBalanceCredits() . '</span>'; ?></div>
                <a class="btn btn-default btn-sm startButton" style="text-indent: 0; line-height: normal; margin-top: 10px; font-size: 12px;" href="<?php echo $this->createUrl('/payment', array()); ?>"><?php echo Yii::t('youtoo', 'Add Funds'); ?></a><hr class='hr'/>
            <?php //endif; ?>
        <?php else: ?>
                <?php if (!Yii::app()->user->isGuest): ?>
                    <li class="sidebar-brand" style="text-indent: 30px; height: 55px;"><a href="<?php echo $this->createUrl('/user/profile', array()); ?>" style="font-size: 21px; font-weight: 500;"><?php echo Yii::t('youtoo', 'Join Now'); ?></a></li><li class="btn btn-default btn-sm startButton" style="text-indent: 0; line-height: normal;"><?php echo Yii::t('youtoo', 'Get Started'); ?></li><hr class='hr'/>
                <?php else: ?>
                    <!--<li class="sidebar-brand" style="text-indent: 30px; height: 55px;"><a href="<?php // echo $this->createUrl('/register', array()); ?>" style="font-size: 21px; font-weight: 500;"><?php // echo Yii::t('youtoo', 'Join Now'); ?></a></li>-->
                    <a class="btn btn-default btn-sm startButton" href='/login' style="text-indent: 0; line-height: normal;"><?php echo Yii::t('youtoo', 'Login Now'); ?></a><hr class='hr'/>
                <?php endif; ?>
        <?php endif; ?>
        <li><a href="<?php echo $this->createUrl('/site/index', array()); ?>"><?php echo Yii::t('youtoo', 'Main'); ?></a></li>
        <!--<li><a href="<?php // echo $this->createUrl('/site/redeem', array()); ?>"><?php // echo Yii::t('youtoo', 'Store'); ?></a></li>-->
        <li><a href="<?php echo $this->createUrl('/site/winners', array()); ?>"><?php echo Yii::t('youtoo', 'Winners'); ?></a></li>
<!--                <li><a href="#"><?php echo Yii::t('youtoo', 'Refer a Friend'); ?></a></li>-->
        <li><a href="<?php echo $this->createUrl('/site/faq', array()); ?>"><?php echo Yii::t('youtoo', 'FAQ'); ?></a></li>
        <li><a href="<?php echo $this->createUrl('/site/marketingpage', array()); ?>"><?php echo Yii::t('youtoo', 'Marketing Page'); ?></a></li>
<!--        <li class="<?php if ($this->activeNavLink == 'marketingpage' || $this->activeNavLink == 'marketingpage2'): ?>panel panel-default active<?php endif; ?>" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl11">
                    <span></span> <?php echo Yii::t('youtoo', 'How to play'); ?> <span class="caret"></span>
                </a>
                <?php if (Yii::app()->controller->id == 'site' && in_array(Yii::app()->controller->action->id, array('marketingpage', 'marketingpage2'))): ?>
                    <div id="dropdown-lvl11" class="panel-collapse in">
                    <?php else: ?>
                        <div id="dropdown-lvl11" class="panel-collapse collapse">
                        <?php endif; ?>
                        <div class="panel-body">
                            <ul class="nav navbar-nav" style="width: 100%;">
                                <li><a <?php if ($this->activeSubNavLink == 'marketingpage'): ?> class='active'<?php endif; ?> href="<?php echo $this->createUrl('/site/marketingpage', array()); ?>"><?php echo Yii::t('youtoo', 'Marketing Page'); ?></a></li>
                            </ul>
                        </div>
                    </div>
            </li>-->
        <?php if (!Yii::app()->user->isGuest): ?>
        <li class="panel panel-default active" id="dropdown">
            <a data-toggle="collapse" href="#dropdown-lvl1">
                <span></span> <?php echo Yii::t('youtoo', 'Account'); ?> <span class="caret"></span>
            </a>
            <?php if (Yii::app()->controller->id == 'user' && in_array(Yii::app()->controller->action->id, array('profile', 'password', 'credits', 'connections'))): ?>
                <div id="dropdown-lvl1" class="panel-collapse in">
                <?php else: ?>
                    <div id="dropdown-lvl1" class="panel-collapse collapse">
                    <?php endif; ?>
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
                            <li><a <?php if ($this->activeSubNavLink == 'profile'): ?><?php else: ?>style='color: #ffffff;'<?php endif; ?> <?php if ($this->activeSubNavLink == 'basicinfo'): ?>class='active'<?php endif; ?> href="<?php echo $this->createUrl('/user/profile', array()); ?>"><?php echo Yii::t('youtoo', 'Basic Info'); ?></a></li>
                            <li><a <?php if ($this->activeSubNavLink == 'password'): ?><?php else: ?>style='color: #ffffff;'<?php endif; ?> <?php if ($this->activeSubNavLink == 'password'): ?>class='active'<?php endif; ?> href="<?php echo $this->createUrl('/user/password', array()); ?>"><?php echo Yii::t('youtoo', 'Password'); ?></a></li>
                            <li><a <?php if ($this->activeSubNavLink == 'activity'): ?><?php else: ?>style='color: #ffffff;'<?php endif; ?> <?php if ($this->activeSubNavLink == 'activity'): ?>class='active'<?php endif; ?> href="<?php echo $this->createUrl('/activity', array()); ?>"><?php echo Yii::t('youtoo', 'History'); ?></a></li>
                            <li><a <?php if ($this->activeSubNavLink == 'credits'): ?><?php else: ?>style='color: #ffffff;'<?php endif; ?> <?php if ($this->activeSubNavLink == 'credits'): ?>class='active'<?php endif; ?> href="<?php echo $this->createUrl('/user/credits', array()); ?>"><?php echo Yii::t('youtoo', 'Credits'); ?></a></li>
                            <?php //$geoLocation = GeoUtility::GeoLocation(); if ($geoLocation['isValid']): ?>
                            <li><a <?php if ($this->activeSubNavLink == 'paymentinfo'): ?><?php else: ?>style='color: #ffffff;'<?php endif; ?> <?php if ($this->activeSubNavLink == 'paymentinfo'): ?>class='active'<?php endif; ?> href="<?php echo $this->createUrl('/payment', array()); ?>"><?php echo Yii::t('youtoo', 'Payment Method'); ?></a></li>
                            <?php //endif; ?>
<!--                            <li><a <?php //if ($this->activeSubNavLink == 'connections'): ?><?php //else: ?>style='color: #ffffff;'<?php //endif; ?> <?php //if ($this->activeSubNavLink == 'connections'): ?>class='active'<?php //endif; ?> href="<?php //echo $this->createUrl('/user/connections', array()); ?>"><?php //echo Yii::t('youtoo', 'Connections'); ?></a></li>-->
                            <li><a style='color: #ffffff;' href="<?php echo $this->createUrl('/user/logout', array()); ?>"><?php echo Yii::t('youtoo', 'Log Out'); ?></a></li>
                        </ul>
                    </div>
                </div>
        </li>
        <?php endif; ?>
    </ul>
</div>