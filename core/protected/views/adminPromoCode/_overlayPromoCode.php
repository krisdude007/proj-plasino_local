
<script>
$( function() {
    $( "#datepickerStart" ).datepicker();
    $( "#datepickerEnd" ).datepicker();
  } );
  
  </script>

</script>

<div style="display: none;" id="promocodeOverlay">
    <div id="promocodeOverlayContent">
        <h2 style="font-size: 18px;">Copy an Affidavit</h2>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'new-promocode-form',
            'enableClientValidation' => true,
            'enableAjaxValidation' => false,
            'action' => '/adminPromoCode/newpromo',
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
            'clientOptions' => array(
                'validateOnSubmit' => true,
                'validateOnChange' => true,
                'validateOnType' => false,
            )
                ));
        ?>
        <div id="promocode_info">
        <div class="clearfix" style="margin-top: 10px;">
            <div class="row" class="floatLeft marginRight10">
                <?php echo $form->labelEx($formPromo, 'freecredit_key'); ?>
                <?php echo $form->textField($formPromo, 'freecredit_key'); ?>
                <?php echo $form->error($formPromo, 'freecredit_key'); ?>
            </div>
            <div class="row" class="floatLeft marginRight10">
                <?php echo $form->labelEx($formPromo, 'freecredit_price'); ?>
                <?php echo $form->textField($formPromo, 'freecredit_price',array('value' => 5, 'readonly' => true, 'style' => 'width: 10%')); ?>
                <?php echo $form->error($formPromo, 'freecredit_price'); ?>
            </div>
        </div>
        <br/>
        <label class="fab-left">Promo Code Start Date:</label>
        <div class="fab-clear" style="height:6px;"></div>
        <div><?php echo $form->textField($formPromo, 'start_date', array('id' => 'datepickerStart', 'style' => 'width: 140px;', 'class' => ' datetimepicker')); ?></div>
        <div><?php echo $form->error($formPromo, 'start_date'); ?></div>
        

        <label class="fab-left">Promo Code End Date:</label>
        <div class="fab-clear" style="height:6px;"></div>
        <div><?php echo $form->textField($formPromo, 'end_date', array('id' => 'datepickerEnd', 'style' => 'width: 140px;', 'class' => ' datetimepicker')); ?></div>
        <div><?php echo $form->error($formPromo, 'end_date'); ?></div>
        <br/><br/>
        </div>

        <?php echo CHtml::submitButton('Submit'); ?>

        <?php $this->endWidget(); ?>
    </div>
</div>