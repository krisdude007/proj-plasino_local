<?php

/**
 * This is the model class for table "station_info".
 *
 * The followings are the available columns in table 'station_info':
 * @property integer $id
 * @property string $station_name
 * @property integer $user_id
 * @property string $state
 * @property integer $is_valid
 * @property string $created_on
 * @property string $updated_on
 *
 * The followings are the available model relations:
 * @property User $user
 * @property User $stationName
 */
class eStationInfo extends StationInfo
{


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, station_name', 'required'),
			array('user_id, is_valid', 'numerical', 'integerOnly'=>true),
			array('station_name, state', 'length', 'max'=>20),
                        array('user_id', 'default', 'value' => Yii::app()->user->getId()),
                        array('is_valid', 'default', 'value' => 0),
                        
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
                        array('created_on', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'insert'),
                        array('updated_on', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'update'),
			array('id, station_name, user_id, state, is_valid, created_on, updated_on', 'safe', 'on'=>'search'),
		);
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
            );
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'stationName' => array(self::BELONGS_TO, 'User', 'station_name'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'station_name' => 'Station Name',
			'user_id' => 'User',
			'state' => 'State',
			'is_valid' => 'Is Valid',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
		);
	}

        public function getAllProgramsAndCopyToNewStation($userId, $stationName) {
        $user_id = Yii::app()->user->getId();
        $user_id = (empty($user_id)) ? $userId : $user_id;
        $checkIfDataExists = self::model()->asc()->findAllByAttributes(array('station_name' => $stationName));
        if (!empty($checkIfDataExists) && isset($stationName)) {
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
                select user_id,
                program_name,
                0,
                air_time,
                aired_day,
                aired_month,
                $user_id,
                is_deleted,
                '$stationName',
                NOW()
                from program where station = 'default' and aired_month = 'January'";
                $result = Yii::app()->db->createCommand($sql)->execute();
                return true;
        } else {
            return false;
        }
    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('station_name',$this->station_name,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('is_valid',$this->is_valid);
		$criteria->compare('created_on',$this->created_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->created_on)):null);
                $criteria->compare('updated_on',$this->updated_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->updated_on)):null);
                $criteria->compare('user.id', $this->user_id, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StationInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
