
   <div id="pageContainer" class="container" style="min-height: 655px;">
    <div class="subContainer" style="padding: 0px;">
        <?php $this->renderPartial('_sideBar', array()); ?>
        
        <div class="col-sm-2"></div>
        <div class="contact-formx col-sm-8">
        <div class="col-sm-12 col-xs-12" style="margin:0 auto;">
            <h3 style="font-weight: 300; margin-bottom: 10px;">
            <?php echo Yii::t('youtoo', 'What can we help you with today?'); ?></h3>
           <div style="background-color: rgba(255, 255, 255, 0.51);padding:12px;">
             <div class="form" style="clear:both;background-color: white;
padding: 20px;">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'contact-form',
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                ));
                ?>


                        <div class="col-sm-12" style='margin-top: 25px;'>
                            <?php
                            echo $form->dropDownList($model, 'department', array(
                                'General Question' => Yii::t('youtoo','General Question'),
                                'Technical Question' => Yii::t('youtoo','Technical Question'),
                                'Operations' => Yii::t('youtoo','Operations'),
                                'Sales' => Yii::t('youtoo','Sales'),
                            ), array('class' => 'form-control'));
                            ?>

                    <div class='row'>
                        <div class="col-sm-12" style='margin-top: 20px;'>
                            <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'Name').' *')); ?>
                            <?php echo $form->error($model, 'name'); ?>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-sm-12" style='margin-top: 20px;'>
                            <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'Email').' *')); ?>
                            <?php echo $form->error($model, 'email'); ?>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-sm-12" style='margin-top: 20px;'>
                            <?php echo $form->textField($model, 'subject', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'Subject').' *')); ?>
                            <?php echo $form->error($model, 'subject'); ?>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-sm-12 contact-message-box" style='margin-top: 20px;'>
                            <?php echo $form->textArea($model, 'message', array('rows' => 6, 'cols' => 10, 'placeholder' => Yii::t('youtoo', 'Message').' *')); ?>
                            <?php echo $form->error($model, 'message'); ?>
                        </div>
                        <div class='row'><?php echo Yii::t('youtoo','*required'); ?></div>
                    </div>

                    <div class='row contact_bottom'>
                        <div class='col-sm-3 col-sm-offset-1'></div>
                        <div class='col-sm-12'><br/>
                            <div class='row'><?php echo CHtml::submitButton(Yii::t('youtoo','Send'), array('class' => 'btn btn-default btn-lg')); ?></div>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                </div><!-- form -->
            </div>
            
            
            </div>
            
        </div>
	   </div>
	   
        
             <div class="col-sm-2"></div>
	   
    </div>
</div>
