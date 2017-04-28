<div id="pageContainer">
    <div class="subContainer" style="padding:0px;">
        <?php $this->renderPartial('_sideBar', array()); ?>
        <div class="row" style="margin-right: 0px; margin-left: 0px;">
            <div class="col-sm-12 col-xs-12">
                <h3><?php echo Yii::t('youtoo', 'Spend the bonus bucks you have earned for great prizes.') ?></h3>
                <div class="borderBottom"><?php echo Yii::t('youtoo','As a reminder, 1 bonus buck is given to you for every $1 spent. Have fun shopping.');?></div>
            </div>
        </div>
        <div class="row" style="margin-right: 0px; margin-left: 0px; overflow: scroll; max-height: 600px;">
            <div class="col-sm-12">

                <?php
                $prizeFormat = '
                    <span class="col-md-4">
                        <div class="thumbnail">
                            <div style="border: 1px solid #474747;padding: 5px;">
                            <img class="img-responsive" style="max-height: 170px; min-height: 170px;" src="%s" alt="...">
                            </div>
                            <div class="caption">
                                <div style="min-height: 55px; margin-top: 10px;">
                                    <div style="font-size: 14px;">%s</div>
                                    <div style="font-size: 14px;">%s</div>
                                </div>
                                %s
                                <p>
                                    <input class="btn btn-default btn-lg" style="font-size: 15px; min-width: 125px; font-weight: 100;" role="button" type="submit" value="%s">
                                </p>
                            </div>
                        </div>
                     </span>
                ';
                if (sizeof($prizes) > 0) {
                    foreach ($prizes as $prize) {
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'user-redeem-form',
                            'enableAjaxValidation' => false,
                            'clientOptions' => array(
                                'validateOnSubmit' => false,
                                'validateOnChange' => false,
                                'validateOnType' => false,
                            )
                        ));
                        if ($prize->quantity > 0) {
                            echo sprintf(
                                    $prizeFormat, '/' . basename(Yii::app()->params['paths']['image']) . "/{$prize->image}", $prize->name, ($prize->credits_required == 1) ? (Yii::t('youtoo', '{value} Bonus Buck', array('{value}' => $prize->credits_required))) : (Yii::t('youtoo', '{value} Bonus Bucks', array('{value}' => $prize->credits_required))),$form->hiddenField($prize, 'id', array('value' => $prize->id)), Yii::t('youtoo','Buy')
                            );
                            $this->endWidget();
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
