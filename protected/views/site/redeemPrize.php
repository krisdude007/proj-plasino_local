<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('/webassets/js/jquery.elevateZoom.min.js');

$stripe = StripeUtility::config(); ?>

<div id="pageContainer">
    <div class="subContainer" style="padding:0px;">
        <?php $this->renderPartial('_sideBar', array()); ?>
        <div class="row" style="margin-left: -17px; margin-right: 10px;">
            <div class="col-xs-10 col-xs-offset-2" style="text-align: left;">
                <a href='/redeem' class="btn btn-default btn-md" style ='margin: 0px 25px; min-width: 61px;' role="button"><?php echo Yii::t('youtoo', '<') ?></a>
                <span class="col-md-12">
                    <div class="thumbnail" style="max-width:none; max-height: none; padding: 10px;">
                        <div class="col-sm-8" style="width: 60.667%">
                            <img class="img-responsive" id="productImage" style="max-height: 302px; max-width: 384px; width: 100%; padding: 10px; border: 1px solid #777979; margin-right: 0px; margin-left: 0px; height: 100%" src="<?php echo '/' . basename(Yii::app()->params['paths']['image']) . "/{$prize->image}" ?>" alt="...">
                        </div>
                        <div class="col-sm-4" style="width: 38.333%;">
                            <h3 style="margin-top: 0px; margin-bottom: 0px;"><?php echo $prize->name; ?></h3>
                            <div class="description"><?php echo $prize->description; ?></div>
                            <h4 style="margin-top: 0px; margin-bottom: 0px;"><?php echo Yii::t('youtoo','Price'); ?></h4>
                            <div class="description" style="margin: 0px;"><?php echo ($prize->credits_required == 1) ? (Yii::t('youtoo', '{value} Bonus Buck', array('{value}' => $prize->credits_required))) : (Yii::t('youtoo', '{value} Bonus Bucks', array('{value}' => $prize->credits_required))) ?></div>
                            <div style="margin-bottom: 5px;">or</div>
                            <div class="description">
                                <?php echo Yii::t('youtoo', '${value} with Credit Card/Paypal',array('{value}' => $prize->market_value)); ?>
                            </div>

                        </div>
                        <div class="caption" style="line-height: 1.029;">
                            <p>
                                <?php
                                $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'user-redeemPrize-form',
                                    'enableAjaxValidation' => false,
                                    'clientOptions' => array(
                                        'validateOnSubmit' => false,
                                        'validateOnChange' => false,
                                        'validateOnType' => false,
                                    )
                                ));
                                ?>
                                <?php echo $form->hiddenField($prize, 'id', array('value' => $prize->id)) ?>
                                <?php $balance = ClientUtility::getTotalUserBalanceCredits(); if ($balance < $prize->credits_required): ?>
                                    <?php echo CHtml::link(Yii::t('youtoo', 'Buy with credits'), array('#'), array('data-toggle' => 'modal', 'data-target' => '#modalRedeem', 'role' => 'button', 'class' => 'btn btn-default btn-lg', 'style' => 'margin: 20px 15px; min-width: 141px; font-weight: 300;')); ?>
                                <?php else: ?>
                                    <input class="btn btn-default btn-md" style ='margin: 15px 15px; min-width: 141px; font-weight: 300;' role="button" type="submit" value="<?php echo Yii::t('youtoo', 'Buy with Bonus Bucks') ?>">
                                <?php endif; ?>
                                <?php $this->endWidget(); ?>
                            <div class="col-sm-4" style="line-height: 0.129;">
                                 <span>
                                    <form action="/processstripeproduct/<?php echo $prize->id; ?>" method="post">
                                        <script src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
                                                data-key="<?php echo $stripe['publishable_key']; ?>"
                                                data-amount="<?php echo $prize->market_value * 100; ?>"
                                                data-name="iSweepsUSA"
                                                data-description="<?php echo $prize->name; ?>"
                                                data-locale="en"
                                                data-label="Pay with card"></script>
                                    </form>
                                     <p>&nbsp;</p>
                                </span>
<!--                                <span>
                                    <a id="paypal-express" style="font-size: 14pt;text-decoration: underline;" href="<?php //echo Yii::app()->createURL("/expressCheckOut/".$prize->tableName()."/$prize->market_value/$prize->id"); ?>"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" alt="Buy now with PayPal" /></a>
                                </span>-->
