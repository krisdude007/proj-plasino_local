<?php
class clientImage extends eImage {
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
        public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        $extendedRules = array(
            //bit value 128 for "new" and 16 for "new_tv"
            array('statusbit', 'default', 'value' => 144, 'on' => 'insert'),
            array('extendedStatus', 'safe')
        );

        $defaultRules = array(
            array('source', 'required'),
            //array('image','required', 'on'=>'insert', 'message'=>Yii::t('youtoo','Image cannot be blank')),
            array('created_on, updated_on', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'insert'),
            array('updated_on', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'update'),
            array('status', 'default', 'value' => 'new', 'on' => 'insert'),
            array('filename', 'unique', ),
            // a form model should be handling this, .. for now there is none, and no validation is set against uploading other image types such as bitmaps, so reenabled validation in model.
            array('image', 'file', 'types' => Yii::app()->params['custom_params']['image_upload_filetype'],'maxSize'=>30 * 1024 * 1024,'tooLarge'=>'The File is Too large to be uploaded.','wrongType'=>Yii::t('youtoo',Yii::app()->params['custom_params']['error_invalid_type'].'. '.Yii::app()->params['custom_params']['image_upload_filetype']), 'allowEmpty'=>true),
            array('view_key', 'default', 'value' => md5(uniqid('', true)), 'on' => 'insert'),
            array('user_id, entity_id, watermarked, to_facebook, to_twitter, arbitrator_id, is_avatar', 'numerical', 'integerOnly' => true),
            array('title, view_key, source, description', 'length', 'max' => 255),
            array('status', 'length', 'max' => 8),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, filename, watermarked, title, description, view_key, source, to_facebook, to_twitter, arbitrator_id, status, is_avatar, status_date, created_on, updated_on', 'safe', 'on' => 'search'),
        );

        if (Yii::app()->params['image']['useExtendedFilters']) {
            return CMap::mergeArray($defaultRules, $extendedRules);
        } else {
            return $defaultRules;
        }
    }
    public function attributeLabels() {
        return array(
            'image' => Yii::t('youtoo','Avatar'),
        );
    }
}
?>
