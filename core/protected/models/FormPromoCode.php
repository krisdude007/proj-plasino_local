<?php

class FormPromoCode extends CFormModel {


    public $start_date;
    public $end_date;

    public function rules() {

        return array(
            array('start_date, end_date', 'required'),
            array('start_date, end_date', 'safe', 'on'=>'search')
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
