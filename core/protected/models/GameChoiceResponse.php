<?php

/**
 * This is the model class for table "game_choice_response".
 *
 * The followings are the available columns in table 'game_choice_response':
 * @property integer $id
 * @property integer $game_choice_id
 * @property integer $game_choice_answer_id
 * @property integer $sms_id
 * @property integer $user_id
 * @property integer $transaction_id
 * @property integer $is_winner
 * @property integer $is_correct
 * @property string $game_unique_id
 * @property double $game_price
 * @property string $no_of_questions
 * @property string $bonus_credit
 * @property string $source
 * @property string $ip_address
 * @property string $ip_derivedcity
 * @property string $created_on
 * @property string $updated_on
 *
 * The followings are the available model relations:
 * @property GameChoiceAnswer $gameChoiceAnswer
 * @property GameChoice $gameChoice
 * @property User $user
 */
class GameChoiceResponse extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'game_choice_response';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('game_choice_id, game_choice_answer_id, user_id, game_price, source, created_on, updated_on', 'required'),
			array('game_choice_id, game_choice_answer_id, sms_id, user_id, transaction_id, is_winner, is_correct', 'numerical', 'integerOnly'=>true),
			array('game_price', 'numerical'),
			array('game_unique_id', 'length', 'max'=>50),
			array('no_of_questions, bonus_credit, ip_address, ip_derivedcity', 'length', 'max'=>255),
			array('source', 'length', 'max'=>256),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, game_choice_id, game_choice_answer_id, sms_id, user_id, transaction_id, is_winner, is_correct, game_unique_id, game_price, no_of_questions, bonus_credit, source, ip_address, ip_derivedcity, created_on, updated_on', 'safe', 'on'=>'search'),
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
			'gameChoiceAnswer' => array(self::BELONGS_TO, 'GameChoiceAnswer', 'game_choice_answer_id'),
			'gameChoice' => array(self::BELONGS_TO, 'GameChoice', 'game_choice_id'),
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
			'game_choice_id' => 'Game Choice',
			'game_choice_answer_id' => 'Game Choice Answer',
			'sms_id' => 'Sms',
			'user_id' => 'User',
			'transaction_id' => 'Transaction',
			'is_winner' => 'Is Winner',
			'is_correct' => 'Is Correct',
			'game_unique_id' => 'Game Unique',
			'game_price' => 'Game Price',
			'no_of_questions' => 'No Of Questions',
			'bonus_credit' => 'Bonus Credit',
			'source' => 'Source',
			'ip_address' => 'Ip Address',
			'ip_derivedcity' => 'Ip Derivedcity',
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
		$criteria->compare('game_choice_id',$this->game_choice_id);
		$criteria->compare('game_choice_answer_id',$this->game_choice_answer_id);
		$criteria->compare('sms_id',$this->sms_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('transaction_id',$this->transaction_id);
		$criteria->compare('is_winner',$this->is_winner);
		$criteria->compare('is_correct',$this->is_correct);
		$criteria->compare('game_unique_id',$this->game_unique_id,true);
		$criteria->compare('game_price',$this->game_price);
		$criteria->compare('no_of_questions',$this->no_of_questions,true);
		$criteria->compare('bonus_credit',$this->bonus_credit,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('ip_derivedcity',$this->ip_derivedcity,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GameChoiceResponse the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
