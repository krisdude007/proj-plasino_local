<?php

class FormPlayNow extends CFormModel {

    public $phoneNumber;


    public function rules() {

        return array(
            array('phoneNumber, status, perPage', 'required'),
            array('phoneNumber', 'numerical', 'integerOnly' => true),
        );

        return $rules;
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'phoneNumber' => 'Phone Number',
        );
    }

}
