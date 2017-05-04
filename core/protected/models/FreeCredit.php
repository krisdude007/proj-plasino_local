<?php

/**
 * This is the model class for table "free_credit".
 *
 * The followings are the available columns in table 'free_credit':
 * @property integer $id
 * @property integer $user_id
 * @property string $freecredit_key
 * @property double $freecredit_price
 * @property string $user_email
 * @property string $start_date
 * @property string $end_date
 * @property integer $is_code_used
 * @property integer $code_used_by
 * @property integer $is_deleted
 * @property string $created_on
 * @property string $updated_on
 *
 * The followings are the available model relations:
 * @property User $user
 */
class FreeCredit extends CActiveRecord
{
    public $code_update_count;
    public $code_added_by;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'free_credit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, freecredit_key, freecredit_price, user_email, start_date, end_date', 'required'),
			array('user_id, is_code_used, code_used_by, is_deleted, code_update_count, code_added_by', 'numerical', 'integerOnly'=>true),
			array('freecredit_price', 'numerical'),
			array('freecredit_key, user_email', 'length', 'max'=>256),
			array('start_date, end_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, freecredit_key, freecredit_price, user_email, start_date, end_date, is_code_used, code_used_by, code_added_by, code_update_count, is_deleted, created_on, updated_on', 'safe', 'on'=>'search'),
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
			'freecredit_key' => 'Freecredit Key',
			'freecredit_price' => 'Freecredit Price',
			'user_email' => 'User Email',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
                        'code_update_count' => 'Code Update Count',
                        'code_added_by' => 'Code Added By',
			'is_code_used' => 'Is Code Used',
			'code_used_by' => 'Code Used By',
			'is_deleted' => 'Is Deleted',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
		);
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('freecredit_key',$this->freecredit_key,true);
		$criteria->compare('freecredit_price',$this->freecredit_price);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
                $criteria->compare('code_update_count',$this->code_update_count,true);
		$criteria->compare('code_added_by',$this->code_added_by,true);
		$criteria->compare('is_code_used',$this->is_code_used);
		$criteria->compare('code_used_by',$this->code_used_by);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('created_on',$this->created_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->created_on)):null);
		$criteria->compare('updated_on',$this->created_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->updated_on)):null);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FreeCredit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
