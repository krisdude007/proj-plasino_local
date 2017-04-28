<div class="link">
    <div onclick="window.location = '<?php echo Yii::app()->createUrl('user/profile'); ?>'"><a href="<?php echo Yii::app()->createUrl('user/profile'); ?>"><?php echo Yii::t('youtoo','Basic Info'); ?></a></div>
    <hr></hr>
    <div onclick="window.location = '<?php echo Yii::app()->createUrl('user/password'); ?>'"><a href="<?php echo Yii::app()->createUrl('user/password'); ?>"><?php echo Yii::t('youtoo','Password'); ?></a></div>
    <hr></hr>
    <div onclick="window.location = '<?php echo Yii::app()->createUrl('user/credits'); ?>'"><a href="<?php echo Yii::app()->createUrl('user/credits'); ?>"><?php echo Yii::t('youtoo','Credits'); ?></a></div>
    <hr></hr>
<!--    <div onclick="window.location = '<?php //echo Yii::app()->createUrl('user/connections'); ?>'"><a href="<?php //echo Yii::app()->createUrl('user/connections'); ?>"><?php //echo Yii::t('youtoo','Connections'); ?></a></div>
    <hr></hr>-->
    <?php //$geoLocation = GeoUtility::GeoLocation(); if ($geoLocation['isValid']): ?>
    <div onclick="window.location = '<?php echo Yii::app()->createUrl('/payment'); ?>'"><a href="<?php echo Yii::app()->createUrl('/payment'); ?>"><?php echo Yii::t('youtoo','Payment Method'); ?></a></div>
    <hr></hr>
    <?php //endif; ?>
</div>