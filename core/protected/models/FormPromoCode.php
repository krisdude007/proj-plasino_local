<?php

class FormPromoCode extends CFormModel {

    public $freecredit_key;
    public $freecredit_price;
    public $start_date;
    public $end_date;

    public function rules() {

        return array(
            array('freecredit_key, freecredit_price, start_date, end_date', 'required'),
            array('freecredit_key, freecredit_price, start_date, end_date', 'safe', 'on'=>'search')
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
