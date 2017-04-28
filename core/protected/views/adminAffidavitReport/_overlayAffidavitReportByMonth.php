<div style="display: none;" id="affidavitReportByMonthOverlay">
    <div id="affidavitReportByMonthOverlayContent">
        <h2 style="font-size: 18px;">Affidavit Report by Month</h2>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'reportbymonth-affidavit-form',
            'enableClientValidation' => true,
            'enableAjaxValidation' => false,
            'action' => '/adminAffidavitReport/reportbymonth',
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
            'clientOptions' => array(
                'validateOnSubmit' => true,
                'validateOnChange' => true,
                'validateOnType' => false,
            )
                ));
        ?>

        <div id="affidavit_info">
        <label class="fab-left">Select Month for Report:</label>
        <div class="fab-clear" style="height:6px;"></div>
        <div><?php echo $form->dropDownList($formProgramMonth, "month", ClientUtility::getMonthsOfYear()); ?></div>
        <div><?php echo $form->error($formProgramMonth, 'month'); ?></div>
        <br/><br/>

        </div>

        <?php echo CHtml::submitButton('Submit'); ?>

        <?php $this->endWidget(); ?>
    </div>
</div>