<div id="pageContainer" class="container">
    <div class="subContainer">
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand" style="text-indent: 30px; height: 55px;"><a href="#" style="font-size: 21px; font-weight: 700;">Join Now</a></li><li class="btn btn-default btn-sm startButton" style="text-indent: 0; line-height: normal;">Get Started</li><hr class='hr'/>
                <li><a href="<?php echo $this->createUrl('/site/index', array()); ?>">Main</a></li>
                <li><a href="<?php echo $this->createUrl('/site/redeem', array()); ?>">Store</a></li>
                <li><a href="<?php echo $this->createUrl('/site/winners', array()); ?>">Winners</a></li>
                <li><a href="#">Refer a Friend</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <h1><?php echo Yii::t('youtoo','Welcome')?></h1>
                <p class="lead">
                    <?php echo Yii::t('youtoo','Sorry, game play is not currently open for this game.');?>
                     <?php echo Yii::t('youtoo','Please tune in at 11:00 CST or visit www.youtoo.com/game to see when the game starts'); ?>
                </p>

                <p class="lead">
                    <?php echo Yii::t('youtoo','Or')?>
                </p>

                <p class="lead">
                    <?php echo Yii::t('youtoo','Login to redeem credits')?>.
                </p>
                <p>
                    <a href="<?php echo $this->createUrl('/site/redeem', array()); ?>" class="btn btn-default btn-lg active" role="button"><?php echo Yii::t('youtoo','Redeem Credits')?></a>
                </p>
            </div>
        </div>
    </div>
</div>