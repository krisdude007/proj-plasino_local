<?php

class clientUserLocation extends eUserLocation {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function creditCardNo($attribute, $params) {
        // Strip any non-digits (useful for credit card numbers with spaces and hyphens)
        //$number=preg_replace('/\D/', '', $this->card);

        // Set the string length and parity
        $number_length=strlen($number);
        $parity=$number_length % 2;

        // Loop through each digit and do the maths
        $total=0;
        for ($i=0; $i<$number_length; $i++) {
          $digit=$number[$i];
          // Multiply alternate digits by two
          if ($i % 2 == $parity) {
            $digit*=2;
            // If the sum is two digits, add them together (in effect)
            if ($digit > 9) {
              $digit-=9;
            }
          }
          // Total up the digits
          $total+=$digit;
        }

        // If the total mod 10 equals 0, the number is valid
        if($total % 10 !== 0){
            $this->addError($attribute, Yii::t('youtoo','Invalid Credit Card'));
        }
    }

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id', 'numerical', 'integerOnly' => true),
            array('address1, address2, city, state, country, timezone, type', 'length', 'max' => 255),
            array('state','required','on' =>'register'),
            array('postal_code', 'length', 'max' => 5),
            array('phone_number','length','max' => 10),
            //array('card', 'creditCardNo'),
            array('phone_number', 'numerical', 'integerOnly' => true),
            array('city, postal_code','required', 'on' => 'payment'),
            array('created_on,updated_on', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'insert, register'),
            array('updated_on', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'update, profile'),
            array('type', 'default', 'value' => 'primary', 'on' => 'insert'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, address1, address2, city, state, country, timezone, postal_code, type, phone_number, created_on, updated_on', 'safe', 'on' => 'search'),
        );
    }
        public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => Yii::t('youtoo','User'),
            'address1' => Yii::t('youtoo','Address'),
            'address2' => Yii::t('youtoo','Address2'),
            'city' => Yii::t('youtoo','City'),
            'state' => Yii::t('youtoo','State'),
            'country' => Yii::t('youtoo','Country'),
            'timezone' => Yii::t('youtoo','Time zone'),
            'postal_code' => Yii::t('youtoo','Zip'),
            'phone_number' => Yii::t('youtoo','Phone Number'),
        );
    }
}