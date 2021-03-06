<?php

/**
 * This is the model class for table "user_tech".
 *
 * The followings are the available columns in table 'user_tech':
 * @property integer $id
 * @property integer $user_id
 * @property integer $login_id
 * @property integer $screen_width
 * @property integer $screen_height
 * @property string $user_agent
 * @property string $created_on
 * @property string $updated_on
 *
 * The followings are the available model relations:
 * @property UserLogin $login
 * @property User $user
 */
class eUserTech extends UserTech
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserTech the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_tech';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, login_id, screen_width, screen_height, user_agent', 'required'),
			array('user_id, login_id, screen_width, screen_height', 'numerical', 'integerOnly'=>true),
			array('user_agent', 'length', 'max'=>255),
                        array('created_on,updated_on', 'default', 'value' => date("Y-m-d H:i:s"),'setOnEmpty'=>false,'on' => 'insert'),
                        array('updated_on', 'default', 'value' => date("Y-m-d H:i:s"),'setOnEmpty'=>false,'on' => 'update'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, login_id, screen_width, screen_height, user_agent, created_on, updated_on', 'safe', 'on'=>'search'),
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
			'login' => array(self::BELONGS_TO, 'UserLogin', 'login_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'login_id' => 'Login',
			'screen_width' => 'Screen Width',
			'screen_height' => 'Screen Height',
			'user_agent' => 'User Agent',
			'created_on' => 'Created',
			'updated_on' => 'Updated',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('login_id',$this->login_id);
		$criteria->compare('screen_width',$this->screen_width);
		$criteria->compare('screen_height',$this->screen_height);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('created_on',$this->created_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->created_on)):null);
		$criteria->compare('updated_on',$this->updated_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->updated_on)):null);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}