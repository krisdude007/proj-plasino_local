<?php

class eProgram extends Program {

    /**
     * @return array validation rules for model attributes.
     */

    public $new_aired_month;
    public $station;

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('program_name, aired_day, aired_month', 'required','on' => 'new,affidavit'),
            array('station', 'required', 'on' => 'register'),
            array('user_id, aired, is_deleted', 'numerical', 'integerOnly' => true),
            array('program_name, aired_day, aired_month, created_by, air_time', 'length', 'max' => 255),
            array('station', 'length', 'max' => 255),
            array('user_id', 'default', 'value' => Yii::app()->user->getId()),
            array('is_deleted', 'default', 'value' => 0),
            array('new_aired_month','required','on' => 'copyToNewMonth', 'message' => Yii::t('youtoo','New Month cannot be blank')),
            array('created_on', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'insert'),
            array('updated_on', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'update'),
            //array('air_time', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, program_name, aired, air_time, aired_day, aired_month, created_by, is_deleted, station, created_on, updated_on', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'eUser', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'program_name' => 'Program Name',
            'aired' => 'Aired',
            'air_time' => 'Air Time',
            'aired_day' => 'Aired Day',
            'aired_month' => 'Aired Month',
            'created_by' => 'Created By',
            'is_deleted' => 'Is Deleted',
            'station' => 'Station',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
        );
    }

    public static function getAllPrograms() {
        return self::model()->asc()->findAll();
    }

    public static function getAllProgramsByMonth($month) {
        if (isset($month)) {
        return self::model()->asc()->findAllByAttributes(array('aired_month' => $month));
        }
        else {
        return self::model()->asc()->findAll();
        }
    }

    public static function getAllProgramsByStation($station) {
        if (isset($station)) {echo 'ere';exit;
        return self::model()->asc()->findAllByAttributes(array('station' => $station));
        }
        else {
        return self::model()->asc()->findAll();
        }
    }

    public static function getAllProgramsByMonthAndStation($month, $station) {
        if (isset($month) && isset($station)) {
        return self::model()->asc()->findAllByAttributes(array('aired_month' => $month, 'station' => $station));
        }
        else {
        return self::model()->asc()->findAllByAttributes(array('station' => $station));
        }
    }

    public function copyToNewMonth($month, $newMonth) {
        $user_id = Yii::app()->user->getId();
        $userInfo = eUser::model()->findByPK($user_id);
        $checkIfMonthDataExists = self::model()->asc()->findAllByAttributes(array('aired_month' => $newMonth, 'station' => $userInfo->username));
        if (empty($checkIfMonthDataExists) && isset($month)) {
            $sql = "insert into program (user_id,
                program_name,
                aired,
                air_time,
                aired_day,
                aired_month,
                created_by,
                is_deleted,
                station,
                created_on)
                select $user_id,
                program_name,
                aired,
                air_time,
                aired_day,
                '$newMonth',
                $user_id,
                is_deleted,
                station,
                NOW()
                from program where aired_month = '$month'";//echo $sql;exit;
                $result = Yii::app()->db->createCommand($sql)->execute();
                return true;
        } else {
            return false;
        }
    }

    public function scopes() {
        return array(
            'recent' => array('order' => '`t`.`id` DESC'),
            'asc' => array('order' => '`t`.`id` ASC'),
            'orderByCreatedDesc' => array(
                'order' => '`t`.created_on DESC',
            ),
            'orderByCreatedAsc' => array(
                'order' => '`t`.created_on ASC',
            ),
            'orderByIDDesc' => array(
                'order' => '`t`.id DESC',
            ),
            'isAired' => array(
                'condition' => "aired = '1'",
            ),
            'isNotAired' => array(
                'condition' => "aired = '0'",
            ),
            'isNotDeleted' => array(
                'condition' => "is_deleted = '0'"
            ),
            'default' => array(
                'condition' => "station = 'default'"
            ),
        );
    }

    public function search($perPage = 0) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->together = true;
        $criteria->condition = "is_deleted = '0' and station != 'default'";

        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.program_name', $this->program_name, true);
        $criteria->compare('t.aired', $this->aired, true);
        $criteria->compare('t.air_time', $this->air_time, true);
        $criteria->compare('t.aired_day', $this->aired_day, true);
        $criteria->compare('t.aired_month', $this->aired_month, true);
        $criteria->compare('t.created_by', $this->created_by, true);
        $criteria->compare('t.is_deleted', $this->is_deleted);
        $criteria->compare('t.station', $this->station, true);
        $criteria->compare('created_on',$this->created_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->created_on)):null);
	$criteria->compare('updated_on',$this->updated_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->updated_on)):null);
        $criteria->compare('user.id', $this->user_id, true);

        if($perPage == 0)
            $perPage = Yii::app()->params['perPage'];
            if(empty($perPage))
                $perPage = 20;
        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' =>$perPage,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Program the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
