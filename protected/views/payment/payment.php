<?php
$cs = Yii::app()->getClientScript();
$stripe = StripeUtility::config();

$gameEntry = array (
    0 => 'Free with Code',
    5 => '$5 for 1 game',
    10 => '$10 for 2 games',
    25 => '$25 for 5 games',
    50 => '$50 for 10 games',
 );
?>

<!-- The required Stripe lib -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    // This identifies your website in the createToken call below
    Stripe.setPublishableKey('<?php echo $stripe['publishable_key']; ?>');

    $(document).ready(function() {
        var username = getCookie('username');
        if (username)
            document.getElementById('clientUser_username').value = username;
        var type = "<?php //echo $type;  ?>";
        var cashIndex = <?php echo $cashIndex; ?>;
        /*
         if (type == "l") {
         $('#register').hide();
         $('#login').show();
         $('#buttonLogin').prop('disabled', true);
         } else {
         $('#login').hide();
         $('#register').show();
         $('#buttonRegister').prop('disabled', true);
         }
         */

        if (parseInt(cashIndex) > 0) {
            $("#entry" + cashIndex).addClass('selected');
            $("#entry" + cashIndex).text('<?php echo Yii::t('youtoo','Selected'); ?>');
        }
    });

    var stripeResponseHandler = function(status, response) {
        var $form = $('#payment-form');

        if (response.error) {
            // Show the errors on the form
            $form.find('.payment-errors').text(response.error.message);
            //$form.find('button').prop('disabled', false);
            $('#paymentloging-form').find('button').prop('disabled', false);
        } else {
            // token contains id, last4, and card type
            var token = response.id;
            // Insert the token into the form so it gets submitted to the server
            //$form.append($('<input type="hidden" name="stripeToken" />').val(token));
            // and re-submit

            //if ($('#tab-login').is(":visible"))
            //{
            $('#user-login-register-pay-form').append($('<input type="hidden" name="stripeToken" />').val(token));
            $('#user-login-register-pay-form').append($('<input type="hidden" name="amount" />').val());
            $('#user-login-register-pay-form').submit();
            //}
            //else {
            //    $('#user-register-form').append($('<input type="hidden" name="stripeToken" />').val(token));
            //    $('#user-register-form').submit();
            //}

            //$form.get(0).submit();
        }
    };

    jQuery(function($) {


        /*
         $("#buttonLogin").click(function(e) {
         $('#register').hide();
         $('#login').show();
         $(this).prop('disabled', true);
         $('#buttonRegister').prop('disabled', false);
         });

         $("#buttonRegister").click(function(e) {
         $('#login').hide();
         $('#register').show();
         $(this).prop('disabled', true);
         $('#buttonLogin').prop('disabled', false);
         });
         */

        //$('#payment-form').submit(function(e) {
        $('#paymentloging-form').submit(function(e) {
            var $form = $('#payment-form');

            // Disable the submit button to prevent repeated clicks
            //$form.find('button').prop('disabled', true);
            $('#paymentloging-form').find('button').prop('disabled', true);
            setTimeout(function() {
                $('#paymentloging-form').find('button').removeAttr('disabled');
            }, 3000)

            Stripe.card.createToken($form, stripeResponseHandler);

            // Prevent the form from submitting with the default action
            return false;
        });
    });
    function yesNoClick(me) {
        setCookie('username', document.getElementById('clientUser_username').value);
        if (me.value === '1') {
            window.location.href = '<?php echo Yii::app()->createUrl('/user/loginpay') ?>';
        }
        else {
            window.location.href = '<?php echo Yii::app()->createUrl('/user/registerpay') ?>';
        }
    }

    function showPopupWrap(text) {
        $("#popupWrap .flashMobileContents").html(text);
        $("#popupWrap").css('display', 'table');
    }

    function payPalDirect() {

        var request = $.ajax({
            url: '/user/ajaxPayPalDirect',
            type: 'POST',
            data: ({
                'amount': <?php echo $payCashArray[$cashIndex]; ?>,
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
                    $('#paypal-prepay-form').submit();
                }
                if (obj.error) {
                    $('#modalPaypalDirect').modal('hide');
                    showPopupWrap(obj.error);
                    $('.okButton').on('click', function(e) {
                        e.preventDefault();
                        window.location.href = '/payment';
                    });
                }
            }
        });
    }
</script>
  <div id="wrapper" style="background-color: #303030;">
<div id="pageContainer" class="container" style="padding-left: 0px;">
    <div class="subContainer" style="padding: 0px;">
        <?php $this->renderPartial('/site/_sideBar', array('user' => $user)); ?>
        <?php //$geoLocation = GeoUtility::GeoLocation();if($geoLocation['isValid']): ?>
       
           
           <div class="row" style="margin-right:0; margin-left:0;">
