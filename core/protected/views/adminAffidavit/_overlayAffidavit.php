<div style="display: none;" id="affidavitOverlay">
    <div id="affidavitOverlayContent">
        <h2 style="font-size: 18px;">Copy an Affidavit</h2>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'copy-affidavit-form',
            'enableClientValidation' => true,
            'enableAjaxValidation' => false,
            'action' => '/adminAffidavit/copymonth',
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
            'clientOptions' => array(
                'validateOnSubmit' => true,
                'validateOnChange' => true,
                'validateOnType' => false,
            )
                ));
        ?>

        <div id="affidavit_info">
        <label class="fab-left">Select Month to copy from:</label>
        <div class="fab-clear" style="height:6px;"></div>
        <div><?php echo $form->dropDownList($formProgram, "month", ClientUtility::getMonthsOfYear()); ?></div>
        <div><?php echo $form->error($formProgram, 'month'); ?></div>
        <br/><br/>

        <label class="fab-left">Select Month to copy to:</label>
        <div class="fab-clear" style="height:6px;"></div>
        <div><?php echo $form->dropDownList($formProgram, "new_month", ClientUtility::getMonthsOfYear()); ?></div>
        <div><?php echo $form->error($formProgram, 'new_month'); ?></div>
        <br/><br/>
        </div>

        <?php echo CHtml::submitButton('Submit'); ?>

        <?php $this->endWidget(); ?>
    </div>
</div>