<?php
$entryArr = array(
    1 => 'Up to one<br/> bonus entry',
    2 => 'Up to 1000<br/> bonus entries',
    3 => 'Up to 10,000<br/> bonus entries',
    4 => 'Up to 50,000<br/> bonus entries',
    5 => 'Up to 100,000<br/> bonus entries'
);
   
$scoreArr = array(
    1 => 'Up to one<br/> bonus entry',
    2 => 'Up to 1000<br/> bonus entries',
    3 => 'Up to 10,000<br/> bonus entries',
    4 => 'Up to 50,000<br/> bonus entries',
    5 => 'Up to 100,000<br/> bonus entries'
);
?>
<div id="pageContainer" class="container" style="min-height: 655px;">
    <div class="subContainer">
    <?php $this->renderPartial('/site/_sideBar', array('user' => $user)); ?>
        <div class="row">
            <a href="<?php echo Yii::app()->createUrl('/marketingpage'); ?>">
                <div class="col-sm-12 btn btn-default" style="background-color: grey !important; color: #ffffff !important; border-color: grey !important;">
                    HOW TO PLAY AND REVIEW THIS WEEKS QUESTIONS!
                </div>
            </a>
        </div>
        <hr/>
        <br/>
        <div class="row">
            <div class='col-sm-12'>
            <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <div class="paymentOptionsTop">
                        <div style="background-color: #f2f2f2;"><h3 class="changeText-<?php echo $gameArray[$i]; ?> " style="margin-top: 0px; min-height: 47px; font-size: 22px; padding-top: 5px; margin-bottom: 0px; font-weight: 300; cursor: default;"><?php echo $gameArray[$i]; ?> <?php echo ($gameArray[$i] > 1) ? 'questions' : 'question' ?></h3></div>
                        <div style='margin-top: 5px; cursor: default;'><?php echo $gameCreditArray[$i]; ?><br/><?php echo ($gameCreditArray[$i] == 1) ? Yii::t('youtoo', 'game credit') : Yii::t('youtoo', 'game credits'); ?></div><hr style="margin-top: 5px; margin-bottom: 5px;"/>
                        <div style="font-size: 10px; margin-bottom: 10px; cursor: default;"><?php echo Yii::t('youtoo', $entryArr[$i]); ?></div>                      
                        <div style="margin-top: 25px; margin-bottom: 10px;"><a id="entry<?php echo $i; ?>" href="/pickgame?noOfQs=<?php echo $gameArray[$i]; ?>" class="btn btn-default btn-md" style="min-width: 114px; min-height: 37px; background-color: #35A2CC !important; border-color: #35A2CC;"><?php echo Yii::t('youtoo', 'Select'); ?></a></div>
                    </div>
                <?php }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" style="background-color: #f6f6f6; margin-top: 10px; padding-left: 0px; padding-right: 0px;">
                <p class="lead" style="display: none;font-size: 13px; vertical-align: middle; padding-top: 15px; font-weight: 500;">
        <?php echo Yii::t('youtoo', '') ?><img style="margin-left: 10px;" src='/webassets/images/laliga/icon_x.png'/>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <h4 id="total" style="font-weight: 300; cursor: default;">Total: $5 for each game choice of questions, except for <b>1 question which is $1</b></h4>
                    <div style="max-width:100%;margin: 0 auto;">

                    </div>
                </div>
            </div>
            <hr/>
            <br/>
            <div class='row'>
                <div class='col-sm-5 col-sm-offset-1'>
                    <div class="paymentOptionsTop" style='border: 4px solid #308000;max-width:310px; min-height: 186px; margin-left: 15px;'>
                        <div style="background-color: #f2f2f2;"><h3 style="margin-top: 0px; min-height: 47px; font-size: 22px; padding-top: 5px; margin-bottom: 0px; font-weight: 300; cursor: default;">Click below for a Free Game Credit.</h3></div>
                        <div style='margin-top: 5px; cursor: default;'>Watch Promotion Video and you get<br/><b>1</b><br/><?php echo Yii::t('youtoo', 'game credit'); ?></div><hr style="margin-top: 5px; margin-bottom: 5px;"/>
                        <div style="font-size: 10px; margin-bottom: 10px; cursor: default;"><?php echo Yii::t('youtoo', 'Click Here for entry to the<br/>weekly freeroll'); ?></div>                      
                        <div style="margin-top: 25px; margin-bottom: 10px;"><a id="entry<?php echo $i; ?>" href="/freecredit" class="btn btn-default btn-lg" style="background-color: #F9D83D !important; border-color: #F9D83D;"><?php echo Yii::t('youtoo', 'Free Game Credit'); ?></a></div>
                    </div>
                </div>
                <div class='col-sm-5'>
                    <div class="paymentOptionsTop statistics"  style='border: 4px solid #f9d83d;max-width:310px; min-height: 239px; margin-left: 15px;'>

                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <span><a href="<?php echo Yii::app()->createUrl('/marketingpage'); ?>"> How to play?</a><a href="<?php echo Yii::app()->createUrl('/site/contact'); ?>"><h5 style="color: #ea8417;"><img style="vertical-align: baseline;" src="/webassets/images/laliga/icon_envelope.png"/>&nbsp; support@isweepsusa.com</h5></a></span>
                </div>
                <div class="col-sm-10 col-sm-offset-1">
                    <span><h8><img style="vertical-align: baseline;" src="/webassets/images/laliga/icon_lock.png"/>&nbsp; <?php echo Yii::t('youtoo', 'Each choice you pick is $5. You can pick any choice and play that number of questions. If you are low on balance, just add funds and you are good to go.'); ?></h8></span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.changeText-1').hover(
            function () {
                var $this = $('.statistics');
                $this.data('initialText', $this.text());
                $this.text("I'm replaced! - 1");
            },
            function () {
                var $this = $('.statistics');
                $this.text($this.data('initialText'));
            }
    );
    $('.changeText-5').hover(
            function () {
                var $this = $('.statistics');
                $this.data('initialText', $this.text());
                $this.text("I'm replaced! - 5");
            },
            function () {
                var $this = $('.statistics');
                $this.text($this.data('initialText'));
            }
    );
    $('.changeText-10').hover(
            function () {
                var $this = $('.statistics');
                $this.data('initialText', $this.text());
                $this.text("I'm replaced! - 10");
            },
            function () {
                var $this = $('.statistics');
                $this.text($this.data('initialText'));
            }
    );
    $('.changeText-15').hover(
            function () {
                var $this = $('.statistics');
                $this.data('initialText', $this.text());
                $this.text("I'm replaced! - 15");
            },
            function () {
                var $this = $('.statistics');
                $this.text($this.data('initialText'));
            }
    );
    $('.changeText-20').hover(
            function () {
                var $this = $('.statistics');
                $this.data('initialText', $this.text());
                $this.text("I'm replaced! - 20");
            },
            function () {
                var $this = $('.statistics');
                $this.text($this.data('initialText'));
            }
    );
</script>

