<?php
$cs = Yii::app()->getClientScript();


?>
<div id="pageContainer" class="container">
    <div class="subContainer">
        <div class="row">&nbsp;</div>
         <div class="row">&nbsp;</div>
         <div class="row">&nbsp;</div>
         <div class="row">&nbsp;</div>
         <div class="row">&nbsp;</div>
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <h1><?php echo Yii::t('youtoo', 'Thank You') ?></h1>
                <?php if (isset(Yii::app()->session['twitter'])): ?>
                    <p>
                        <img src="/webassets/images/progress/4.png" style="max-width: 500px;"/>
                    </p>
                    <?php endif; ?>
            </div>
        </div>

         <div class="row">
             <div style="max-width:800px;margin: 0 auto;">
                 Your payment method has been successfully saved.
             </div>
         </div>
         <div class="row">&nbsp;</div>
         <div class="row">&nbsp;</div>
         <div class="row">&nbsp;</div>
        <div class="row">&nbsp;</div>
         <div class="row">&nbsp;</div>


        </div>
    </div>
</div>

