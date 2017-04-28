<?php
$cs = Yii::app()->getClientScript();
?>
<div id="pageContainer" class="container">
    <div class="subContainer">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <h1><?php echo Yii::t('youtoo', 'Payment Method') ?></h1>
                <?php if (isset(Yii::app()->session['twitter'])): ?>
                    <p>
                        <img src="/webassets/images/progress/3.png" style="max-width: 500px;"/>
                    </p>
                <?php endif; ?>
                <p class="lead">
                    <?php echo Yii::t('youtoo', 'Please authorize payment to be able to participate in the competition.') ?>
                </p>
                <p>
                    <a href="<?php echo $this->createUrl('/site/index', array()); ?>" class="btn btn-default btn-lg active" role="button"><?php echo Yii::t('youtoo','Return back to the game')?></a>
                </p>
            </div>
        </div>
    </div>
</div>