<?php

class FormProgramMonth extends CFormModel {


    public $month;

    public function rules() {

        return array(
            array('month', 'required'),
            array('month', 'safe', 'on'=>'search')
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'month' => 'Month',
        );
    }

}
