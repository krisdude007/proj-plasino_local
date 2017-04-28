<?php if (!is_null($credits)): ?>
<div class="col-sm-10 col-xs-12 col-sm-offset-2" style="overflow: hidden;">
        <div class="col-xs-4"><br/><h6 style='font-weight: 300'><?php echo Yii::t('youtoo','Credits Spent')?>: <b style='font-size: 18px;font-weight: 100; color: #f17100;'> <?php echo '&nbsp;'. $this->userBalance['credits_spent']; ?></b></h6></div>
        <div class="col-xs-4"><br/><h6 style='font-weight: 300'><?php echo Yii::t('youtoo','Credits Earned')?>: <b style='font-size: 18px;font-weight: 100; color: #f17100;'> <?php echo '&nbsp;'. $this->userBalance['credits_earned']; ?></b></h6></div>
        <div class="col-xs-4"><br/><h6 style='font-weight: 300'><?php echo Yii::t('youtoo','Total Credits')?>: <b style='font-size: 18px;font-weight: 100; color: #f17100;'> <?php echo '&nbsp;'. $this->userBalance['credits_total']; ?></b></h6></div>
    </div>
<br/>
    <table class="table table-bordered" style="background-color: #eeeeee; border: 1px solid #eeeeee;">
        <col width="30%">
        <thead style='border: 1px solid #474747;'>
            <tr style="background-color: #474747;">
                <th style="border: 1px solid #474747; text-align: center; width: 60%;color: #f9d83d; font-weight: 200;"><?php echo Yii::t('youtoo', 'Credits/Purchases') ?></th>
                <th style="border: 1px solid #474747; text-align: center; width: 40%; color: #f9d83d; font-weight: 200;"><?php echo Yii::t('youtoo', 'Description') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($credits as $credit): ?>
                <tr>
                    <td class="alignLeft" style="border: 1px solid #cfcfcf;">
                        <?php
                        if ($credit->type == 'spent') {
                            echo '<span style="color: red;">' . $credit->credits . ' ' . Yii::t('youtoo', $credit->type) . '</span>';
                        } else {
                            if ($credit->type == 'purchased') {
                                echo '<span style="color: #df9721;">1 ' . Yii::t('youtoo', $credit->type) . '</span>';
                            } else {
                                echo $credit->credits . ' ' . Yii::t('youtoo', $credit->type);
                            }
                        }
                        ?>
                    </td>
                    <td style="border: 1px solid #eeeeee; background-color: #cfcfcf; text-align: center;"><?php
                        if ($credit->type == 'earned') {
                            echo Yii::t('youtoo', 'Game Credits');
                        } else {
                            echo empty($credit->prize->name) ? '<span style="color: red;">' . Yii::t('youtoo', 'Game Debits') . '</span>' : '<span style="color: red;">' . $credit->prize->name . '</span>';
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <?php echo '<h3>'.Yii::t('youtoo', 'No credit history') .'</h3>'; ?>
<?php endif; ?>