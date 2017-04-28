<?php

/**
 * This is the model class for table "program_updatedby".
 *
 * The followings are the available columns in table 'program_updatedby':
 * @property integer $id
 * @property integer $user_id
 * @property integer $is_updated
 * @property string $updated_month
 * @property string $created_on
 * @property string $updated_on
 */
class ProgramUpdatedBy extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'program_updatedby';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, created_on, updated_on', 'required'),
			array('user_id, is_updated', 'numerical', 'integerOnly'=>true),
			array('updated_month', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, is_updated, updated_month, created_on, updated_on', 'safe', 'on'=>'search'),
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
			'is_updated' => 'Is Updated',
			'updated_month' => 'Updated Month',
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
		$criteria->compare('is_updated',$this->is_updated);
		$criteria->compare('updated_month',$this->updated_month,true);
		$criteria->compare('created_on', $this->created_on !== null ? gmdate("Y-m-d H:i:s", strtotime($this->created_on)) : null);
                $criteria->compare('updated_on', $this->created_on !== null ? gmdate("Y-m-d H:i:s", strtotime($this->updated_on)) : null);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProgramUpdatedBy the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
