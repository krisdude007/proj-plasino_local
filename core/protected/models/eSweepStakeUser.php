<?php

/**
 *
 *
 */
class eSweepStakeUser extends SweepStakeUser {

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sweepstake_id, user_id, accepted', 'required', 'on' => 'insert'),
            array('created_on', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'insert'),
            array('sweepstake_id, user_id, accepted', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, sweepstake_id, user_id, accepted, created_on', 'safe', 'on' => 'search'),
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function scopes() {
        return array(
            'current' => array('condition' => "NOW() between start_date and end_date"),
        );
    }

}
