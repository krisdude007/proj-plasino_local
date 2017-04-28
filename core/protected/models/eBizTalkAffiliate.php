<?php

/**
 * This is the model class for table "biztalk_affiliate".
 *
 * The followings are the available columns in table 'biztalk_affiliate':
 * @property integer $id
 * @property integer $user_id
 * @property string $contact
 * @property string $license_market_rank
 * @property string $market_name
 * @property string $city_of_license
 * @property string $state_of_license
 * @property string $fm_frequency
 * @property string $am_frequency
 * @property string $created_on
 * @property string $updated_on
 */
class eBizTalkAffiliate extends BizTalkAffiliate
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'biztalk_affiliate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contact, contact_email, contact_phone_no, city_of_license', 'required'),
			array('user_id, contact_phone_no', 'numerical', 'integerOnly'=>true),
			array('contact, contact_phone_no', 'length', 'max'=>20),
			array('license_market_rank', 'length', 'max'=>10),
                        array('contact_email, radio_dma, call_letters', 'length', 'max'=>255),
			array('market_name, city_of_license, state_of_license, fm_frequency, am_frequency', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, contact, contact_email, contact_phone_no, radio_dma,license_market_rank, call_letters, market_name, city_of_license, state_of_license, fm_frequency, am_frequency, created_on, updated_on', 'safe', 'on'=>'search'),
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
			'contact' => 'Contact',
                        'contact_email' => 'Contact Email',
                        'contact_phone_no' => 'Contact Phone No.',
                        'radio_dma' => 'Radio DMA',
			'license_market_rank' => 'License Market Rank',
                        'call_letters' => 'Call Letters',
			'market_name' => 'Market Name',
			'city_of_license' => 'City Of License',
			'state_of_license' => 'State Of License',
			'fm_frequency' => 'Fm Frequency',
			'am_frequency' => 'Am Frequency',
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
		$criteria->compare('contact',$this->contact,true);
                $criteria->compare('contact_email',$this->contact_email,true);
                $criteria->compare('contact_phone_no',$this->contact_phone_no,true);
                $criteria->compare('radio_dma',$this->radio_dma,true);
		$criteria->compare('license_market_rank',$this->license_market_rank,true);
                $criteria->compare('call_letters',$this->call_letters,true);
		$criteria->compare('market_name',$this->market_name,true);
		$criteria->compare('city_of_license',$this->city_of_license,true);
		$criteria->compare('state_of_license',$this->state_of_license,true);
		$criteria->compare('fm_frequency',$this->fm_frequency,true);
		$criteria->compare('am_frequency',$this->am_frequency,true);
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
	 * @return BizTalkAffiliate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
