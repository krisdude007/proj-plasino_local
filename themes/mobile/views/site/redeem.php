<style>
    .link div button {
        width: 85%;
        background:none!important;
        border:none;
        padding:0!important;
    }
    .link div button:after {
        background-image: url('/webassets/mobile/images/Button_Arrow.png');
        background-repeat: no-repeat;
        background-size: 10px 20px;
        content:"";
        width: 20px;
        height: 20px;
        float: right;
        position: relative;
        top: 0px;
    }

.link div a:after {
    top: 9px;
}
</style>
<?php
$prizeFormat = '<div class="link">
                    <div>%s<img style="width: 40px; border: 1px solid #474747;" src="%s"/><button id="redeemSubmit" type="submit" style="text-align: left;"><a><span style="margin-left: 30px; font-size: 15px;">%s</span></a></button></div>
                    <hr style="margin: 0px;"></hr>
                </div>
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
                    $prizeFormat, $form->hiddenField($prize, 'id', array('value' => $prize->id)), '/' . basename(Yii::app()->params['paths']['image']) . "/{$prize->image}", $prize->description
            );
        }$this->endWidget();
    }
}
?>
<script>

    $('#redeemSubmit').on('click', function() {
        //$(this).closest('form').submit()
        $('#user-redeem-form').submit();
    });
</script>