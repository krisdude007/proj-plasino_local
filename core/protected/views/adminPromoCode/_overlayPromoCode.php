<script>
    $(function () {
        $("#datepickerStart").datepicker();
        $("#datepickerEnd").datepicker();
    });
</script>
<div style="display: none;" id="promocodeOverlay">
    <div id="promocodeOverlayContent">
        <h2 style="font-size: 18px;">Generate New Promo Code for all users</h2>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'new-promocode-form',
            'enableClientValidation' => true,
            'enableAjaxValidation' => true,
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
                <div class="row floatLeft marginRight10">
                    <div class="col-sm-6">
                        <?php echo $form->labelEx($formPromo, 'freecredit_key'); ?>
                        <?php echo $form->textField($formPromo, 'freecredit_key'); ?>
                        <?php echo $form->error($formPromo, 'freecredit_key'); ?>
                    </div>
                    <div class="col-sm-6">
                        <?php echo CHtml::button('Generate New Promo Code', array('id' => 'generatePromoCodeOverLay')); ?>
                    </div>
                </div>
                <div class="row floatLeft marginRight10">
                    <?php echo $form->labelEx($formPromo, 'freecredit_price'); ?>
                    <?php echo $form->textField($formPromo, 'freecredit_price', array('value' => 5, 'readonly' => true, 'style' => 'width: 10%')); ?>
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
<script>
    $('#generatePromoCodeOverLay').on('click', function () {
        //$('#FormPromoCode_freecredit_key').val('<?php //echo substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), -6);  ?>');
        $.ajax({
            type: 'post',
            url: '/adminPromoCode/ajaxgeneratenewpromo',
            data: ({
                promo: true,
            }),
            dataType: 'json',
            success: function (data) {
                $('#FormPromoCode_freecredit_key').val(data.success);
            }
        });
    });

    $('.datetimepicker').on('change', function () {
        var start_date = new Date($('#datepickerStart').val());
        var end_date = new Date($('#datepickerEnd').val());
        if (start_date > end_date) {
            alert('Invalid date. The start date cannot be greater than end date.');
            $('#datepickerStart').val('');
            $('#datepickerEnd').val('');
        }
    });
</script>