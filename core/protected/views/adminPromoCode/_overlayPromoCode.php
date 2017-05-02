<script>
$(document).ready(function() {
    $("#datetimepickerClose").datetimepicker({
        maxDate: "0",
        onSelect: function () {
            $(this).attr('value', this.value);
        }
    });
    
    $("#datetimepickerOpen").datetimepicker({
        maxDate: "0",
        onSelect: function () {
            $(this).attr('value', this.value);
        }
    });
});

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
        <label class="fab-left">Select Month to copy from:</label>
        <div class="fab-clear" style="height:6px;"></div>
        <div><?php echo $form->textField($formPromo, 'start_date', array('id' => 'datetimepickerOpen', 'style' => 'width: 140px;', 'class' => ' datetimepicker')); ?></div>
        <div><?php echo $form->error($formPromo, 'start_date'); ?></div>
        <br/><br/>

        <label class="fab-left">Select Month to copy to:</label>
        <div class="fab-clear" style="height:6px;"></div>
        <div><?php echo $form->textField($formPromo, 'end_date', array('id' => 'datetimepickerOpen', 'style' => 'width: 140px;', 'class' => ' datetimepicker')); ?></div>
        <div><?php echo $form->error($formPromo, 'end_date'); ?></div>
        <br/><br/>
        </div>

        <?php echo CHtml::submitButton('Submit'); ?>

        <?php $this->endWidget(); ?>
    </div>
</div>