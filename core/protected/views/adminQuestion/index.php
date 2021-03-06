<?php
$cs = Yii::app()->clientScript;
$cs->registerScript('maxLengthQ', "var maxLengthQ = $maxLengthQ", CClientScript::POS_END);
$cs->registerScript('maxActives', "var maxActives = $maxActives", CClientScript::POS_END);
$cs->registerScriptFile('/core/webassets/js/adminQuestion/index.js', CClientScript::POS_END);
$cs->registerCssFile('/core/webassets/css/adminQuestion/index.css');
$cs->registerScriptFile('/core/webassets/js/jquery.dataTables.min.js', CClientScript::POS_END);

$cs->registerScriptFile('/core/webassets/js/adminTvScreenAppearSetting/tvScreenSettingModal.js', CClientScript::POS_END);
$cs->registerCssFile('/core/webassets/css/jquery.dataTables_themeroller.css');
$this->renderPartial('/admin/_csrfToken');

?>

<div class="fab-page-content">
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <div id="fab-top">
        <h2 class="fab-title">
            <img class="floatLeft" style="margin-right: 10px;" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/dashboard-icon.png"/>
            <div class="floatLeft"><?php echo ucfirst($q_type); ?> Question Editor </div>
            <?php
            if (Yii::app()->params['ticker']['breakingTweets'] && $q_type == 'ticker'):
                $this->renderPartial('/admin/_breakingTweetsShortNav');
           endif;
            ?>

        </h2>

    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- BEGIN PAGE CONTAINER-->
    <div class="fab-container-fluid">
        <!-- BEGIN PAGE HEADER-->

        <!-- END PAGE HEADER-->
        <div id="fab-dashboard">
            <div style="padding:0px 20px 0px 20px;">
                <div>
                    <h2>Create New Question:</h2>
                    <?php
                    /* @var $this AdminController */
                    /* @var $model Question */
                    /* @var $form CActiveForm */
                    ?>
                    <a href='/admin/socialstream/?hashtag=%s'>Stream</a><br/>

                    <div class="form">
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'admin-questionEditor-form',
                            'enableAjaxValidation' => true,
                        ));
                        ?>
                        <?php echo $form->errorSummary($model); ?>
                        <div class="clearfix">
                            <?php echo $form->labelEx($model, 'question'); ?>
                            <?php echo $form->textField($model, 'question', array('maxlength' => $maxLengthQ, 'class' => 'counter')); ?>
                            <?php echo $form->error($model, 'question'); ?>
                        </div>
                        <div class="clearfix">
                            <?php echo $form->labelEx($model, 'hashtag'); ?>
                            <?php echo $form->textField($model, 'hashtag', array('maxlength' => '30', 'class' => 'counter linkToeQuestion_question')); ?>
                            <?php echo $form->error($model, 'hashtag'); ?>
                        </div>
                        <div class="clearfix">
                            <?php echo $form->hiddenField($model, 'end_time', array('value' => date('Y-m-d', Yii::app()->params['ticker']['defaultEndTime']))); ?>
                            <?php echo $form->hiddenField($model, 'start_time', array('value' => date('Y-m-d', time()))); ?>
                            <?php echo $form->hiddenField($model, 'is_ticker', array('value' => $is_ticker)); ?>
                            <?php echo CHtml::submitButton('Submit'); ?>
                        </div>

                        <?php $this->endWidget(); ?>

                    </div><!-- form -->

                </div>
                <div style="margin-top:40px;">
                    <h2>Edit Question:</h2>
                    <div style="margin-bottom:20px">
                        Click on the column title to sort by that column.<br>
                        Click on any question details to edit them.
                    </div>
                    <table id="questionTable">
                        <thead>
                            <tr>
                                <th>State</th>
                                <th>Update</th>
                                <th>Delete</th>
                                <th>Question</th>
                                <th>Hashtag</th>
                                <th>Social</th>
                                <th>Post</th>
                                <?php if ($is_ticker): ?>
                                    <th>Ticker Feed</th>
                                <?php endif; ?>
                                <th>Responses TV</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (Yii::app()->params['cloudGraphicAppearanceSetting']['enableTickerCloudGraphicSetting'] === true) {
                                if ($is_ticker) {
                                    $rowFormat = "
                                <tr>
                                    <td style='text-align:center;width:50px' class='%s'>
                                        <button type='button' class='setQuestionState' rel='%s' rev='%s'>%s</button>
                                    </td>
                                    <td>%s</td>
                                    <td style='text-align:center;width:50px' class='%s'>
                                        <button type='button' class='setQuestionDeleted' rel='%s' rev='%s'>%s</button>
                                    </td>
                                    <td><a href='#' class='edit' rel='question' rev='%s'>%s</a></td>
                                    <td><a href='#' class='edit' rel='hashtag' rev='%s'>%s</a></td>
                                    <td>
                                        <!--<a href='/admin/socialstream/?hashtag=%s'>Stream</a><br/>-->
                                        <a href='/admin/socialsearch/?hashtag=%s&q=%s'>Search</a>
                                    </td>
                                    <td>
                                        <!--<a rev='%s' href='#' id='clientShareFacebookTrigger'><img alt='%s' style='max-width:initial' class='videoIcon videoIconFacebook' src='/core/webassets/images/facebook-transparent.png' /></a>-->
                                        <a rev='%s' href='#' id='clientShareTwitterTrigger'><img alt='%s' style='max-width:initial' class='videoIcon videoIconTwitter' src='/core/webassets/images/twitter-transparent.png' /></a>
                                    </td>
                                    <td>
                                        <a href='%s' target='_blank' rel='xml' rev='%s'>%s</a> -
                                        <a href='%s' target='_blank' rel='preview' rev='%s'>%s</a> -
                                        <a href='%s' rel='#tvScreenOverlay'  class='tvScreenSettingOverlayLink' rev='%s'>%s</a>
                                        <a href='#'  class='linkPopUp' rel='%s'>Links</a>
                                  ";
                                    if(Yii::app()->params['send_ticker']) {
                                         $rowFormat .= "<a href='#' class='fab-btn send_button' >Send</a>";
                                    }
                                    $rowFormat .= "
                                    </td>
                                    <td style='border:0px;padding:0px !important'>
                                        <table style='width:100%%'>
                                        <tr style='background:#FFF'>
                                            <th style='width:50%%'>Tickers</th>
                                        </tr>
                                        %s
                                        </table>
                                    </td>
                                </tr>";
                                } else {
                                    $rowFormat = "
                                <tr>
                                    <td style='text-align:center;width:50px' class='%s'>
                                        <button type='button' class='setQuestionState' rel='%s' rev='%s'>%s</button>
                                    </td>
                                    <td>%s</td>
                                    <td style='text-align:center;width:50px' class='%s'>
                                        <button type='button' class='setQuestionDeleted' rel='%s' rev='%s'>%s</button>
                                    </td>
                                    <td><a href='#' class='edit' rel='question' rev='%s'>%s</a></td>
                                    <td><a href='#' class='edit' rel='hashtag' rev='%s'>%s</a></td>
                                    <td>
                                        <!--<a href='/admin/socialstream/?hashtag=%s'>Stream</a><br/>-->
                                        <a href='/admin/socialsearch/?hashtag=%s&q=%s'>Search</a>
                                    </td>
                                    <td>
                                        <!--<a rev='%s' href='#' id='clientShareFacebookTrigger'><img alt='%s' style='max-width:initial' class='videoIcon videoIconFacebook' src='/core/webassets/images/facebook-transparent.png' /></a>-->
                                        <a rev='%s' href='#' id='clientShareTwitterTrigger'><img alt='%s' style='max-width:initial' class='videoIcon videoIconTwitter' src='/core/webassets/images/twitter-transparent.png' /></a>
                                    </td>
                                    <td style='border:0px;padding:0px !important'>
                                        <table style='width:100%%'>
                                        <tr style='background:#FFF'>
                                            <th style='width:50%%'>Videos</th>
                                        </tr>
                                        %s
                                        </table>
                                    </td>
                                </tr>";
                                }
                            } else {
                                 if ($is_ticker) {
                                    $rowFormat = "
                                <tr>
                                    <td style='text-align:center;width:50px' class='%s'>
                                        <button type='button' class='setQuestionState' rel='%s' rev='%s'>%s</button>
                                    </td>
                                    <td>%s</td>
                                    <td style='text-align:center;width:50px' class='%s'>
                                        <button type='button' class='setQuestionDeleted' rel='%s' rev='%s'>%s</button>
                                    </td>
                                    <td><a href='#' class='edit' rel='question' rev='%s'>%s</a></td>
                                    <td><a href='#' class='edit' rel='hashtag' rev='%s'>%s</a></td>
                                    <td>
                                        <!--<a href='/admin/socialstream/?hashtag=%s'>Stream</a><br/>-->
                                        <a href='/admin/socialsearch/?hashtag=%s&q=%s'>Search</a>
                                    </td>
                                    <td>
                                        <!--<a rev='%s' href='#' id='clientShareFacebookTrigger'><img alt='%s' style='max-width:initial' class='videoIcon videoIconFacebook' src='/core/webassets/images/facebook-transparent.png' /></a>-->
                                        <a rev='%s' href='#' id='clientShareTwitterTrigger'><img alt='%s' style='max-width:initial' class='videoIcon videoIconTwitter' src='/core/webassets/images/twitter-transparent.png' /></a>
                                    </td>
                                    <td>
                                        <a href='%s' target='_blank' rel='xml' rev='%s'>%s</a> -
                                        <a href='%s' target='_blank' rel='preview' rev='%s'>%s</a>
                                        <!--<a href='%s'  rel='#tvScreenOverlay' class='tvScreenSettingOverlayLink' rev='%s'>%s</a>-->
                                        <a href='#' class='linkPopUp' rel='%s' >Links</a>
                                         ";
                                    if(Yii::app()->params['send_ticker']) {
                                        $rowFormat .= "<a href='#' class='fab-btn send_button'>Send</a>";
                                    }
                                    $rowFormat .= "
                                    </td>
                                    <td style='border:0px;padding:0px !important'>
                                        <table style='width:100%%'>
                                        <tr style='background:#FFF'>
                                            <th style='width:50%%'>Tickers</th>
                                        </tr>
                                        %s
                                        </table>
                                    </td>
                                </tr>";
                                } else {
                                    $rowFormat = "
                                <tr>
                                    <td style='text-align:center;width:50px' class='%s'>
                                        <button type='button' class='setQuestionState' rel='%s' rev='%s'>%s</button>
                                    </td>
                                    <td>%s</td>
                                    <td style='text-align:center;width:50px' class='%s'>
                                        <button type='button' class='setQuestionDeleted' rel='%s' rev='%s'>%s</button>
                                    </td>
                                    <td><a href='#' class='edit' rel='question' rev='%s'>%s</a></td>
                                    <td><a href='#' class='edit' rel='hashtag' rev='%s'>%s</a></td>
                                    <td>
                                        <!--<a href='/admin/socialstream/?hashtag=%s'>Stream</a><br/>-->
                                        <a href='/admin/socialsearch/?hashtag=%s&q=%s'>Search</a>
                                    </td>
                                    <td>
                                        <!--<a rev='%s' href='#' id='clientShareFacebookTrigger'><img alt='%s' style='max-width:initial' class='videoIcon videoIconFacebook' src='/core/webassets/images/facebook-transparent.png' /></a>-->
                                        <a rev='%s' href='#' id='clientShareTwitterTrigger'><img alt='%s' style='max-width:initial' class='videoIcon videoIconTwitter' src='/core/webassets/images/twitter-transparent.png' /></a>
                                    </td>
                                    <td style='border:0px;padding:0px !important'>
                                        <table style='width:100%%'>
                                        <tr style='background:#FFF'>
                                            <th style='width:50%%'>Videos</th>
                                        </tr>
                                        %s
                                        </table>
                                    </td>
                                </tr>";
                                }
                            }
                                $totalFormat = "
                                <tr>
                                    <td>%s</td>
                                </tr>";
                                $i = 0;
                                if(Yii::app()->params['cloudGraphicAppearanceSetting']['enableTickerCloudGraphicSetting'] === true) {
                                foreach ($questions as $k => $v) {
                                    $active = strtotime($v->start_time) <= time() && time() <= strtotime($v->end_time) ? 'active' : 'inactive';
                                    $deleted = ($v->is_deleted == 0) ? '' : 'deleted';
                                    if ($is_ticker) {
                                        echo sprintf($rowFormat, $active, $v->id, ($active == 'active') ? date('Y-m-d', time()) : date('Y-m-d', Yii::app()->params['ticker']['defaultEndTime']), ($active == 'active') ? 'Stop' : 'Start', $v->updated_on, $deleted, $v->id, ($v->is_deleted == 0) ? '1' : '0', ($v->is_deleted == 0) ? 'Delete' : 'Restore', $v->id, (!empty($v->question)) ? $v->question : '*', $v->id, (!empty($v->hashtag)) ? $v->hashtag : '*', $v->hashtag, urlencode($v->hashtag), $v->id, $v->id, $v->id, $v->id, $v->id, '/XML/questionTicker?id=' . $v->id, $v->id, $v->id . '.xml', '/XML/questionTickerRSS?id=' . $v->id, $v->id, $v->id.'.rss','/admin/tvscreensetting?e_type=ticker&refid='.$v->id, $v->id, 'Cloud Graphics',$v->id, sprintf($totalFormat, $v->tickerAcceptedTvTally())
                                        );
                                    } else {
                                        echo sprintf($rowFormat, $active, $v->id, ($active == 'active') ? date('Y-m-d', time()) : date('Y-m-d', Yii::app()->params['video']['defaultEndTime']), ($active == 'active') ? 'Stop' : 'Start', $v->updated_on, $deleted, $v->id, ($v->is_deleted == 0) ? '1' : '0', ($v->is_deleted == 0) ? 'Delete' : 'Restore', $v->id, (!empty($v->question)) ? $v->question : '*', $v->id, (!empty($v->hashtag)) ? $v->hashtag : '*', $v->hashtag, urlencode($v->hashtag), $v->id, $v->id, $v->id, $v->id, $v->id, sprintf($totalFormat, $v->videoAcceptedTvTally())
                                        );
                                    }
                                }
                                } else {
                                     foreach ($questions as $k => $v) {
                                    $active = strtotime($v->start_time) <= time() && time() <= strtotime($v->end_time) ? 'active' : 'inactive';
                                    $deleted = ($v->is_deleted == 0) ? '' : 'deleted';
                                    if ($is_ticker) {
                                        echo sprintf($rowFormat, $active, $v->id, ($active == 'active') ? date('Y-m-d', time()) : date('Y-m-d', Yii::app()->params['ticker']['defaultEndTime']), ($active == 'active') ? 'Stop' : 'Start', $v->updated_on, $deleted, $v->id, ($v->is_deleted == 0) ? '1' : '0', ($v->is_deleted == 0) ? 'Delete' : 'Restore', $v->id, (!empty($v->question)) ? $v->question : '*', $v->id, (!empty($v->hashtag)) ? $v->hashtag : '*', $v->hashtag, urlencode($v->hashtag), $v->id, $v->id, $v->id, $v->id, $v->id, '/XML/questionTicker?id=' . $v->id, $v->id, $v->id . '.xml',  '/XML/questionTickerRSS?id=' . $v->id, $v->id, $v->id.'.rss','/XML/questionTickerRSS?id=' . $v->id, $v->id, ' - '.$v->id.'.rss',$v->id, sprintf($totalFormat, $v->tickerAcceptedTvTally())
                                        );
                                    } else {
                                        echo sprintf($rowFormat, $active, $v->id, ($active == 'active') ? date('Y-m-d', time()) : date('Y-m-d', Yii::app()->params['video']['defaultEndTime']), ($active == 'active') ? 'Stop' : 'Start', $v->updated_on, $deleted, $v->id, ($v->is_deleted == 0) ? '1' : '0', ($v->is_deleted == 0) ? 'Delete' : 'Restore', $v->id, (!empty($v->question)) ? $v->question : '*', $v->id, (!empty($v->hashtag)) ? $v->hashtag : '*', $v->hashtag, urlencode($v->hashtag), $v->id, $v->id, $v->id, $v->id, $v->id, sprintf($totalFormat, $v->videoAcceptedTvTally())
                                        );
                                    }
                                }
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<?php $this->renderPartial('/adminTvScreenAppearSetting/_tvScreenAppearSettingForm', array()); ?>
<?php $this->renderPartial('/adminQuestion/_linksOverlay'); ?>