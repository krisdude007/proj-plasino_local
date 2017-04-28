<div id="pageContainer" class="container">
    <div class="subContainer">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <h1><?php echo Yii::t('youtoo','Sorry, wrong answer.')?></h1>
                <p class="lead" style="font-weight: bold;">
                    <?php echo Yii::t('youtoo',"Play again to increase your chances to win");?>
                </p>
                <p>
                    <?php $price = isset($game->price) ? $game->price : 1; echo Yii::t('youtoo',"Thank you for playing the game.  We have charged your credit card $".$price.".00 and you have earned 10 credits.");?>
                </p>
                <p>
                    <a href="<?php echo $this->createUrl('/site/redeem', array()); ?>" class="btn btn-default btn-lg active" role="button"><?php echo Yii::t('youtoo','Redeem your points')?></a>
                </p>
                <p>
                    <a href="<?php echo $this->createUrl('/site/index', array()); ?>" class="btn btn-default btn-lg active" role="button"><?php echo Yii::t('youtoo','Play again')?></a>
                </p>
                <br/>
                <p>
                    <table style="width: 100%;border: 1px solid #cdcdcd;text-align: left;">
                        <tr>
                        <td style='width:50%;background-color: #dedede;padding: 12px; color: #171717;'>
                            <h4 style="text-align: left;"><?php echo Yii::t('youtoo','Thank you.')?></h4>
                            <h5><?php echo Yii::t('youtoo','US Games')?></h5>
                            <p>
                            <h5><?php echo Yii::t('youtoo','Order number')?>: <?php $orderNo='OD1234567'; echo $orderNo ?></h5>
                            <h5><?php echo Yii::t('youtoo','Order date')?>: <?php $date = date_default_timezone_get(); echo(date('l dS F Y h:i A T', strtotime($date))) ?></h5>
                            <h5><?php echo Yii::t('youtoo','Payment method: WEB')?></h5>
                            </p>
                        </td>
                        <td style='width:50%;background-color: #ffffff;padding: 12px; color: #171717;'>
                            <div style='overflow:hidden;'>
                                <h4 style='display: inline;'><?php echo Yii::t('youtoo','Credits earned')?>:</h4> <h5 style='display: inline;'><?php $credit=10; echo $credit ?> <?php echo Yii::t('youtoo','Credits')?></h5>
                            </div>
                            <br/>
                            <hr style='margin: 2px 0px;'>
                            <div style='overflow:hidden;'>
                                <h4 style='float:left;width: 65%;'><?php echo Yii::t('youtoo','Item')?></h4><h4 style='float:left;'><?php echo Yii::t('youtoo','Price')?></h4>
                            </div>
                            <hr style='margin: 2px 0px;'>
                            <div style='overflow:hidden;'>
                                <h4 style='float:left;width: 65%;'><?php echo Yii::t('youtoo','Game fee:')?></h4><h4 style='float:left;'> $<?php isset($game->price) ? $game->price : 1 ; echo $price ?>.00</h4>
                            </div>
                            <hr style='margin: 2px 0px;'>
                            <div style='overflow:hidden;'>
                                <h4 style='float:left;width: 65%;'><?php echo Yii::t('youtoo','Total:')?></h4><h4 style='float:left;'> $<?php isset($game->price) ? $game->price : 1 ; echo $price ?>.00</h4>
                            </div>
                        </td>
                        </tr>
                    </table>
                </p>
            </div>
        </div>
    </div>
</div>
