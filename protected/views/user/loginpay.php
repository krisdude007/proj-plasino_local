<?php
$stripe = StripeUtility::config();
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
        var type = "<?php echo $type; ?>";
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

//    function showPopupWrap(text) {
//        $("#popupWrap .flashMobileContents").html(text);
//        $("#popupWrap").css('display', 'table');
//    }
//
//    function payPalDirect() {
//
//        var email = $('#clientUser_username').val();
//        var password = $('clientUser_password').val();
//
//        if (email === '' || password === '') {
//            alert('Please enter your email and password first.');
//            $('#modalPaypalDirect').modal('hide');
//        }
//        else {
//            var request = $.ajax({
//                url: '/user/ajaxPayPalDirect',
//                type: 'POST',
//                data: ({
//                    'card_number': $('#card_number').val(),
//                    'expire_month': $('#expire_month').val(),
//                    'expire_year': $('#expire_year').val(),
//                    'cvv2': $('#cvv2').val(),
//                    'first_name': $('#first_name').val(),
//                    'last_name': $('#last_name').val(),
//                    'street_1': $('#street_1').val(),
//                    'city': $('#city').val(),
//                    'state': $('#state').val(),
//                    'postal_code': $('#postal_code').val(),
//                    'CSRF_TOKEN': getCsrfToken()
//                }),
//                success: function(data) {
//                    obj = $.parseJSON(data);
//                    if (obj.success) {
//                        $('#modalPaypalDirect').modal('hide');
//                        $('#user-login-register-pay-form').submit();
//                    }
//                    if (obj.error) {
//                        $('#modalPaypalDirect').modal('hide');
//                        showPopupWrap(obj.error);
//                         $('.okButton').on('click', function(e) {
//                            e.preventDefault();
//                            window.location.href = '/loginpay';
//                        });
//                    }
//                }
//            });
//        }
//    }
</script>

