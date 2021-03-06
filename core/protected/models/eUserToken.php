<?php

/**
 * This is the model class for table "user_token".
 *
 * The followings are the available columns in table 'user_token':
 * @property string $token
 * @property integer $user_id
 * @property string $created_on
 * @property string $updated_on
 *
 * The followings are the available model relations:
 * @property User $user
 */
class eUserToken extends UserToken
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user_token';
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AppSetting the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    
    public static function generateToken() {
        $token = sha1(uniqid(mt_rand(), true));
        $tokenExists = self::model()->findByAttributes(array('token' => $token));
        if(is_null($tokenExists)) {
            return $token;
        } else {
            self::generateToken();
        }
    }
    
    
    
    
                
}
