<div style="display: none;" id="affidavitReportByStationOverlay">
    <div id="affidavitReportByStationOverlayContent">
        <h2 style="font-size: 18px;">Affidavit Report by Station</h2>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'reportbystation-affidavit-form',
            'enableClientValidation' => true,
            'enableAjaxValidation' => false,
            'action' => '/adminAffidavitReport/reportbystation',
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
            'clientOptions' => array(
                'validateOnSubmit' => true,
                'validateOnChange' => true,
                'validateOnType' => false,
            )
                ));
        ?>

        <div id="affidavit_info">
        <label class="fab-left">Select Station for Report:</label>
        <div class="fab-clear" style="height:6px;"></div>
        <div><?php echo CHtml::dropDownList('user', 'id', CHtml::listData(eUser::model()->recent()->findAll(array('condition'=>'created_on >= :date','params'=>array(':date'=>Yii::app()->params['affidavit']['startDate']),)), 'id', 'username')); ?></div>
        <br/><br/>
        </div>

        <?php echo CHtml::submitButton('Submit'); ?>

        <?php $this->endWidget(); ?>
    </div>
</div>