<!--           <div class="col-sm-2"></div>-->
            <div class="prices-grid" style="">
                <?php for ($i = 1; $i <= 1; $i++) { ?>
                    <div class="paymentOptionsTop" style="min-height: 222px;">
                        <div class="ribbon"><h3 style="margin-top: 0px; min-height: 43px; padding-top: 8px; margin-bottom: 0px; font-weight: 300;">$<?php echo $payCashArray[$i]; ?></h3></div>
                        
                        <div class="gameentry-header" style='margin-top: 5px;'><?php //echo $payCreditArray[$i]; ?><?php echo Yii::t('youtoo', $gameEntry[$payCreditArray[$i]]); ?></div><hr style="margin-top: 5px; margin-bottom: 5px;"/>
                            <div class="gameentry-text" style="font-size: 11px; margin-bottom: 10px;"><?php echo Yii::t('youtoo', 'Plus bonus entries<br/>for correct answers'); ?></div>
                        <div style="margin-top: 25px;"><a id="entry<?php echo $i; ?>" href="/payment?ci=<?php echo $i; ?>" class="btn btn-default btn-md" style="min-width: 114px; min-height: 37px;"><?php echo Yii::t('youtoo', 'Select'); ?></a></div>
                    </div>
                    <?php }
                ?>
                <!--                <div class="paymentOptionsTop">
                                    <div style="background-color: #f2f2f2;"><h3 style="margin-top: 0px; min-height: 43px; padding-top: 8px; margin-bottom: 0px; font-weight: 300;"><?php echo Yii::t('youtoo', 'Custom'); ?></h3></div>
                                    <div style='margin-top: 5px;'><?php echo CHtml::textField('custom', '', array('placeholder' => Yii::t('youtoo', 'credit bonus'), 'class' => 'form-control', 'style' => 'margin: 0 auto; max-width: 115px; padding-top: 5px;')); ?></div><hr style="margin-top: 5px; margin-bottom: 5px;"/>
                                    <div style="font-size: 10px; margin-bottom: 10px;"><?php echo Yii::t('youtoo', 'Entry to the<br/>weekly freeroll'); ?></div>
                                    <div style="margin-top: 25px;"><a id="entryCustom" href="#" class="btn btn-default btn-md" style="min-width: 114px; min-height: 37px;"><?php echo Yii::t('youtoo', 'Select'); ?></a></div>
                                </div>-->
            </div>
            
