<?php
$cs = Yii::app()->getClientScript();
$cs->scriptMap = array('jquery.min.js' => false);
$cs->coreScriptPosition = CClientScript::POS_END;
//$cs->registerCoreScript('jquery.yiiactiveform.js');
$cs->registerScriptFile(Yii::app()->request->baseurl . '/webassets/mobile/javascripts/vendor.js', CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/webassets/mobile/javascripts/app.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/webassets/mobile/javascripts/main.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/webassets/mobile/javascripts/client.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/webassets/js/client.js', CClientScript::POS_END);
//$cs->registerScript('googleanalytics', "var _gaq=_gaq||[];_gaq.push(['_setAccount', 'UA-25950024-1']);_gaq.push(['_setDomainName', 'youtoo.com']);_gaq.push(['_trackPageview']);(function() {var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);})();", CClientScript::POS_END);
?>
<!DOCTYPE html>
<html>
    <!--<![endif]-->
    <head>
        <!-- @todo figure out a way to automatically change this base href for deployments -->
        <!-- <base href="http://localhost:8888/univision/public/" /> -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo Yii::app()->name; ?></title>
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/webassets/mobile/stylesheets/app.css">
        <link rel="stylesheet" href="/webassets/mobile/stylesheets/client.css">
        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-25950024-9', 'auto');
            ga('send', 'pageview');

        </script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
        <?php
        Yii::app()->facebook->initJs($output);
        ?>
    </head>
    <body id="<?php echo Yii::app()->controller->id . '-' . Yii::app()->controller->action->id; ?>">
                        <?php
                        $flashMessages = Yii::app()->user->getFlashes();
                        ?>
        <div id="popupWrap2">
            <div style="display: table-cell;padding-top: 200px;">
                <div class="flashMobile2">
                    <div class="flashMobileContents2">
                    </div>
                </div>
            </div>
        </div>
        <div id="popupWrap" <?php echo ($flashMessages) ? "style='display:table'" : ''; ?>>
            <div style="display: table-cell;vertical-align: middle;">
                <div class="flashMobile">
                    <div class="flashMobileContents">
<?php foreach ($flashMessages as $key => $message): ?>
                            <div class="flash-<?php echo($key) ?>"><?php echo($message) ?></div>
<?php endforeach; ?>
                    </div>
                    <p id="fabmob_login-divider" style="border-bottom:grey solid 1px;"></p>
                    <div class="flashMobileButton">
                        <div class='okButton' onclick="$('#popupWrap').toggle();">Ok</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="popupConfirm">
            <div style="display: table-cell;vertical-align: middle;">
                <div class="flashMobile">
                    <h3 id="flashMobileHeader"></h3>
                    <div class="flashMobileContents">
                        <div id="popupMessage"></div>
                    </div>
                    <p id="fabmob_login-divider" style="border-bottom:grey solid 1px;"></p>
                    <div class="flashMobileButton">
                        <div class='left-fillbutton' id="contentOk" name="" onclick="flagContent(this);
                $('#popupConfirm').hide();">Ok</div>
                        <div class='center-fillline'></div>
                        <div class='right-fillbutton' onclick="$('#popupConfirm').hide();">Cancel</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="popupInitial">
            <div style="display: table-cell;vertical-align: middle;">
                <div class="flashMobile">
                    <div class="flashMobileButton">
                        <div style="float: right; padding: 10px;" onclick="$('#popupInitial').hide();"><img src="/webassets/mobile/images/Icon_popup-x.png" style="width: 50%;"/></div>
                    </div>
                    <!--                    <h3 id="flashMobileHeader"></h3>-->
                    <div class="flashMobileContents">
                        <div id="popupMessage">
                            <div class='col-sm-12' style="text-align: center; padding-right: 0px; padding-left: 0px;">
                                <p style='font-size: 15px; font-weight: 100; margin: 0px 0px 5px; padding: 10px;'><?php echo Yii::t('youtoo', 'Each Friday, Azteca will air a Futbol Match. You have to pick the winner. It\'s only $1.00 to select<br/>your answer. If you are right, then your will entered to win the weekly prize for this game.'); ?></p>
                                <p style='font-size: 15px; font-weight: 100; margin: 0px 0px 5px; padding: 10px;'>
<?php echo Yii::t('youtoo', 'Players for Game #1 will be able to choose from the two playing teams or a tie. Example:<br/>Choose Team A, Team B or Tie.') ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="spinerWrap" style="display: none;">
            <img src="/core/webassets/images/socialSearch/ajaxSpinner.gif" class="spinner">
        </div>
        <div class="snap-drawers">
            <div class="snap-drawer snap-drawer-left">
                <ul id="nav">
                    <?php if (Yii::app()->user->isGuest): ?>
                    <li style='background-color: #3a3a3a; text-align: center;'><a style='text-indent: 0px;' href='<?php echo Yii::app()->createUrl('/register'); ?>'><h3 style='color:#ffffff;'><?php echo Yii::t('youtoo', 'Join Now'); ?></h3></a></li>
                    <?php else: ?>
                    <li style='background-color: #3a3a3a; text-align: center;'><a style='text-indent: 0px; border-bottom: none; padding: 0px;' href='<?php echo Yii::app()->createUrl('/user/profile'); ?>'><h3 style="cursor: pointer; color: #ffffff; margin-bottom: 0px; margin-top: 10px;"><?php echo empty($this->user->first_name) ? '' : $this->user->first_name; ?> <?php echo empty($this->user->last_name) ? '' : $this->user->last_name; ?>&nbsp;</h3></a></li>
                    <div style="text-align: center; color: #ffffff; font-size: 12px; font-weight: 100;"><?php echo Yii::t('youtoo','Cash Balance');?> : <?php echo '<span style="color: #f9d83d;">$' . GameUtility::getCashBalance(isset($this->user->id) ? $this->user->id : Yii::app()->user->getId()) . '</span>'; ?></div><div style="text-align: center; color: #ffffff; font-size: 12px; font-weight: 100;"><?php echo Yii::t('youtoo', 'Credits'); ?> : <?php echo '<span style="color: #f9d83d;">' . ClientUtility::getTotalUserBalanceCredits() . '</span>'; ?></div>
                    <?php endif; ?>
                    <li class="sidebar"><a href="<?php echo Yii::app()->createUrl('/site/index'); ?>"><div class="homeimage"></div><span><?php echo Yii::t('youtoo', 'Main'); ?></span></a></li>
                    <li class="sidebar"><a href="<?php echo Yii::app()->createUrl('site/indexlinks'); ?>"><div class="pollimage"></div><span><?php echo Yii::t('youtoo', 'Play Now'); ?></span></a></li>
                    <li class="sidebar"><a href="<?php echo Yii::app()->createUrl('/redeem'); ?>"><div class="tickerimage"></div><span><?php echo Yii::t('youtoo', 'Store'); ?></span></a></li>
                    <li class="sidebar"><a href="<?php echo Yii::app()->createUrl('/winners'); ?>"><div class="uploadvideo"></div><span><?php echo Yii::t('youtoo', 'Winners'); ?></span></a></li>
                    <li class="sidebar"><a href="<?php echo Yii::app()->createUrl('/site/marketinglinks'); ?>"><div class="videosimage"></div><span><?php echo Yii::t('youtoo','How to play'); ?></span></a></li>
                    <li class="sidebar"><a href="<?php echo Yii::app()->createUrl('site/faq'); ?>"><div class="faqimage"></div><span style="cursor: pointer;"><?php echo Yii::t('youtoo', 'FAQ'); ?></span></a></li>
                    <li class="sidebar"><a href="<?php echo Yii::app()->createUrl('user/settingLinks'); ?>"><div class="settingimage"></div><span style="cursor: pointer;"><?php echo Yii::t('youtoo', 'Account'); ?></span></a></li>
                    <li class="sidebar white"><a href="<?php echo Yii::app()->createUrl('site/aboutlinks'); ?>"><div class="aboutimage"></div><span style="cursor: pointer;"class="graylink"><?php echo Yii::t('youtoo', 'About'); ?></span></a></li>
                    <li class="sidebar white"><a href="<?php echo Yii::app()->createUrl('site/helplinks'); ?>"><div class="helpimage"></div><span style="cursor: pointer;"class="graylink"><?php echo Yii::t('youtoo', 'Help'); ?></span></a></li>
                    <li class="sidebar white"><a href="<?php echo Yii::app()->createUrl('site/legallinks'); ?>"><div class="legalimage"></div><span style="cursor: pointer;"class="graylink"><?php echo Yii::t('youtoo', 'Legal'); ?></span></a></li>

                </ul>
                <?php if (Yii::app()->user->isGuest): ?>
                    <a id="snap-drawer-login-btn" class="btn fabmob_auth-flow-btn" style="font-size: 15px;" href="/login"><?php echo Yii::t('youtoo', 'Get Started'); ?></a>
                <?php else: ?>
                    <?php //$geoLocation = GeoUtility::GeoLocation(); if ($geoLocation['isValid']): ?>
                    <a id="snap-drawer-logout-btn" class="btn fabmob_auth-flow-btn" style="background-color: #f9d83d !important; border-color: #f9d83d !important; margin-bottom: 10px;" href="/payment"><?php echo Yii::t('youtoo','Add Funds'); ?></a>
                    <?php //endif; ?>
                    <a id="snap-drawer-logout-btn" class="btn fabmob_auth-flow-btn" style="background-color: transparent !important; border-color: transparent !important; color: #ffffff !important; margin-top: 10px;" href="/logout"><?php echo Yii::t('youtoo','Log Out'); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <div id="content-container" class="snap-content">
            <div id="toolbar" style="position:relative; background-color: #474747;">
                <?php if (in_array(Yii::app()->controller->action->id, array('winlooseordraw', 'index2'))): ?>
                    <span style="color: #f9d83d; font-size: 17px; margin-left: 20px;font-weight: 100;"><?php echo Yii::t('youtoo','Liga MX') ?></span>
                <?php elseif($this->action->id == "multiple4"): ?>
                    <span style="color: #f9d83d; font-size: 17px; margin-left: 20px;font-weight: 100;"><?php echo Yii::t('youtoo', 'LA ISLA EL REALITY'); ?></span>
                <?php elseif($this->action->id == "indexlinks"): ?>
                    <span style="color: #ffffff; font-size: 22px; margin-left: 20px;font-weight: 100;"><?php echo Yii::t('youtoo', 'Elige un Juego'); ?></span>
                <?php else: ?>
                    <img src="/webassets/mobile/images/Logo_Azteca.png"/>
                <?php endif; ?>
                    <?php if ($this->id == "site" || $this->id == 'payment'): ?>
                    <?php if ($this->action->id == "aboutlinks"): ?>
                        <a id="open-left" >&nbsp;</a>
                        <!--<h3 class="graylink vertical-middle">Ayuda</h3>-->
                    <?php elseif ($this->action->id == "legallinks"): ?>
                        <a id="open-left" >&nbsp;</a>
                        <!--<h3 class="graylink vertical-middle">Términos y Condiciones</h3>-->
                    <?php elseif ($this->action->id == "helplinks"): ?>
                        <a id="open-left" >&nbsp;</a>
                    <?php elseif ($this->action->id == "index2"): ?>
                        <a id="open-left" >&nbsp;</a>
                    <?php elseif ($this->action->id == "marketinglinks"): ?>
                        <a id="open-left" >&nbsp;</a>
                        <!--<h3 class="graylink vertical-middle">Ayuda</h3>-->
                    <?php elseif ($this->action->id == "about"): ?>
                        <a id="back-left" onclick='history.go(-1);'></a>
                        <h3 class="graylink vertical-middle">Acerca de Youtoo</h3>
                    <?php elseif ($this->action->id == "contact"): ?>
                        <a id="back-left" onclick='history.go(-1);'></a>
                        <!--<h3 class="graylink vertical-middle">Contáctanos</h3>-->
                    <?php elseif ($this->action->id == "redeemPrize"): ?>
                        <a id="back-left" onclick='history.go(-1);'></a>
                        <!--<h3 class="graylink vertical-middle">Contáctanos</h3>-->
                    <?php elseif ($this->action->id == "FAQ"): ?>
                        <a id="back-left" onclick='history.go(-1);'></a>
                        <h3 class="graylink vertical-middle"><?php echo Yii::t('youtoo', 'FAQ'); ?></h3>
                    <?php elseif ($this->action->id == "freeplay"): ?>
                        <a id="back-left" onclick='history.go(-1);'></a>
                        <h3 class="graylink vertical-middle"><?php echo Yii::t('youtoo', 'Free Method of Play'); ?></h3>
                    <?php elseif ($this->action->id == "rules"): ?>
                        <a id="back-left" onclick='history.go(-1);'></a>
                        <!--<h3 class="graylink vertical-middle"><?php //echo Yii::t('youtoo', 'Rules'); ?></h3>-->
                    <?php elseif ($this->action->id == "help"): ?>
                        <a id="open-left" >&nbsp;</a>
                        <h3 class="graylink vertical-middle">¿Necesitas ayuda?</h3>
                    <?php elseif ($this->action->id == "more"): ?>
                        <a id="back-left" onclick='history.go(-1);'></a>
                        <h3 class="graylink vertical-middle">Más Información</h3>
                    <?php elseif ($this->action->id == "privacy"): ?>
                        <a id="back-left" onclick='history.go(-1);'></a>
                        <span style="cursor: pointer;"onclick="window.location = '<?php echo Yii::app()->createUrl('site/index'); ?>'">&nbsp;</span>
                    <?php elseif ($this->action->id == "patents"): ?>
                        <a id="back-left" onclick='history.go(-1);'></a>
                        <span style="cursor: pointer;"onclick="window.location = '<?php echo Yii::app()->createUrl('site/index'); ?>'">&nbsp;</span>
                        <?php //elseif ($this->action->id == "schedule"):  ?>
                        <!--<a id="back-left" onclick='history.go(-1);'></a>
                            <h3 class="graylink vertical-middle">Schedule</h3>-->
                        <?php //elseif ($this->action->id == "show"):  ?>
                        <!--<a id="back-left" onclick='history.go(-1);'></a>
                            <h3 class="graylink vertical-middle">Shows</h3>-->
                    <?php elseif ($this->action->id == "terms"): ?>
                        <a id="back-left" onclick='history.go(-1);'></a>
                        <span style="cursor: pointer;"onclick="window.location = '<?php echo Yii::app()->createUrl('site/index'); ?>'">&nbsp;</span>
                    <?php else: ?>
                        <a id="open-left" >&nbsp;</a>
                        <span style="cursor: pointer;"onclick="window.location = '<?php echo Yii::app()->createUrl('site/index'); ?>'">&nbsp;</span>
                    <?php endif; ?>
                <?php elseif ($this->id == "user"): ?>
                    <?php if ($this->action->id == "settingLinks"): ?>
                        <a id="open-left">&nbsp;</a>
                        <!--<h3 class="graylink vertical-middle"><?php //echo Yii::t('youtoo','Configuración de perfil');  ?></h3>-->
                    <?php elseif ($this->action->id == "profile"): ?>
                        <a id="back-left" href='<?php echo Yii::app()->createUrl('user/settingLinks') ?>'></a>
                        <h3 class="graylink vertical-middle">Información Básica</h3>
                    <?php elseif ($this->action->id == "connections"): ?>
                        <a id="back-left" href='<?php echo Yii::app()->createUrl('user/settingLinks') ?>'></a>
                        <h3 class="graylink vertical-middle">Conéctarte</h3>
                    <?php elseif ($this->action->id == "password"): ?>
                        <a id="back-left" href='<?php echo Yii::app()->createUrl('user/settingLinks') ?>'></a>
                        <h3 class="graylink vertical-middle">Contraseña</h3>
                    <?php //elseif ($this->action->id == "index2"): ?>
<!--                        <a id="back-left" onclick='history.back();'></a>-->
                        <!--<a id="back-left" href='<?php //echo Yii::app()->createUrl('site/indexlinks') ?>'></a>-->
                        <!--<h3 class="graylink vertical-middle">Forma de Pago</h3>-->
                    <?php elseif ($this->action->id == "thankyou"): ?>
                        <a id="back-left" href='<?php echo Yii::app()->createUrl('user/settingLinks') ?>'></a>
                        <!--<h3 class="graylink vertical-middle">Forma de Pago</h3>-->
                    <?php elseif ($this->action->id == "credits"): ?>
                        <a id="back-left" href='<?php echo Yii::app()->createUrl('user/settingLinks') ?>'></a>
                        <h3 class="graylink vertical-middle"><?php echo Yii::t('youtoo', 'Credits'); ?></h3>
                    <?php else: ?>
                        <a id="open-left" >&nbsp;</a>
                        <span style="cursor: pointer;"onclick="window.location = '<?php echo Yii::app()->createUrl('site/index'); ?>'">&nbsp;</span>
                    <?php endif; ?>
                <?php elseif ($this->id == "video"): ?>
                    <?php if ($this->action->id == "play"): ?>
                        <a id="back-left" onclick='history.go(-1);'></a>
                        <span style="cursor: pointer;"onclick="window.location = '<?php echo Yii::app()->createUrl('site/index'); ?>'">&nbsp;</span>
                    <?php else: ?>
                        <a id="open-left" >&nbsp;</a>
                        <span style="cursor: pointer;"onclick="window.location = '<?php echo Yii::app()->createUrl('site/index'); ?>'">&nbsp;</span>
                    <?php endif; ?>
                <?php elseif ($this->id == "image"): ?>
                <?php if ($this->action->id == "view"): ?>
                        <a id="back-left" onclick='history.go(-1);'></a>
                        <span style="cursor: pointer;"onclick="window.location = '<?php echo Yii::app()->createUrl('site/index'); ?>'">&nbsp;</span>
                <?php else: ?>
                        <a id="open-left" >&nbsp;</a>
                        <span style="cursor: pointer;"onclick="window.location = '<?php echo Yii::app()->createUrl('site/index'); ?>'">&nbsp;</span>
                <?php endif; ?>
                <?php else: ?>
                    <a id="open-left" >&nbsp;</a>
                    <span style="cursor: pointer;"onclick="window.location = '<?php echo Yii::app()->createUrl('site/index'); ?>'">&nbsp;</span>
                <?php endif; ?>
            </div>
            <div id="fabmob_view-container" <?php if (Yii::app()->controller->action->id == 'multiple4' || Yii::app()->controller->action->id == 'thankyou'): ?>style="background-image: url('/webassets/mobile/images/Image_Mobile-background.png')"<?php elseif(Yii::app()->controller->action->id == 'winlooseordraw' || Yii::app()->controller->action->id == 'paidthankyou' ): ?>style="background-image: url('/webassets/mobile/images/image_mobile_la-liga-background.png')"<?php elseif (Yii::app()->controller->action->id == 'indexlinks'): ?>style="background-color: #292929;"<?php elseif (Yii::app()->controller->action->id == 'marketingpage'): ?>style="background-color: #0b1112;"<?php elseif(Yii::app()->controller->action->id == 'marketingpage2'): ?>style="background-color: #1f1919;"<?php else: ?><?php endif; ?>>
                <?php echo $content; ?>
            </div>
        </div>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<?php $this->renderPartial('/csrf/_csrfToken'); ?>
    </body>
</html>
