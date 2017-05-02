<?php

class FormProgram extends CFormModel {


    public $month;
    public $new_month;
    public $station;

    public function rules() {

        return array(
            array('month, new_month', 'required'),
            array('month, new_month, station', 'safe', 'on'=>'search')
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'aired_month' => 'month',
            'new_month' => 'New Month',
        );
    }

}