<!--            <div class="col-sm-2"></div> -->
        </div>
        
        
        
        
        
        
        <div class="row">
            <div class="col-sm-10" style=" margin-top: 10px; padding-left: 0px; padding-right: 0px;">
                <p class="lead" style="display: none;font-size: 13px; vertical-align: middle; padding-top: 15px; font-weight: 500;">
                    <?php echo Yii::t('youtoo', '') ?><img style="margin-left: 10px;" src='/webassets/images/laliga/icon_x.png'/>
                </p>
            </div>
        </div>
        <div class="row">
            <!--            <div class="col-sm-10 col-sm-offset-2" style="padding-left: 0px; padding-right: 0px; margin-top: 10px;">
                            <div class="paymentOptionsBottom" style="display:none; max-width:391px;min-height: 305px; margin-right: 30px;">
                                <div style='padding: 10px;'><h4 style='font-weight: 300;'><?php //echo Yii::t('youtoo','Pay with Credit Card');  ?>&nbsp;&nbsp;&nbsp;<img src='/webassets/images/laliga/image_credit-cards.png'/></h4></div>
                                <div style="max-width: 520px; padding: 5px 18px; margin: 0px auto">
                                    <form action="" method="POST" id="payment-form">
                                        <span class="payment-errors"></span>
                                                          stripe info
                                        <div class="input-group input-group-lg" style="text-align: left;width: 100%;padding: 4px 0px;">
                                            <span class="input-group-addon" style="width:30%;padding: 4px 16px;height: 34px; background-color: #474747">Card</span>
                                            <input class="form-control" type="text" size="18" maxlength="16" data-stripe="number" placeholder="Card number" style="height: 34px; padding: 4px 16px; font-size: 14px;"/>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="input-group input-group-lg" style="text-align: left;width: 100%;padding: 4px 0px;">
                                                    <span class="input-group-addon" style="width:30%;padding: 4px 6px;height: 34px;">Month</span>
                                                    <input class="form-control" type="text" size="3" maxlength="2" data-stripe="exp-month" placeholder="MM" style="width:100%;height: 34px;  padding: 4px 16px; font-size: 14px;"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group input-group-lg" style="text-align: left;width: 100%;padding: 4px 0px;">
                                                    <span class="input-group-addon" style="width:30%;padding: 4px 6px;height: 34px;">Year</span>
                                                    <input class="form-control" type="text" size="5" maxlength="4" data-stripe="exp-year" placeholder="YYYY" style="width:100%;height: 34px;  padding: 4px 16px; font-size: 14px;"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-group input-group-lg" style="text-align: left;width: 100%;padding: 4px 0px;">
                                                    <span class="input-group-addon" style="width:30%;padding: 4px 6px;height: 34px;">CVC</span>
                                                    <input class="form-control" type="text" size="4" maxlength="4" data-stripe="cvc" placeholder="CVC" style="height: 34px; font-size: 14px;"/>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row">
                                        <div style="max-width:100%;margin: 0 auto;">
                                            <div>

                                                    <div><a style="font-size: 14pt;text-decoration: underline;" href="<?php //echo Yii::app()->createURL("/expressCheckOut/{$model->tableName()}/{$model->id}");    ?>"><img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-large.png" alt="PayPal" /></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="paymentOptionsBottom" style="display: none; max-width:345px;min-height: 86px; margin-right: 16px; margin-top: 10px; background-color: #ffffff;">
                                <hr/>
                                <div style="margin-top: 10px; text-align: left; margin-left: 10px;">
                                    <h4 style="font-weight: 300;">Total: $<?php //echo $payCashArray[$cashIndex];  ?></h4>
                                </div>
                            </div>
                            <div class="row">
                            <a href="" class="btn btn-default btn-lg" style="display:none; margin-left: 10px; float: left; min-width: 114px; min-height: 37px;"><?php //echo Yii::t('youtoo','Submit');  ?></a>
                        </div>
                    </div>-->
            <div class="row">
                <div class="col-sm-12">
                    <h4 id="total" style="font-weight: 500;color: white;background: rgba(0, 0, 0, 0.5);display: inline;padding: 10px">Total: $<?php echo $payCashArray[$cashIndex]; ?></h4>
                    <div style="max-width:100%;margin: 0 auto;">
                        <div>
                            <div style="margin: 20px 0px 20px 0px;">
                                <form action="/processstripeprepay" method="post" style="background-color:transparent;">
                                    <script id="stripe-button" src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
                                            data-key="<?php echo $stripe['publishable_key']; ?>"
                                            data-amount="<?php echo $payCashArray[$cashIndex] * 100; ?>"
                                            data-name="iSweepsUSA"
                                            data-description="Sweeps"
                                            data-locale="en"
                                    data-label="Pay with card"></script>
                                    <input id="amount" type="hidden" name="amount" value="<?php echo $payCashArray[$cashIndex]; ?>"/>
                                    <!--<input id="game_id" type="hidden" name="game_id" value="<?php //echo $game_id; ?>"/>-->
                                </form>
                            </div>
                        </div>
<!--                        <div>
                            <a id="paypal-express" style="font-size: 14pt;text-decoration: underline;" href="<?php //echo Yii::app()->createURL("/expressCheckOut/$payCashArray[$cashIndex]"); ?>"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" alt="PayPal Credit" /></a>
                        </div>-->
                        <!--                        <form id="paypal-prepay-form" action="/processpaypalprepay" method="post">
                        <?php //echo CHtml::link(Yii::t('youtoo', 'Pay Using Paypal'), array('#'), array('data-toggle' => 'modal', 'data-target' => '#modalPaypalDirect', 'class' => 'btn btn-default btn-sm'));  ?>
                                                </form>-->
                    </div>
                </div>
            </div>
            <br/>
            <div class="row paymentpage-lower-info" style="width:40%;height:100px; padding:10px;margin:0 auto; float:none;background-color:rgba(0, 0, 0, 0.65);">
                <div class="col-sm-12">
                    <span><a href="<?php echo Yii::app()->createUrl('/site/contact'); ?>"><h5 style="color: #ea8417;"><img style="vertical-align: baseline;" src="/webassets/images/laliga/icon_envelope.png"/>&nbsp; support@isweepsusa.com</h5></a></span>
                </div>
                <div class="col-sm-12">
                    <span><h5 style="color:white;"><img style="vertical-align: baseline;" src="/webassets/images/laliga/icon_lock.png"/>&nbsp; <?php echo Yii::t('youtoo', 'Secure payments'); ?></h5></span>
                </div>
            </div>
        </div>
    </div>
     </div> </div>
    <?php
    //$this->renderPartial('paypaldirect', array()); ?>