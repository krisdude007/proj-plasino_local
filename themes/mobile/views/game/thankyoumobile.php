<div class='as-table'>
    <div style='position: relative;'>
        <img class="homeImage" src="/webassets/mobile/images/image_congrats.png"/>
    </div><br/><br/>
    <div class="fabmob_content-container text-center">
        <div>
            <?php //foreach($games as $game) {
                       //if(date('U') > strtotime($game->open_date) && date('U') < strtotime($game->close_date))  {
                            //if(sizeof($game->gameChoiceAnswers) != 5) {?>
            <a href='<?php echo Yii::app()->createUrl('/site/index'); ?>'><button class="btn btn-default" style="min-width: 145px; min-height: 40px; font-size: 16px; "><?php echo Yii::t('youtoo','Play Again'); ?></button></a>
            <?php //}
             //}
            //}?>
        </div>
        <br/>
        <br/>
        <br/>
        <div>
            <a href='<?php echo Yii::app()->createUrl('/site/indexlinks'); ?>'><button class="btn btn-default" style="min-width: 145px; min-height: 40px; font-size: 16px; "><?php echo Yii::t('youtoo','View Games'); ?></button></a>
        </div>
        <br/>
        <div>
            <a href='<?php echo Yii::app()->createUrl('/redeem'); ?>'><button class="btn btn-default" style="min-width: 145px; min-height: 40px; font-size: 16px; "><?php echo Yii::t('youtoo','Shop Now'); ?></button></a>
        </div>
    </div>
</div>
