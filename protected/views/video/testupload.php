<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'video-uploader-form',
        'method' => 'POST',
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data',),
    ));
    ?>
    <div>
        <div style="font-size: 12px;">
            .mov only*
        </div>
        <div>
            <?php echo $form->fileField($uploadvideo, 'video'); ?>
            <?php
            echo $form->error($uploadvideo, 'video', array('clientValidation' => 'js:customValidateFile(messages)'), false, true);
            $infoFieldFile = (end($form->attributes));
            ?>
        </div>

        <?php echo CHtml::submitButton('Submit', array()); ?>
        </div>
        <br/>
    </div>
<?php $this->endWidget(); ?>
