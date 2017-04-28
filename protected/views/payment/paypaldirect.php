<div class="modal fade" id="modalPaypalDirect" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color:#474747;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style='color:#ffffff'><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style='color:#ffffff' id="myModalLabel"><?php echo Yii::t('youtoo', 'PayPal') ?></h4>
            </div>
            <div class="modal-body" style='color:#000000'>
                <div style="max-width: 520px; padding: 12px 18px; border: 1px solid grey;border-radius: 6px; margin: 15px auto">
                    <form id="paypal-form" method="post" action="">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group input-group-md" style="text-align: left;width: 100%;padding: 4px 0px;">
                                    <span class="input-group-addon" style="width:30%;padding: 4px 16px;height: 34px;">Card Number</span>
                                    <input class="form-control" name="card_number" id="card_number" type="text" size="18" maxlength="16" placeholder="Card Number" style="height: 34px; padding: 0px 16px;"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-group input-group-md" style="text-align: left;width: 100%;padding: 4px 0px;">
                                    <span class="input-group-addon" style="width:30%;padding: 4px 6px;height: 34px;"></span>
                                    <input class="form-control" name="expire_month" id="expire_month" type="text" size="3" maxlength="2" placeholder="MM" style="width:100%;height: 34px; padding: 0px 16px;"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group input-group-md" style="text-align: left;width: 100%;padding: 4px 0px;">
                                    <span class="input-group-addon" style="width:30%;padding: 4px 6px;height: 34px;"></span>
                                    <input class="form-control" name="expire_year" id="expire_year" type="text" size="5" maxlength="4" placeholder="YYYY" style="width:100%;height: 34px;  padding: 0px 16px;"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group input-group-md" style="text-align: left;width: 100%;padding: 4px 0px;">
                                    <span class="input-group-addon" style="width:30%;padding: 4px 6px;height: 34px;"></span>
                                    <input class="form-control" name="cvv2" id="cvv2" type="text" size="4" maxlength="3" placeholder="CVV2" style="height: 34px; padding: 0px 16px;"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group input-group-md" style="text-align: left;width: 100%;padding: 4px 0px;">
                                    <span class="input-group-addon" style="width:30%;padding: 4px 6px;height: 34px;"></span>
                                    <input class="form-control" name="first_name" id="first_name" type="text" size="4" placeholder="First Name" value="<?php echo isset(Yii::app()->session['firstname']) ? Yii::app()->session['firstname'] : ''?>"  style="height: 34px; padding: 0px 16px;"/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group input-group-md" style="text-align: left;width: 100%;padding: 4px 0px;">
                                    <span class="input-group-addon" style="width:30%;padding: 4px 6px;height: 34px;"></span>
                                    <input class="form-control" name="last_name" id="last_name" type="text" size="4" placeholder="Last Name" value="<?php echo isset(Yii::app()->session['lastname']) ? Yii::app()->session['lastname'] : ''?>" style="height: 34px; padding: 0px 16px;"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group input-group-md" style="text-align: left;width: 100%;padding: 4px 0px;">
                                    <span class="input-group-addon" style="width:10%;padding: 4px 6px;height: 34px;"></span>
                                    <input class="form-control" name="street_1" id="street_1" type="text" size="4" placeholder="Street" value="<?php echo isset(Yii::app()->session['street_1']) ? Yii::app()->session['street_1'] : ''; ?>" style="height: 34px; padding: 0px 16px;"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-group input-group-md" style="text-align: left;width: 100%;padding: 4px 0px;">
                                    <span class="input-group-addon" style="width:30%;padding: 4px 6px;height: 34px;"></span>
                                    <input class="form-control" name="city" id="city" type="text" size="4" placeholder="City" value="<?php echo isset(Yii::app()->session['city']) ? Yii::app()->session['city'] : ''; ?>" style="height: 34px; padding: 0px 16px;"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group input-group-md" style="text-align: left;width: 100%;padding: 4px 0px;">
                                    <span class="input-group-addon" style="width:30%;padding: 4px 6px;height: 34px;"></span>
                                    <input class="form-control" name="state" id="state" type="text" size="4" placeholder="State" value="<?php echo isset(Yii::app()->session['state']) ? Yii::app()->session['state'] : ''; ?>" style="height: 34px; padding: 0px 16px;"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group input-group-md" style="text-align: left;width: 100%;padding: 4px 0px;">
                                    <span class="input-group-addon" style="width:30%;padding: 4px 6px;height: 34px;"></span>
                                    <input class="form-control" name="postal_code" id="postal_code" type="text" size="4" maxlength="5" placeholder="Zip" value="<?php echo isset(Yii::app()->session['postalcode']) ? Yii::app()->session['postalcode'] : ''; ?>" style="height: 34px;"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" style="text-align: center;">
                                <input id="screen_width" type="hidden" name="screen_width" value="" />
                                <input id="screen_height" type="hidden" name="screen_height" value="" />
                                <br/>
                                <button class="btn btn-default btn-md" id="paypal_submit" type="button" onclick="payPalDirect();" style="background-color: #f9d83d !important;  border-color: #f9d83d;text-align: center;">PayPal Direct-Pay</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>