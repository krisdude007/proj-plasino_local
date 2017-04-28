
<div class="col-sm-6" style="padding-top:4px;">
    <label for="image"><?php echo Yii::t('youtoo', 'Government issued ID with photograph') ?></label>
    <img style="width:150px; height:100px;" src="<?php echo ClientUserUtility::getPhotoId($user); ?>" /><br/>
    <label for="upload"><?php echo Yii::t('youtoo', 'Upload Photo ID') ?></label>
    <?php echo $form->fileField($userPhotoId, 'userPhotoId'); ?>
    <?php echo $form->error($userPhotoId, 'userPhotoId'); ?>
    <br/>
    <?php echo CHtml::submitButton(Yii::t('youtoo', 'Submit'), array('class' => 'btn btn-default btn-lg active',
    'role' => 'button'));
?>
</div>

