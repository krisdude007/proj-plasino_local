
<?php

class StripeUtility {

    public static function config() {
        require_once('core/protected/vendor/stripe/init.php');
        
        $stripe = array(
          'secret_key'      => Yii::app()->params['Stripe']['secret_key'],
          'publishable_key' => Yii::app()->params['Stripe']['publishable_key'],
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);

        return $stripe;
    }

}

?>

