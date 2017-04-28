<!-- ModalRules -->
<div class="modal fade" id="modalRedeem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a onclick="javascript:location.href='/redeem'"><button type="button" class="close" style="opacity: .8;" data-dismiss="modal"><span style="color: #f00;" aria-hidden="true">&times;</span><span class="sr-only"><?php Yii::t('youtoo','Return to Store')?></span></button></a>
                <h2 class="modal-title" style="text-align: center;color: #f00;" id="myModalLabel"><?php echo Yii::t('youtoo','Sorry!') ?></h2>
            </div>
            <div class="modal-body">
                <h3 style="text-align: center; color: #171717;"><?php echo Yii::t('youtoo','Not enough credits'); ?></h3>
            </div>

        </div>
    </div>
</div>