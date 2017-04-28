<table class="table table-bordered" style="background-color: #eeeeee; border: 1px solid #eeeeee;">
    <col width="30%">
    <thead style='border: 1px solid #474747;'>
        <tr style="background-color: #474747;">
            <th style="border: 1px solid #474747; text-align: center; width: 60%;color: #f9d83d; font-weight: 200;"><?php echo Yii::t('youtoo', 'First Name') ?></th>
            <th style="border: 1px solid #474747; text-align: center; width: 40%; color: #f9d83d; font-weight: 200;"><?php echo Yii::t('youtoo', 'Prize') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0; ?>
        <?php foreach ($winners as $winner): ?>
            <?php
            if ($winner->winner_username && $winner->id == 4) {
                $i = $i + 1;
                ?>
                <tr>
                    <td class="alignLeft" style="border: 1px solid #cfcfcf;"><?php echo $winner->winner_firstname . ' ' . $winner->winner_lastname; ?></td>
                    <td style="border: 1px solid #eeeeee; background-color: #cfcfcf; text-align: center;"><?php echo $winner->prize; ?></td>
                </tr>
            <?php } ?>
        <?php endforeach; ?>
        <?php if ($i == 0): ?>
            <tr><td colspan="5" style="text-align: center; border: 1px solid #eeeeee;"><?php echo Yii::t('youtoo', 'PLEASE COME BACK TO SEE THE LALIGA.COM SWEEPSTAKES WINNERS LIST NEXT WEEK. THANKS'); ?></td></tr>
            <?php endif; ?>
    </tbody>
</table>