<div id="pageContainer" class="container">
    <div class="subContainer">
        <div class="row">
            <div>
                <h1><?php echo Yii::t('youtoo', 'You’re almost entered to win $3500 this week!'); ?></h1>
                <p class="lead">
                    <?php echo "Thanks for your answer!  To complete your entry, log in or register to pay $1 below."; //echo GameUtility::getActiveGameDesc();  ?>
                </p>

            </div>
        </div>
        <div style="max-width: 520px; margin: 0 auto; padding: 12px 18px; border: 1px solid grey;border-radius: 6px;">
            <div id="login-register" style="padding: 0 30px;">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'user-login-register-pay-form',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => true,
                        'validateOnType' => false,
                    ),
                    'htmlOptions' => array('autoComplete' => 'off'),
                ));
                ?>
                <h3 style='text-align: left;color: #df9721;'>Sign In</h3>
                <h4 style='text-align: left;color: #df9721;'>What is your e-mail address?</h4>
                <div class="input-group input-group-lg" style="text-align: left;width: 100%;">
                    <label>My e-mail address: </label> <?php echo $form->textField($model, 'username', array('placeholder' => 'Email', 'style' => 'margin: 0px 6px;')); ?>
                </div>
                <div>
                    <span class="help-block">
                        <?php echo $form->error($model, 'username'); ?>
                    </span>
                </div>
                <h4 style='text-align: left;color: #df9721;'>Do you have an account?</h4>
                <div style='text-align: left;'>
                    <input type='radio' name='yesNo' value='0' onclick='yesNoClick(this);' <?php echo(Yii::app()->controller->action->id == 'registerpay' ? 'checked' : '') ?>> No, I'm a new Player.
                </div>
                <div style='text-align: left;'>
                    <input type='radio' name='yesNo' value='1' onclick='yesNoClick(this);' <?php echo(Yii::app()->controller->action->id == 'loginpay' ? 'checked' : '') ?>> Yes, I have a password:
                    <?php echo $form->passwordField($model, 'password', array('placeholder' => 'Password', 'style' => 'margin: 0px 6px;')); ?>
                    <div>
                        <span class="help-block">
                            <?php echo $form->error($model, 'password'); ?>
                        </span>
                    </div>
                </div>
                <div style="text-align: left;width: 100%;<?php echo(Yii::app()->controller->action->id == 'loginpay' ? 'display:none;' : '') ?>>">
                    <?php echo $form->checkBox($model, 'terms_accepted', array('checked' => '', 'value' => 1)); ?>
                    <?php echo Yii::t('youtoo', 'I agree to') ?> <?php echo CHtml::link(Yii::t('youtoo', 'Terms of Use'), array('#'), array('data-toggle' => 'modal', 'data-target' => '#modalTerms', 'style' => 'color: #df9721 !important')); ?> &nbsp;
                    <?php echo Yii::t('youtoo', ' & ') ?> <?php echo CHtml::link(Yii::t('youtoo', 'Privacy Policy'), array('#'), array('data-toggle' => 'modal', 'data-target' => '#modalPrivacy', 'style' => 'color: #df9721 !important')); ?>
                    <div>
                        <span class="help-block">
                            <?php echo $form->error($model, 'terms_accepted'); ?>
                        </span>
                    </div>
                </div>
                <div class="toggle" style="text-align: left;width: 100%;<?php echo(Yii::app()->controller->action->id == 'loginpay' ? 'display:none;' : '') ?>">
                    <?php echo $form->checkBox($model, 'age_accepted', array('checked' => '', 'value' => 1)); ?>
                    <?php echo Yii::t('youtoo', 'I am at least 21 years of age'); ?>
                    <div>
                        <span class="help-block">
                            <?php echo $form->error($model, 'age_accepted'); ?>
                        </span>
                    </div>
                </div>
                <?php echo $form->hiddenField($model, 'source', array('value' => 'web')); ?>
                <input id="screen_width" type="hidden" name="screen_width" value="" />
                <input id="screen_height" type="hidden" name="screen_height" value="" />
                <button class="btn btn-default btn-sm" type="submit" style="background-color: #df9721 !important;  border-color: #df9721;">Sign in without play</button>
                <?php $this->endWidget(); ?>
            </div>
        </div>
        <div style="max-width: 520px; padding: 12px 18px; border: 1px solid grey;border-radius: 6px; margin: 15px auto">
            <form action="" method="POST" id="payment-form">
                <span class="payment-errors"></span>
                <!--                  stripe info-->
                <div class="input-group input-group-lg" style="text-align: left;width: 100%;padding: 4px 0px;">
                    <span class="input-group-addon" style="width:30%;padding: 4px 16px;height: 34px;">Card number</span>
                    <input class="form-control" type="text" size="18" maxlength="16" data-stripe="number" placeholder="Card number" style="height: 34px; padding: 4px 16px;"/>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="input-group input-group-lg" style="text-align: left;width: 100%;padding: 4px 0px;">
                            <span class="input-group-addon" style="width:30%;padding: 4px 6px;height: 34px;"></span>
                            <input class="form-control" type="text" size="3" maxlength="2" data-stripe="exp-month" placeholder="MM" style="width:100%;height: 34px;  padding: 4px 16px"/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-lg" style="text-align: left;width: 100%;padding: 4px 0px;">
                            <span class="input-group-addon" style="width:30%;padding: 4px 6px;height: 34px;"></span>
                            <input class="form-control" type="text" size="5" maxlength="4" data-stripe="exp-year" placeholder="YYYY" style="width:100%;height: 34px;  padding: 4px 16px"/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group input-group-lg" style="text-align: left;width: 100%;padding: 4px 0px;">
                            <span class="input-group-addon" style="width:30%;padding: 4px 6px;height: 34px;">CVC</span>
                            <input class="form-control" type="text" size="4" maxlength="4" data-stripe="cvc" placeholder="CVC" style="height: 34px;"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php //echo CHtml::link(Yii::t('youtoo', 'Sign-in & Pay Using Paypal'), array('#'), array('data-toggle' => 'modal', 'data-target' => '#modalPaypalDirect', 'class' => 'btn btn-default btn-sm')); ?>
        <div style="max-width: 900px; margin: 0 auto; padding: 18px 0px 6px 0px;">
            <!--<p>OR</p>-->
            <form action="" method="POST" id="paymentloging-form">
                <button class="btn btn-default btn-lg" type="submit" style="background-color: #df9721 !important;  border-color: #df9721;">Sign in & Pay in our secure server</button>
            </form>
        </div>
        <div style="margin:10px 0px 6px 0px;">Each entry earns you food, beverages, free play and merchandise from Laligas!</div>
    </div>
</div>
<?php //$this->renderPartial('/user/paypaldirect', array()); ?>