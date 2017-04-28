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

        <br/>
        <div>
            <span class="bold">Title</span> <span class='smallText'>*Required</span>
            <div class="helperText">This will help you find your video.</div>
            <?php echo $form->textField($uploadvideo, 'title'); ?>
<?php echo $form->error($uploadvideo, 'title'); ?>
        </div>
        <br/>
        <div>
            <span class="bold">Description</span> <span class='smallText'>*Optional</span>
            <div class="helperText">Describe your video so people know what your video is about</div>
            <?php echo $form->textArea($uploadvideo, 'description', array('style' => 'width:207px')); ?>
<?php echo $form->error($uploadvideo, 'description'); ?>
        </div>
        <br/>
        <div class="bold">Also Post On Your Social Network</div>
        <div>
            <span style="font-size:11px">
                <?php echo $form->checkBox($uploadvideo, 'to_twitter'); ?>
                <?php echo $form->labelEx($uploadvideo, 'to_twitter'); ?>
<?php echo $form->error($uploadvideo, 'to_twitter'); ?>
            </span>
            <span style="margin-left:20px;font-size:11px">
                <?php echo $form->checkBox($uploadvideo, 'to_facebook'); ?>
                <?php echo $form->labelEx($uploadvideo, 'to_facebook'); ?>
<?php echo $form->error($uploadvideo, 'to_facebook'); ?>
            </span>
        </div>
        <br/>
        <div class="buttons">
<?php echo CHtml::submitButton('', array()); ?>
        </div>
        <br/>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    function customValidateFile(messages) {
        var nameC = '#<?php echo $infoFieldFile['inputID']; ?>';

        var control = $(nameC).get(0);

        //simulates the required validator and allowEmpty setting of the file validator
        if (control.files.length == 0) {
            messages.push("Video cannot be blank");
            return false;
        }

        file = control.files[0];

        //simulates the maxSize setting of the file validator
        if (file.size > 104857600) {
            messages.push("The file is too large to be uploaded. Maximum is 100 Mb");
            return false;
        }

        //simulates the format type (extra checking) see also http://en.wikipedia.org/wiki/Internet_media_type

        if (file.type != "video/quicktime") {
            messages.push("Invalid file type. Only .mov files can be uploaded");
            return false;
        }

    }

</script>
