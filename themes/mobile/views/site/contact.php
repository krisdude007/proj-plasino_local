<div class='text' style='padding: 25px;'>
    <?php echo Yii::t('youtoo','What can we help you with today?'); ?>
    <br/><br/>
    <div class="form">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'contact-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>
        <div class='row'>
            <div class="col-sm-3 col-sm-offset-1">
                <?php echo Yii::t('youtoo','Department'); ?>
            </div>
            <div class='col-sm-8'>
                <?php
                echo $form->dropDownList($model, 'department', array(
                    'General Question' => Yii::t('youtoo','General Question'),
                    'Technical Question' => Yii::t('youtoo','Technical Question'),
                    'Operations' => Yii::t('youtoo','Operations'),
                    'Sales' => Yii::t('youtoo','Sales'),
                ));
                ?>
            </div>
        </div>
        <div class='row'>
            <div class="col-sm-3 col-sm-offset-1">
                <?php echo $form->labelEx($model, Yii::t('youtoo','name')); ?>
            </div>
            <div class='col-sm-8'>
                <?php echo $form->textField($model, 'name'); ?>
                <?php echo $form->error($model, 'name'); ?>
            </div>
        </div>
        <div class='row'>
            <div class="col-sm-3 col-sm-offset-1">
                <?php echo $form->labelEx($model, Yii::t('youtoo','email')); ?>
            </div>
            <div class='col-sm-8'>
                <?php echo $form->textField($model, 'email'); ?>
                <?php echo $form->error($model, 'email'); ?>
            </div>
        </div>
        <div class='row'>
            <div class="col-sm-3 col-sm-offset-1">
                <?php echo $form->labelEx($model, Yii::t('youtoo','subject')); ?>
            </div>
            <div class='col-sm-8'>
                <?php echo $form->textField($model, 'subject'); ?>
                <?php echo $form->error($model, 'subject'); ?>
            </div>
        </div>
        <div class='row'>
            <div class="col-sm-3 col-sm-offset-1">
                <?php echo $form->labelEx($model, Yii::t('youtoo','message')); ?>
            </div>
            <div class='col-sm-7'>
                <?php echo $form->textArea($model, 'message', array('rows' => 6, 'cols' => '30')); ?>
                <?php echo $form->error($model, 'message'); ?>
            </div>
        </div>
        <div><?php echo Yii::t('youtoo','*Requerido'); ?></div>
        <div style='text-align: center;'>
            <button class='btn btn-md'><?php echo Yii::t('youtoo','Send'); ?></button>
        </div>
        <?php $this->endWidget(); ?>
    </div><!-- form -->
</div>