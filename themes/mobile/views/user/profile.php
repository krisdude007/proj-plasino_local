<div class="fabmob_content-container" style="padding: 2%;">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-profile-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => array(
            'class' => 'form-horizontal fabmob_condensed-form',
        ),
    ));
    ?>
    <br/>
    <div class="form-group" style='border: 2px solid #cfcfcf; border-radius: 4px; margin-bottom: 10px;'>
        <?php echo $form->textField($user, 'first_name', array('class' => 'form-control fabmob_round-border-top', 'placeholder' => Yii::t('youtoo', 'First Name'))); ?>
        <?php echo $form->error($user, 'first_name'); ?>
        <span class="help-block hidden"></span>
    </div>
    <div class="form-group" style='border: 2px solid #cfcfcf; border-radius: 4px; margin-bottom: 10px;'>
        <?php echo $form->textField($user, 'last_name', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'Last Name'))); ?>
        <?php echo $form->error($user, 'last_name'); ?>
        <span class="help-block hidden"></span>
    </div>
    <div class="form-group" style='border: 2px solid #cfcfcf; border-radius: 4px; margin-bottom: 10px;'>
        <?php echo $form->emailField($userEmail, 'email', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'Email'), 'readonly'=> true)); ?>
        <?php echo $form->error($userEmail, 'email'); ?>
        <?php echo $form->error($user, 'username'); ?>
        <span class="help-block hidden"></span>
    </div>
    <div class="form-group" style='border: 2px solid #cfcfcf; border-radius: 4px; margin-bottom: 10px;'>
        <?php echo $form->textField($userLocation, 'address1', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'Address'))); ?>
        <?php echo $form->error($userLocation, 'address1'); ?>
        <span class="help-block hidden"></span>
    </div>
    <div class="form-group" style='border: 2px solid #cfcfcf; border-radius: 4px; margin-bottom: 10px;'>
        <?php echo $form->textField($userLocation, 'city', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'City'))); ?>
        <?php echo $form->error($userLocation, 'city'); ?>
        <span class="help-block hidden"></span>
    </div>
    <div class="form-group" style='border: 2px solid #cfcfcf; border-radius: 4px; margin-bottom: 10px;'>
        <?php echo $form->dropDownList($userLocation, 'state', ClientUtility::getUSStates(),array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'State'))); ?>
        <?php echo $form->error($userLocation, 'state'); ?>
        <span class="help-block hidden"></span>
    </div>
    <div class="form-group" style='border: 2px solid #cfcfcf; border-radius: 4px; margin-bottom: 10px;'>
        <?php echo $form->textField($userLocation, 'postal_code', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'Zip Code'))); ?>
        <?php echo $form->error($userLocation, 'postal_code'); ?>
        <span class="help-block hidden"></span>
    </div>
    <div class="form-group" style='border: 2px solid #cfcfcf; border-radius: 4px;'>
        <?php echo $form->textField($userLocation, 'phone_number', array('class' => 'form-control', 'placeholder' => Yii::t('youtoo', 'Phone Number'))); ?>
        <?php echo $form->error($userLocation, 'phone_number'); ?>
        <span class="help-block hidden"></span>
    </div>
    <br/>
    <button type="submit" class="btn btn-default" class="btn btn-block"><?php echo Yii::t('youtoo', 'Save'); ?></button>
    <?php $this->endWidget(); ?>
</div>