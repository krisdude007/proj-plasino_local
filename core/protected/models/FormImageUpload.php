<?php

class FormImageUpload extends CFormModel {

    public $image;
    public $title;
    public $description;
    public $is_avatar;
    public $filename;
    public $to_twitter;
    public $to_facebook;
    public $source;

    public function rules() {

        return array(
            array('image','required', 'message'=>Yii::t('youtoo','Image cannot be blank')),
            array('title', 'required', 'message'=>Yii::t('youtoo','Title cannot be blank')),
            array('image', 'file', 'types' => Yii::app()->params['image_upload_filetype'],'maxSize'=>Yii::app()->params['image']['maxUploadFileSize'],'tooLarge'=>'The File is Too large to be uploaded.','wrongType'=>'Invalid file type. Only '.Yii::app()->params['image']['acceptedFileTypes'].' files can be uploaded'),
            array('is_avatar', 'in', 'range'=>array(0,1)),
            array('filename', 'unique', ),
            array('to_facebook, to_twitter, is_avatar', 'numerical', 'integerOnly' => true),
            array('title, image, filename, user_id, description, is_avatar, to_twitter, to_facebook', 'safe', 'on'=>'search')
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'image' => 'Image',
            'title' => 'Title',
            'description' =>'Descrption',
            'to_facebook' => 'To Facebook',
            'to_twitter' => 'To Twitter',
        );
    }

    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.
        $criteria=new CDbCriteria;
        $criteria->compare('id',$this->id);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('image',$this->image,true);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('view_key',$this->view_key,true);
        $criteria->compare('source',$this->source,true);
        $criteria->compare('to_facebook',$this->to_facebook);
        $criteria->compare('to_twitter',$this->to_twitter);
        $criteria->compare('arbitrator_id',$this->arbitrator_id);
        $criteria->compare('created_on',$this->created_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->created_on)):null);
        $criteria->compare('updated_on',$this->updated_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->updated_on)):null);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

}
