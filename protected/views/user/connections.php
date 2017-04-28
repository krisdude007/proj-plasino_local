<?php
/* @var $this UserController */
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseurl . '/webassets/js/jquery.oauthpopup.js', CClientScript::POS_END);
?>
<div id="pageContainer" class="container">
    <div class='subContainer' style="padding: 0px;">
        <?php $this->renderPartial('_sidebar', array()); ?>
        <div class="col-sm-10 col-xs-12 floatRight">
            <h3 style="font-weight: 300; margin-bottom: 40px;"><?php echo Yii::t('youtoo', 'Connections'); ?></h3>
            <div class="form">
                <div class="form-group col-sm-12" style="overflow:hidden;">
                    <div class="textBox">
                        <div class="bold" style="background-color: #eeeeee; min-height: 60px; padding: 20px;">
                            <?php echo Yii::t('youtoo','Connect Social Accounts'); ?>
                        </div>
                        <div style="margin: 20px 20px 30px;"><?php echo Yii::t('youtoo','To disconnect, simply click on the desired icon and follow the prompt'); ?></div>
                        <div class="col-sm-4">
                            <div class="facebook" style="margin:0px 5px;">
                                <a href="#" id="fb_conn" rel="<?php echo (!empty($user->userFacebooks[0]->id)) ? '1' : '0'; ?>">
                                    <?php if (!empty($user->userFacebooks[0]->id)): ?>
                                        <img src='/webassets/images/buttons/Button_Facebook_Connect_Social_Active.png'/>
                                    <?php else: ?>
                                        <img src="/webassets/images/buttons/Button_Facebook_Connect_Social_Nuetral.png" />
                                    <?php endif; ?>
                                </a>
                                <span id="facebook_user">
                                    <?php if (!empty($user->userFacebooks[0]->id)): ?>
                                        <a  href="<?php echo $facebook['link']; ?>" target="_blank"><?php echo $facebook['name']; ?></a>
                                    <?php else: ?>
                                        <?php echo Yii::t('youtoo','Not Connected.'); ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="twitter">
                                <a href="#" id="tw_conn" rel="<?php echo (!empty($user->userTwitters[0]->id)) ? '1' : '0'; ?>">
                                    <?php if (!empty($user->userTwitters[0]->id)): ?>
                                        <img src="/webassets/images/buttons/Button_Twitter_Connect_Social_Active.png" />
                                    <?php else: ?>
                                        <img src="/webassets/images/buttons/Button_Twitter_Connect_Social_Nuetral.png" />
                                    <?php endif; ?>
                                </a>
                                <span id="twitter_user">
                                    <?php if (!empty($user->userTwitters[0]->id)): ?>
                                        <a  href="http://www.twitter.com/<?php echo $twuser->screen_name; ?>" target="_blank"><?php echo $twuser->screen_name; ?></a>
                                    <?php else: ?>
                                        <?php echo Yii::t('youtoo','Not Connected.'); ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
