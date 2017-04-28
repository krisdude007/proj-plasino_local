<?php
// page specific css
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery-ui-1.10.0.css');
Yii::app()->clientScript->registerScriptFile('http://cdn.jquerytools.org/1.2.7/all/jquery.tools.min.js', CClientScript::POS_END);
?>

<div id="pageContainer" class="container">
    <div class='subContainer' style="padding: 0px;">
        <?php $this->renderPartial('_sidebar', array()); ?>
        <?php $this->renderPartial('_top', array()); ?>
        <div class="row">
            <div class="col-sm-10 col-xs-12 floatRight">
                <p>&nbsp</p>
                <?php if (!is_null($credits)): ?>
                    <div class="table-responsive" style="max-height: 600px; overflow: scroll;">
                        <table class="table">
                            <tr style='background-color: #ffffff;'>
                                <th style="text-align: left; padding: 15px;"><?php echo Yii::t('youtoo', 'Date') ?></th>
                                <th style="text-align: left; padding: 15px;"><?php echo Yii::t('youtoo', 'Entries/Bonuses') ?></th>
                                <th class='newItem' style="text-align: left; padding: 15px; background-color: #ffffff;"><?php echo Yii::t('youtoo', 'Description') ?></th>
                            </tr>
                            <?php foreach ($credits as $credit): ?>
                                <tr>
                                    <td style="text-align: left; padding: 15px;"><?php echo date('l dS F Y h:i:s A T', strtotime($credit->created_on)); ?></td>
                                    <td style="text-align: left; padding: 15px;">
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
                                    <td class='newItem' style="text-align: left;  padding: 15px;"><?php
                                        if ($credit->type == 'earned') {
                                            echo Yii::t('youtoo','Game Entries');
                                        } else {
                                            echo empty($credit->prize->name) ? '<span style="color: red;">'. Yii::t('youtoo','Game Debits') .'</span>' : '<span style="color: red;">' . $credit->prize->name . '</span>';
                                        }
                                        ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php else: ?>
                    <?php echo Yii::t('youtoo', 'No credit history') ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>










