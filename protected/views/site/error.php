<div id="pageContainer" class="container">
    <div class="subContainer">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <h1 class="error">
                    <?php
                        if($code == "503"){
                            echo CHtml::encode(Yii::t('youtoo','Sorry, temporary closed for maintenance.'));
                        }else if($code == "500"){
                            echo CHtml::encode(Yii::t('youtoo','Server Error found.'));
                        }else if($code == "404"){
                            echo CHtml::encode(Yii::t('youtoo','Sorry, requested page can not be found.'));
                        }
                        else if($code == "403"){
                            echo CHtml::encode(Yii::t('youtoo','Sorry, your request don’t have permission.'));
                        }
                        else if($code == "401"){
                            echo CHtml::encode(Yii::t('youtoo','Sorry, you are not authorized to perform this request.'));
                        }
                        else{
                            echo CHtml::encode(Yii::t('youtoo','Unknowin Error. ').$code);
                        }
                    ?>
                </h1>
                <p class="lead error">
                    <?php
                        echo CHtml::encode(Yii::t('youtoo',$message." on line ".$line));
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>
