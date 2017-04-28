


<!-- ModalMessage -->
<div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="text-align: center;" id="myModalLabel">
                    <?php if (Yii::app()->user->hasFlash('error')): ?>
                    <i style="color: #fc0101"><?php echo Yii::t('youtoo','Error'); ?></i>
                    <?php endif; ?>
                    <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <i style="color: #00be66"><?php echo Yii::t('youtoo','Success'); ?></i>
                    <?php endif; ?>
                </h4>
            </div>
            <div class="modal-body" style="font-size: 1.2em; text-align: center;color:#333">
            <?php
            $flashMessages = Yii::app()->user->getFlashes();
            if ($flashMessages) {
                foreach ($flashMessages as $key => $message) {
                    echo sprintf($message);
                }
            }
            ?>
            </div>

        </div>
    </div>
</div>