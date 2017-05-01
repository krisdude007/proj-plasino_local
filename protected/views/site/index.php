<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.countdown.min.js', CClientScript::POS_END);

?>
<div id="pageContainer" class="container" style="padding-left: 0px; padding-right: 0px; background-color: #303030;"><?php //if(isset($_GET['f'])){ echo $_GET['f']; } exit;  ?>
    <div class="subContainer" style="padding: 0px;">
        <?php $this->renderPartial('_sideBar', array()); ?>

        <?php
            $url = '/pickgame';
        ?>
       

        <?php if (Yii::app()->user->isGuest): ?>
            <a href="<?php echo $url; ?>" class="no-decoration"><img src="/webassets/images/banners/main<?php echo (Yii::app()->language == 'en') ? '_eng' : ''; ?>.jpg" class="main-banner animated zoomInDown" style=""/>
            <div class="default-button">PLAY NOW</div>
            </a>
            <a href="/marketingpage"><span style="position: static;color: #ffffff;display: block;height: 20px;padding: 20px;font-weight: 500;"><?php echo Yii::t('youtoo','You want to know more?'); ?>&nbsp;&nbsp;&nbsp;<img src="/webassets/images/laliga/Button_Yellow-Arrow.png"/></span></a>
            <div style="position: relative; top: 15px;">
                <span><a href=<?php echo $url; ?>><img src="/webassets/images/banners/01<?php echo (Yii::app()->language == 'en') ? '_eng' : ''; ?>.png" style=""/></a></span>
                <!-- <span><a href="http://www.playsino.com"<?php // echo $currentWinLooseOrDrawGame['url']; ?>"><img src="/webassets/images/banners/02<?php // echo (Yii::app()->language == 'en') ? '_eng' : ''; ?>.jpg" style=""/></a></span> -->
            
            </div>
        <?php else: ?>
            <?php if (isset($_GET['f']) && $_GET['f'] == 'g'): ?>
            <h1 style="color: #ffffff;">You have got <i style="color: #ea8417;">"<?php echo isset($countCorrect) ? $countCorrect : '-'; ?>"</i> correct <?php echo ($countCorrect == 1) ? 'answer' : 'answers'; ?>. </h1>
                <div class='col-sm-12' style='padding-left: 12px; padding-right: 10px; clear: both; position: relative;'>
                    <!--<img src="/webassets/images/laliga/image_congrats<?php echo (Yii::app()->language == 'en') ? '_eng' : ''; ?>.png" style=" max-width: 100%; margin-bottom: 10px;"/>-->
                </div>
            <?php elseif (isset($_GET['f']) && $_GET['f'] == 'p'): ?>
                <div style="background-color: #f7f9fa; min-height: 235px; width: 97.4%; margin: 20px auto; padding-top: 1px;margin-left: 12px; margin-right: 10px;">
                    <h1 style="font-weight: 300; margin-bottom: 15px;"><?php echo Yii::t('youtoo', 'SUCCESS!!'); ?></h1>
                    <h4 style="margin-bottom: 10px; line-height: 2;"><?php
                        echo Yii::t('youtoo', "Your payment was processed successfully, and your funds have been<br/> deposited in your account.");
                        ?>
                    </h4>
                    <?php echo Yii::t('youtoo', 'If you have any questions, please click'); ?> <a href="<?php echo $this->createUrl('/site/faq', array()); ?>" style="color: #ea8417;"><?php echo Yii::t('youtoo', 'FAQ'); ?></a> <?php echo Yii::t('youtoo', 'and'); ?> <a href="#" data-toggle='modal' data-target ='#modalRules' style="color: #ea8417;"><?php echo Yii::t('youtoo', 'Rules'); ?></a> <?php echo Yii::t('youtoo', 'to learn how to play.'); ?>
                    <br/><br/> <?php echo Yii::t('youtoo', 'Good luck and have fun.'); ?>
                </div>
            <?php elseif (isset($_GET['f']) && $_GET['f'] == 't'): ?>
                <div style="background-color: #f7f9fa; min-height: 235px; width: 97.4%; margin: 20px auto; padding-top: 1px;margin-left: 12px; margin-right: 10px;">
                    <h1 style="font-weight: 300; margin-bottom: 15px;"><?php echo Yii::t('youtoo', 'TRIVIA SUCCESS!!'); ?></h1>
                    <h4 style="margin-bottom: 10px; line-height: 2;"><?php
                        echo Yii::t('youtoo', "Questions have been entered successfully");
                        ?>
                    </h4>
                    <?php echo Yii::t('youtoo', 'If you have any questions, please click'); ?> <a href="<?php echo $this->createUrl('/site/faq', array()); ?>" style="color: #ea8417;"><?php echo Yii::t('youtoo', 'FAQ'); ?></a> <?php echo Yii::t('youtoo', 'and'); ?> <a href="#" data-toggle='modal' data-target ='#modalRules' style="color: #ea8417;"><?php echo Yii::t('youtoo', 'Rules'); ?></a> <?php echo Yii::t('youtoo', 'to learn how to play.'); ?>
                    <br/><br/> <?php echo Yii::t('youtoo', 'Good luck and have fun.'); ?>
                </div>
            <?php else: ?>
                <a href="<?php echo $url; ?>" class="no-decoration"><img src="/webassets/images/banners/main<?php echo (Yii::app()->language == 'en') ? '_eng' : ''; ?>.jpg" class="animated zoomInDown" style=""/>
                 <div class="default-button">PLAY NOW</div>
                </a>
                <a href="/marketingpage"><span style="padding:10px;display:block;color: #ffffff;"><?php echo Yii::t('youtoo','You want to know more?'); ?>&nbsp;&nbsp;&nbsp;<img src="/webassets/images/laliga/Button_Yellow-Arrow.png"/></span></a>
                <div style="position: relative; top: 15px;">
                    <span><a href="/payment?ci=1"><img src="/webassets/images/banners/01<?php echo (Yii::app()->language == 'en') ? '_eng' : ''; ?>.png" class="small-banner-01" style=""/></a></span>
                    <!-- <span><a href="http://www.playsino.com"><img src="/webassets/images/banners/02<?php // echo (Yii::app()->language == 'en') ? '_eng' : ''; ?>.jpg"  class="small-banner-02" style=""/></a></span> -->

                      </div>
                      
            <?php endif; ?>
        <?php endif; ?>
        <script>
        </script>
        <div id="getting-started"></div>
        <?php if (isset($_GET['f']) && $_GET['f'] == 't'): ?>
            <h2 style='color: #ea8417;'><?php echo Yii::t('youtoo', 'Want to play?'); ?></h2>
            <a class="btn btn-default btn-lg startButton2" style="text-indent: 0; line-height: normal;margin-right: 10px;" href="<?php echo $this->createUrl('/pickgame', array()); ?>"><?php echo Yii::t('youtoo', 'Play Now'); ?></a>
            <!--<a class="btn btn-default btn-lg startButton2" style="text-indent: 0; line-height: normal;" href="<?php // Yii::app()->user->setReturnUrl(Yii::app()->request->getUrl()); ?>"><?php // echo Yii::t('youtoo', 'Return'); ?></a>-->
        <?php elseif (isset($_GET['f']) && $_GET['f'] == 'g'): ?>
            <h2 style='color: #ea8417;'><?php echo Yii::t('youtoo', 'Want to play again?'); ?></h2>
            <a class="btn btn-default btn-lg startButton2" style="text-indent: 0; line-height: normal;" href="<?php echo $this->createUrl('/pickgame', array()); ?>"><?php echo Yii::t('youtoo', 'Play Now'); ?></a>
        <?php elseif (Yii::app()->user->isGuest): ?>
           <!-- <h2 style='color: #ea8417;'><?php //echo Yii::t('youtoo', 'Is this your first time?'); ?></h2>-->
<!--            <a class="btn btn-default btn-lg startButton2" style="text-indent: 0; line-height: normal;" href="<?php //echo $this->createUrl('/register', array()); ?>"><?php //echo Yii::t('youtoo', 'Get Started'); ?></a>-->
        <?php else: ?>
            <h2 style='color: #ea8417;'><?php echo Yii::t('youtoo', 'Start Playing here.'); ?></h2>
            <a class="btn btn-default btn-lg startButton2" style="text-indent: 0; line-height: normal;" href="<?php echo $this->createUrl('/pickgame', array()); ?>"><?php echo Yii::t('youtoo', 'Play Now'); ?></a>
        <?php endif; ?>
    </div>
</div>
