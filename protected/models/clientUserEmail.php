<?php

class clientUserEmail extends eUserEmail {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email', 'required', 'on' => 'register,adminRegister,shipping,twitter', 'message' => Yii::t('youtoo', 'Email cannot be blank')),
            array('email', 'email', 'message' => Yii::t('youtoo', 'Email is not a valid email address')),
            array('email', 'unique', 'on' => 'register,profile,twitter', 'message' => Yii::t('youtoo', 'Email {value} has already been taken')),
            array('user_id, active', 'numerical', 'integerOnly' => true),
            array('email, type', 'length', 'max' => 255),
            array('created_on,updated_on', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'insert, register'),
            array('updated_on', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'update, profile'),
            array('active', 'default', 'value' => 1, 'on' => 'insert'),
            array('type', 'default', 'value' => 'primary', 'on' => 'insert'),
            array('id, user_id, email, type, active, created_on, updated_on', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels() {
        return array(
            'email' => Yii::t('youtoo', 'Email'),
        );
    }

}

?>
