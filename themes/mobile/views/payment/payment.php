<?php
$cs = Yii::app()->getClientScript();

$stripe = StripeUtility::config();
?>
<style>
    .selected {
          background-color: #f9d83d !important;
    }
</style>

<!-- The required Stripe lib -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    // This identifies your website in the createToken call below
    Stripe.setPublishableKey('<?php echo $stripe['publishable_key']; ?>');

    $(document).ready(function() {
        var username = getCookie('username');
        if (username)
            document.getElementById('clientUser_username').value = username;
        var type = "<?php //echo $type;   ?>";
        var cashIndex = <?php echo $cashIndex; ?>;

        if (parseInt(cashIndex) > 0) {
            //$("#entry" + cashIndex).addClass('selected');
            //$("#entry" + cashIndex).attr("selected","selected");
            //$("#entry" + cashIndex).text('Seleccionado');
        }
    });

    var stripeResponseHandler = function(status, response) {
        var $form = $('#payment-form');

        if (response.error) {
            // Show the errors on the form
            $form.find('.payment-errors').text(response.error.message);
            $('#paymentloging-form').find('button').prop('disabled', false);
        } else {
            // token contains id, last4, and card type
            var token = response.id;
            // Insert the token into the form so it gets submitted to the server
            // and re-submit

            $('#user-login-register-pay-form').append($('<input type="hidden" name="stripeToken" />').val(token));
            $('#user-login-register-pay-form').append($('<input type="hidden" name="amount" />').val());
            $('#user-login-register-pay-form').submit();
        }
    };

    jQuery(function($) {

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
</script>
<br/>
<div class='as-table'>
    <div class="fabmob_content-container text-center">
        <div class="form-group">
        <select class="form-control fabmob_round-border-bottom" onchange="location = this.options[this.selectedIndex].value;">
            <?php for ($i = 1; $i <= 4; $i++) { ?>
                <option <?php if ($payCashArray[$i] == $payCashArray[$cashIndex] ) echo 'selected' ; ?> id="entry<?php echo $i; ?>" value="/payment?ci=<?php echo $i; ?>&gid=<?php echo $game_id; ?>">$<?php echo $payCashArray[$i]; ?> - <?php echo $payCreditArray[$i]; ?> <?php echo Yii::t('youtoo', 'credit bonus'); ?></option>
            <?php } ?>
        </select>
        </div>
        <div class="row" style="padding:20px;">
            <div class="col-xs-4"><img src="/webassets/mobile/images/logo_visa.png" style="width: 100%; margin-top: 10%;"/></div>
            <div class="col-xs-4"><img src="/webassets/mobile/images/logo_discover.png" style="width: 100%; margin-top: 18%;"/></div>
            <div class="col-xs-4"><img src="/webassets/mobile/images/logo_mastercard.png" style="width: 100%;"/></div>
        </div>
        <br/>
       <h2 id="total" style="font-weight: 300;">Total: $<?php echo $payCashArray[$cashIndex]; ?></h2>
        <div style="max-width:100%;margin: 0 auto;">
            <div>
                <div style="margin: 20px 0px 20px 0px;">
                    <form action="/processstripeprepay" method="post">
                        <script id="stripe-button" src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
                                data-key="<?php echo $stripe['publishable_key']; ?>"
                                data-amount="<?php echo $payCashArray[$cashIndex] * 100; ?>"
                                data-name="Azteca"
                                data-description="Concursos"
                                data-locale="es"
                                data-label="Pagar con Tarjeta"></script>
                        <input id="amount" type="hidden" name="amount" value="<?php echo $payCashArray[$cashIndex]; ?>"/>
                        <input id="game_id" type="hidden" name="game_id" value="<?php echo $game_id; ?>"/>
                    </form>
                </div>
                <div>
                     <a id="paypal-express" style="font-size: 14pt;text-decoration: underline;" href="<?php echo Yii::app()->createURL("/expressCheckOut/$payCashArray[$cashIndex]/$game_id"); ?>"><img src="https://www.paypalobjects.com/es_XC/i/btn/btn_paynow_LG.gif" alt="PayPal Credit" /></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-2">
                <span><a href="<?php echo Yii::app()->createUrl('/site/contact'); ?>"><h5 style="color: #ea8417;"><img style="vertical-align: baseline;" src="/webassets/images/laliga/icon_envelope.png"/>&nbsp; support@youtootech.com</h5></a></span>
            </div>
            <div class="col-sm-10 col-sm-offset-2">
                <span><h8><img style="vertical-align: baseline;" src="/webassets/images/laliga/icon_lock.png"/>&nbsp; <?php echo Yii::t('youtoo','Secure payments'); ?></h8></span>
            </div>
        </div>
    </div>
</div>