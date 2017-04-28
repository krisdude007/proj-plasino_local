<div style="display: none;" id="affidavitReportByMonthAndStationOverlay">
    <div id="affidavitReportByMonthAndStationOverlayContent">
        <h2 style="font-size: 18px;">Affidavit Report by Month And Station</h2>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'reportbymonth-affidavit-form',
            'enableClientValidation' => true,
            'enableAjaxValidation' => false,
            'action' => '/adminAffidavitReport/reportbymonthandstation',
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
        <label class="fab-left">Select Station for Report:</label>
        <div class="fab-clear" style="height:6px;"></div>
        <div><?php echo CHtml::dropDownList('user', 'id', CHtml::listData(eUser::model()->recent()->findAll(array('condition'=>'created_on >= :date','params'=>array(':date'=>Yii::app()->params['affidavit']['startDate']),)), 'id', 'username'),array('empty' => 'Select a Station')); ?></div>
        <div><?php //echo $form->error($formProgram, 'station'); ?></div>
        <br/><br/>
        </div>

        <?php echo CHtml::submitButton('Submit'); ?>

        <?php $this->endWidget(); ?>
    </div>
</div>