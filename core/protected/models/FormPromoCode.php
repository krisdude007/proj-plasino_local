<?php

class FormPromoCode extends CFormModel {

    public $user_email;
    public $freecredit_key;
    public $freecredit_price;
    public $start_date;
    public $end_date;
    public $code_used_by;
    public $is_code_used;
    

    public function rules() {

        return array(
            array('user_email, freecredit_key, freecredit_price, start_date, end_date, code_used_by, is_code_used', 'required'),
            array('user_email, freecredit_key, freecredit_price, start_date, end_date, code_used_by, is_code_used', 'safe', 'on'=>'search')
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        );
    }

}
