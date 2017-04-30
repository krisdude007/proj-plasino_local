<?php

class clientUser extends eUser {

    public $age_accepted;
    public $eligibility_accepted;
    public $game_eligible;
    public $confirm_password;
    public $newPassword;
    public $newPasswordConfirm;
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('gender', 'required', 'on' => 'shipping, twitter',),
            array('first_name, last_name', 'required', 'on' => 'register, shipping, payment',),
            array('password, source', 'required', 'on' => 'register, adminRegister,twitter', 'message' => Yii::t('youtoo','Password cannot be blank')),
            array('confirm_password', 'required', 'on' => 'register', 'message' => Yii::t('youtoo','Confirm Password cannot be blank')),
            array('username', 'required', 'on' => 'login, loginpay, loginimported, getpassword, register, adminRegister, reset, shipping, registerimported', 'message'=>Yii::t('youtoo','Email cannot be blank')),
            array('password','required', 'on' => 'login, loginpay', 'message'=>Yii::t('youtoo','Password cannot be blank')),
            array('password','length','on' => 'register', 'min' => 6,'tooShort' => Yii::t('youtoo','Password is too short (minimum is 6 characters)')),
            array('confirm_password','length','on' => 'register', 'min' => 6,'tooShort' => Yii::t('youtoo','Confirm Password is too short (minimum is 6 characters)')),
            array('confirm_password', 'compare', 'compareAttribute' => 'password', 'on' => 'register', 'message'=>Yii::t('youtoo','Confirm Password must be repeated exactly.')),
            array('source','required', 'on' => 'login'),
            //array('birthday', 'date', 'format' => 'yyyy-MM-dd'),
            array('birthday', 'required', 'on' => 'shipping', 'message'=>Yii::t('youtoo','The Birthday Month, Day, Year must be selected')),
            array('birthYear', 'date', 'format' => 'yyyy', 'on' => 'shipping'),
            array('birthMonth', 'date', 'format' => 'MM', 'on' => 'shipping'),
            array('birthDay', 'date', 'format' => 'dd', 'on' => 'shipping'),
            array('username', 'unique', 'on' => 'register,adminRegister, twitter, shipping', 'message'=> Yii::t('youtoo','Sorry, this email has already been used')),
            array('terms_accepted', 'numerical', 'integerOnly' => true),
            array('terms_accepted', 'required', 'requiredValue' => 1, 'on' => 'register', 'message'=>Yii::t('youtoo','You must accept the Terms of Use and Privacy Policy')),
            array('age_accepted, eligibility_accepted, game_eligible', 'numerical', 'integerOnly' => true),
            array('username', 'email', 'message' => Yii::t('youtoo', 'Username is not a valid email address')),
            //array('username', 'numerical', 'integerOnly' => true, 'message'=>Yii::t('youtoo','Phone number must be a number')),
            array('age_accepted', 'required', 'requiredValue' => 1, 'on' => 'register', 'message'=>Yii::t('youtoo','You must verify you are at least 21 years of age')),
            array('eligibility_accepted', 'required', 'requiredValue' => 1, 'on' => 'register', 'message'=>Yii::t('youtoo','You must confirm that you are not playing from one of the above mentioned states')),
            array('game_eligible', 'required', 'requiredValue' => 1, 'on' => 'register', 'message'=>Yii::t('youtoo','You must confirm that you are a member')),
            array('password, first_name, last_name, source, paypal_preapproval_key', 'length', 'max' => 255),
            array('gender', 'length', 'max' => 1),
            array('role', 'length', 'max' => 14),
            array('username', 'length', 'min' => 7),
            //array('username', 'length', 'max' => 20),
            array('newPassword,', 'required', 'on' => 'changePassword', 'message' => Yii::t('youtoo','New Password cannot be blank')),
            array('newPasswordConfirm','required','on' => 'changePassword', 'message' => Yii::t('youtoo','New Password Confirm cannot be blank')),
            array('newPasswordConfirm', 'compare', 'on' => 'changePassword', 'compareAttribute' => 'newPassword', 'message' => Yii::t('youtoo','New passwords do not match')),
            array('newPassword', 'length', 'on' => 'changePassword', 'min' => 6, 'max' => 255, 'tooShort' => Yii::t('youtoo','New Password is too short (minimum is 6 characters)')),
            array('created_on,updated_on', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'insert, register,adminRegister, twitter, facebook'),
            array('updated_on', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'update, profile'),
            array('id, password, birthday, gender, first_name, last_name, terms_accepted, age_accepted, source, created_on, updated_on', 'safe', 'on' => 'auditSearch'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('paypal_preapproval_endingdate', 'safe'),
            array('email, userPermissions, id, username, password, birthday, gender, first_name, last_name, terms_accepted, age_accepted, eligibility_accepted, game_eligible, source, paypal_preapproval_key, created_on, updated_on', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => Yii::t('youtoo','Username'),
            //'password' => Yii::t('youtoo','Password'),
            'birthday' => Yii::t('youtoo','Birthday'),
            'gender' => Yii::t('youtoo','Gender'),
            //'first_name' => Yii::t('youtoo','First Name'),
            //'last_name' => Yii::t('youtoo','Last Name'),
            'terms_accepted' => Yii::t('youtoo','Terms Accepted'),
            'source' => Yii::t('youtoo','Source'),
            'created_on' => Yii::t('youtoo','Created'),
            'updated_on' => Yii::t('youtoo','Updated'),
            'email' => Yii::t('youtoo','Email'),
            'userPermissions' => Yii::t('youtoo','User Permissions')
        );
    }

}