<!--                                <form id="paypal-payproduct-form" action="/processpaypalproduct/<?php //echo $prize->id; ?>" method="post">
                                        <?php //echo CHtml::link(Yii::t('youtoo', 'Pay Using Paypal'), array('#'), array('data-toggle' => 'modal', 'data-target' => '#modalPaypalDirect', 'class' => 'btn btn-default btn-sm')); ?>
                                </form>-->
                            </div>
                        </div>
<!--                        <div class='caption'><p><?php //echo 'Your Current balance is: <b style="color: #df9721;">'.(($balance['credits_total']>1) ? $balance['credits_total'].'</b> <i>credits</i>.' :  $balance['credits_total'].'</b> <i>credit</i>.');        ?></p></div>-->
                    </div>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-7 col-xs-offset-2" style="text-align: left; margin-bottom: 60px;">
                <hr style="margin-left: 18px;">
                <h4 style="margin-left: 18px;"><?php echo Yii::t('youtoo','Recommended Products for you'); ?></h4>
                <div class="thumbnail" style="max-width:none; max-height: none;">
                        <div class="col-sm-12">
                            <?php
                $prizeFormat = '
                    <span class="col-md-4" style="padding-left: 5px;">
                        <div class="thumbnail">
                            <div style="border: 1px solid #777979; min-height: 135px;">
                            <a href="%s">
                            <img class="img-responsive" style="max-height: none; min-height: 132px;" src="%s" alt="..."></a>
                            </div>
                        </div>
                     </span>
                ';
                if (sizeof($randomprizes > 0)) {
                    foreach ($randomprizes as $p) {
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'user-redeem-form',
                            'enableAjaxValidation' => false,
                            'clientOptions' => array(
                                'validateOnSubmit' => false,
                                'validateOnChange' => false,
                                'validateOnType' => false,
                            )
                        ));
                        if ($p->quantity > 0) {
                            echo sprintf(
                                    $prizeFormat, '/redeem/'.$p->id, '/' . basename(Yii::app()->params['paths']['image']) . "/{$p->image}"
                            );
                            $this->endWidget();
                        }
                    }
                }
                ?>
                        </div>
                </div>
              <a href="/redeem"><h4 style="margin-left: 24px;"><?php echo Yii::t('youtoo','See all'); ?></h4></a>
            </div>
        </div>
    </div>
</div>
<?php $this->renderPartial('/site/modalRedeem', array()); ?>
    <script>
    $('#productImage').mouseover(function () {
    /*class name 'zoomed' is just an indicator so we can determine if the image
     has been applied with elevateZoom */
    if($(this).hasClass('zoomed')){

        $('.zoomContainer').remove();
        $(this).removeClass('zoomed');
    }else{
        $(this).elevateZoom({
            zoomType: "lens",
            lensShape: "square",
            lensSize: 300
        });
        $(this).addClass('zoomed');
    }
});

    function showPopupWrap(text) {
        $("#popupWrap .flashMobileContents").html(text);
        $("#popupWrap").css('display', 'table');
    }

    function payPalDirect() {

        var request = $.ajax({
            url: '/user/ajaxPayPalDirect',
            type: 'POST',
            data: ({
                'amount': <?php echo $prize->market_value; ?>,
                'card_number': $('#card_number').val(),
                'expire_month': $('#expire_month').val(),
                'expire_year': $('#expire_year').val(),
                'cvv2': $('#cvv2').val(),
                'first_name': $('#first_name').val(),
                'last_name': $('#last_name').val(),
                'street_1': $('#street_1').val(),
                'city': $('#city').val(),
                'state': $('#state').val(),
                'postal_code': $('#postal_code').val(),
                'CSRF_TOKEN': getCsrfToken()
            }),
            success: function(data) {
                obj = $.parseJSON(data);
                if (obj.success) {
                    $('#modalPaypalDirect').modal('hide');
                    $('#paypal-payproduct-form').submit();
                }
                if (obj.error) {
                    $('#modalPaypalDirect').modal('hide');
                    showPopupWrap(obj.error);
                    $('.okButton').on('click', function(e) {
                        e.preventDefault();
                        //window.location.href = '/loginpay';
                    });
                }
            }
        });
    }

</script>

<?php //$this->renderPartial('/payment/paypaldirect', array()); ?>
