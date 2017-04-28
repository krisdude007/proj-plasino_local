<?php
$stripe = StripeUtility::config();
?>

<div id="pageContainer" class="container">
    <div class="subContainer">
        <div class="row">
            <div style="background-color: #fff; min-height: 278px; width: 100%; max-width: 662px; margin: 30px auto; padding-top: 30px;">
                <h1 style="font-weight: 300; margin-bottom: 30px;"><?php echo Yii::t('youtoo', 'SUCCESS!!'); ?></h1>
                <h4 style="margin-bottom: 40px; line-height: 2;"><?php
                    echo Yii::t('youtoo', "Your payment was processed successfully, and your funds have been<br/> deposited in your account.");
                    ?></h4>
                <!--                <div>
                                    <div style="margin: 20px 0px 20px 0px;">
                                        <form action="/processstripe/game_choice/<?php //echo $next_game_id;  ?>" method="post">
                                            <script src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
                                                    data-key="<?php //echo $stripe['publishable_key'];  ?>"
                                                    data-amount="100"
                                                    data-name="Baldini's"
                                                    data-description="At Home Sweepstakes"></script>
                                        </form>
                                    </div>
                                    <div><a style="font-size: 14pt;text-decoration: underline;" href="<?php //echo Yii::app()->createURL("/expressCheckOut/{$model->tableName()}/{$model->id}");  ?>"><img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-large.png" alt="PayPal" /></a></div>
                                </div>-->
                <?php //} ?>
                <p>
                    <?php if(!$game_id == 0): ?>
                    <a style="max-width: 114px; max-height: 37px; font-size: 15px;" href="<?php echo $this->createUrl('/winlooseordraw/'.$game_id, array()); ?>" class="btn btn-default btn-md" role="button"><?php echo Yii::t('youtoo', 'Continue') ?></a>
                    <?php else: ?>
                    <a style="max-width: 114px; max-height: 37px; font-size: 15px;" href="<?php echo $this->createUrl('/site/index', array()); ?>" class="btn btn-default btn-md" role="button"><?php echo Yii::t('youtoo', 'Continue') ?></a>
                </p><?php endif; ?>
                <br/>
<!--                <p>
                <?php //echo Yii::t('youtoo',"Remember, each dollar you spend earns you credits to exchange for beer, food, merchandise and free play at Baldinis.  At a minimum, you receive 2 beers or a burger basket for playing.");?>
                </p>-->
                <br/>
            </div>
            <div style="margin-top: 30px;">
                <?php echo Yii::t('youtoo','If you have any questions, please click'); ?> <a href="<?php echo $this->createUrl('/site/faq', array()); ?>" style="color: #ea8417;"><?php echo Yii::t('youtoo','FAQ'); ?></a> <?php echo Yii::t('youtoo','and'); ?> <a href="#" data-toggle='modal' data-target ='#modalRules' style="color: #ea8417;"><?php echo Yii::t('youtoo','Rules'); ?></a> <?php echo Yii::t('youtoo','to learn how to play.'); ?>
                <br/><br/> <?php echo Yii::t('youtoo','Good luck and have fun.'); ?>
            </div>
        </div>
    </div>
</div>
<?php $this->renderPartial('/site/modalRules', array()); ?>

<script>
            window.onload = function() {
                if ($('#modalMessage .modal-body').html().trim())
                    $('#modalMessage').modal('show');

                $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("toggled");
                });
            }
</script>
