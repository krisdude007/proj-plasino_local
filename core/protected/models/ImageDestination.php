<?php

/**
 * This is the model class for table "image_destination".
 *
 * The followings are the available columns in table 'image_destination':
 * @property integer $id
 * @property integer $image_id
 * @property integer $user_id
 * @property integer $destination_id
 * @property string $response
 * @property string $created_on
 * @property string $updated_on
 *
 * The followings are the available model relations:
 * @property Destination $destination
 * @property Image $image
 * @property User $user
 */
class ImageDestination extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'image_destination';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('image_id, user_id, destination_id, response, created_on, updated_on', 'required'),
            array('image_id, user_id, destination_id', 'numerical', 'integerOnly'=>true),
            array('response', 'length', 'max'=>255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, image_id, user_id, destination_id, response, created_on, updated_on', 'safe', 'on'=>'search'),
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
            'destination' => array(self::BELONGS_TO, 'Destination', 'destination_id'),
            'image' => array(self::BELONGS_TO, 'Image', 'image_id'),
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
            'image_id' => 'Image',
            'user_id' => 'User',
            'destination_id' => 'Destination',
            'response' => 'Response',
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
        $criteria->compare('image_id',$this->image_id);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('destination_id',$this->destination_id);
        $criteria->compare('response',$this->response,true);
        $criteria->compare('created_on',$this->created_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->created_on)):null);
        $criteria->compare('updated_on',$this->updated_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->updated_on)):null);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ImageDestination the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}