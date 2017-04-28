<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('/webassets/js/jquery.elevateZoom.min.js');

$stripe = StripeUtility::config(); ?>

<br/>
<div class="fabmob_content-container text-center">
    <div class="col-sm-8">
        <img class="img-responsive" id="productImage" style="max-height: 272px; max-width: 354px; width: 100%; padding: 10px; margin-right: 0px; margin-left: 0px; height: 100%" src="<?php echo '/' . basename(Yii::app()->params['paths']['image']) . "/{$prize->image}" ?>" alt="...">
    </div>
    <div class="col-sm-4" style="text-align: left;">
        <h3 style="margin-top: 0px; margin-bottom: 0px;"><?php echo $prize->name; ?></h3>
        <div class="description"><?php echo $prize->description; ?></div>
        <h4 style="margin-top: 0px; margin-bottom: 0px;"><?php echo Yii::t('youtoo', 'Price'); ?></h4>
        <div class="description" style="margin: 0px;"><?php echo ($prize->credits_required == 1) ? (Yii::t('youtoo', '{value} Credit', array('{value}' => $prize->credits_required))) : (Yii::t('youtoo', '{value} Credits', array('{value}' => $prize->credits_required))) ?></div>
        <div style="margin-bottom: 5px;">or</div>
        <div class="description">
            <?php echo Yii::t('youtoo', '${value} with Credit Card/Paypal', array('{value}' => $prize->credits_required)); ?>
        </div>

    </div>

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

        <br/>
        <div>
            <button type="submit" class="btn btn-default btn-md" style="min-width: 145px; min-height: 45px; width: 100%; font-weight: 300; font-size: 14px;"><?php echo Yii::t('youtoo', 'Buy with credits') ?></button>
        </div>
<?php $this->endWidget(); ?>

    <div class="col-sm-4" style="margin-top: 10px;">
        <span>
            <form action="/processstripeproduct/<?php echo $prize->id; ?>" method="post">
                <script src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
                        data-key="<?php echo $stripe['publishable_key']; ?>"
                        data-amount="<?php echo $prize->credits_required * 100; ?>"
                        data-name="Azteca"
                        data-description="<?php echo $prize->name; ?>"
                        data-locale="es"
                        data-label="Compra con Tarjeta"></script>
            </form>
        </span><br/>
        <span>
            <a id="paypal-express" style="font-size: 14pt;text-decoration: underline;" href="<?php echo Yii::app()->createURL("/expressCheckOut/".$prize->tableName()."/$prize->market_value/$prize->id"); ?>"><img src="https://www.paypalobjects.com/es_ES/i/bnr/bnr_shopNowUsing_150x40.gif" alt="Buy now with PayPal" /></a>
        </span>
    </div>
</div>