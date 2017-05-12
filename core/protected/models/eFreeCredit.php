<?php

class eFreeCredit extends FreeCredit
{
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, freecredit_key, freecredit_price, user_email, start_date, end_date', 'required'),
			array('user_id, is_code_used, code_used_by, is_deleted, is_expired, code_added_by, code_update_count', 'numerical', 'integerOnly'=>true),
			array('freecredit_key, user_email', 'length', 'max'=>256),
                        array('freecredit_price', 'numerical'),
                        array('start_date, end_date', 'safe'),
                        array('created_on, updated_on', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'insert'),
                        array('updated_on', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, freecredit_key, freecredit_price, user_email, start_date, end_date, is_code_used, code_used_by, is_deleted, is_expired, created_on, updated_on', 'safe', 'on'=>'search'),
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
			'user_email' => 'User Email',
			'is_code_used' => 'Is Code Used',
                        'code_used_by' => 'Code Used By',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
		);
	}
        
         public function scopes() {
            return array(
                'recent' => array('order' => '`t`.`id` DESC'),
                'asc' => array('order' => '`t`.`id` ASC'),
                'isCodeUsed' => array(
                    'condition' => "is_code_used = '1'",
                ),
                'isCodeNotUsed' => array(
                    'condition' => "is_code_used = '0'",
                ),
                'isNotDeleted' => array(
                    'condition' => "is_deleted = '0'",
                ),
                'isDeleted' => array(
                    'condition' => "is_deleted = '1'",
                ),
                'isExpired' => array(
                    'condition' => "is_expired = '0'",
                ),
                'isNotExpired' => array(
                    'condition' => "is_expired = '1'",
                ),
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
	public function search($perPage = 0)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                $criteria->together = true;
                $criteria->condition = "is_deleted = '0'";

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.user_id',$this->user_id);
		$criteria->compare('t.freecredit_key',$this->freecredit_key,true);
                $criteria->compare('t.freecredit_price', $this->freecredit_price,true);
		$criteria->compare('t.user_email',$this->user_email,true);
                $criteria->compare('t.start_date',$this->start_date,true);
                $criteria->compare('t.end_date',$this->end_date,true);
                $criteria->compare('t.code_update_count',$this->code_update_count,true);
		$criteria->compare('t.code_added_by',$this->code_added_by,true);
		$criteria->compare('t.is_code_used',$this->is_code_used);
                $criteria->compare('t.code_used_by',$this->code_used_by);
                $criteria->compare('t.is_deleted',$this->is_deleted);
                $criteria->compare('t.is_expired',$this->is_expired);
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
	 * @return FreeCredit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
