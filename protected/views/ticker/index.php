<div id="pageContainer" class="container">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'ticker-form',
        'enableAjaxValidation' => true,
    ));
    ?>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2" style="padding: 1% 0px;">
                <label for="Ticker"><?php echo Yii::t('youtoo', 'Ticker *') ?></label>
                <?php echo $form->textField($model, 'ticker', Array('style' => 'width:100%', 'class' => 'counter', 'value' => '', 'maxlength' => '140')); ?>
                <?php echo $form->error($model, 'ticker'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2" style="padding: 1% 0px;">
            <div class="text-center">
                <?php echo $form->hiddenField($model, 'source', Array('value' => 'web')); ?>
                <?php echo CHtml::submitButton(Yii::t('youtoo','Submit'), array('class' => 'btn btn-default btn-lg active')); ?>
            </div>

        </div><!-- form -->
    </div>
    <?php $this->endWidget(); ?>
</div>