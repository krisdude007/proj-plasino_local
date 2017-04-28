<div class="form">
    <?php
     $form = $this->beginWidget('CActiveForm', array(
        'id' => 'image-upload-form',
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>
    <div style="font-size: 12px;">
        <?php //echo $form->errorSummary(array($image)); ?>
    </div>
    <div class="clearfix" style="padding-top:20px;">

    </div>
    <div class="clearfix">
        <div class="row">
            <?php echo $form->fileField($uploadimage, 'image'); ?>
            <?php echo $form->error($uploadimage, 'image'); ?>
        </div>
    </div>
    <div class="clearfix">
        <div style="margin-top:12px;margin-right:7px;">
            <div class="row">
                <?php echo $form->labelEx($uploadimage, 'title'); ?>
                <div class="helperText">This will help you find your photo.</div>
                <?php echo $form->textField($uploadimage, 'title', array('style' => 'width:205px')); ?>
                <?php echo $form->error($uploadimage, 'title'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($uploadimage, 'description'); ?>
                <div class="helperText">Describe your picture to let people know what it is</div>
                <?php echo $form->textArea($uploadimage, 'description', array('style' => 'width:205px')); ?>
                <?php echo $form->error($uploadimage, 'description'); ?>
            </div>
        </div>
    </div>
    <div class="bold" style="float:left; margin-bottom: 10px; font-size:13px">Also share on your social networks</div>
    <div class="clearfix"></div>
    <div class="row" style="font-size:11px; float:left;">
        <?php echo $form->checkBox($uploadimage, 'to_twitter'); ?>
        <?php echo $form->labelEx($uploadimage, 'to_twitter'); ?>
        <?php echo $form->error($uploadimage, 'to_twitter'); ?>
    </div>
    <div class="row" style="margin-left:20px;font-size:11px; margin-right: 10px;">
        <?php echo $form->checkBox($uploadimage, 'to_facebook'); ?>
        <?php echo $form->labelEx($uploadimage, 'to_facebook'); ?>
        <?php echo $form->error($uploadimage, 'to_facebook'); ?>
    </div>
    <div class="clearfix">
        <div class="row buttons" style="float:left;margin-top:12px;margin-right:7px;">
            <?php echo CHtml::submitButton(''); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->


