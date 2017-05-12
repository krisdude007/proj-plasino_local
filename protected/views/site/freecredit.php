<div id="pageContainer" class="container" style="padding-left: 0px;">
    <div class="subContainer" style="padding: 0px; max-width: 550px;">
        <?php $this->renderPartial('_sideBar', array()); ?>
        <h3>Enter code for free credit.</h3>
        <?php
            $form = $this->beginWidget('CActiveForm', array(
            'id' => 'freecredit-form',
            'enableAjaxValidation' => false,
            'clientOptions' => array(
                'validateOnSubmit' => false,
                'validateOnChange' => false,
                'validateOnType' => false,
            )
        ));
                                ?>
        <div class="row">
            <div class='form group col-sm-12'>
                <?php echo CHtml::textField('freecreditcode', '', array('placeholder' => Yii::t('youtoo', 'Enter Free Credit Code here'), 'class' => 'form-control')); ?>
            </div>
            <br/>
            <div class='form group col-sm-12'>
                <?php echo CHtml::textField('emailUsed', '', array('placeholder' => Yii::t('youtoo', 'Enter the email associated with the account'), 'class' => 'form-control')); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
        <br/>
        <hr/>
        <div class='row'>
            <div class="form group col-sm-12">
                <?php echo CHtml::submitButton(Yii::t('youtoo', 'Submit'), array('class' => 'btn btn-default', 'role' => 'button', 'style' => 'width: 40%', 'onclick' => 'oneFreeCredit();')); ?>
            </div>
        </div>
    </div>
</div>
<script>

    function oneFreeCredit() {
        var freeCreditCode = $('#freecreditcode').val();
        var emailUsed =  $('#emailUsed').val();//console.log(emailUsed)
        
        if (freeCreditCode === '' || freeCreditCode.toString().length !== 6) {
            alert('The code you entered either is blank or invalid, please try again');
        } else if (emailUsed == '') {
            alert('Email cannot be blank');
        } else {
            $.ajax({
                type: 'post',
                url: '/site/ajaxFreeCredit',
                data: ({
                        'freecreditcode': freeCreditCode,
                        'emailused': emailUsed,
                    }),
                dataType: 'json',
                success: function (data) {
                    if (data.added) {
                        window.location = "/";
                        alert('One Free Game Credit added to your account');
                    }
                    if (data.error) {
                        //window.location = "/";
                        alert(data.error);
                    }
                }
            });
        }
    }

</script>
