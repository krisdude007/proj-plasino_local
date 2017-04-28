<?php
$cs = Yii::app()->getClientScript();
//$cs->registerScriptFile('/webassets/js/jquery.jscrollpane.min.js', CClientScript::POS_END);
$cs->registerScriptFile('/webassets/js/jquery.mousewheel.js', CClientScript::POS_END);
$cs->registerScriptFile('/webassets/js/mwheelIntent.js', CClientScript::POS_END);
$cs->registerScriptFile('/webassets/js/jquery.oauthpopup.js', CClientScript::POS_END);
//$cs->registerScript('scrollpane', "$('.scroll-pane').jScrollPane({autoReinitialise: true, hideFocus: true, contentWidth:'0px'});");
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/protected/extensions/yiinfinite-scroll/assets/jquery.infinitescroll.min.js', CClientScript::POS_HEAD);
?>
<div id="content">
    <div class="videos" style="margin-left:auto;margin-right:auto;padding-top:12px;">
        <div style="text-align:center">
            <h1>VIEWER VIDEOS</h1>
            <div class="sorter" style="font-size:12px;margin-bottom:5px;">View By: &nbsp;&nbsp;
                <a style="padding:0.5% 1%" class="activeLink" href="<?php echo Yii::app()->request->baseurl; ?>/videos/recent">Most Recent</a>
                <a style="padding:0.5% 1%" href="<?php echo Yii::app()->request->baseurl; ?>/videos/views">Most Viewed</a>
                <a style="padding:0.5% 1%" href="<?php echo Yii::app()->request->baseurl; ?>/videos/rating">Highest Rated</a>
            </div>
            <div class="fab-right" style="margin-top:-3px; margin-left:26px;margin-bottom: 5px;">
                <?php $this->widget('CLinkPager', array('pages' => $pages, 'header' => '', 'prevPageLabel' => 'Prev', 'nextPageLabel' => 'Next')); ?>
            </div>
        </div>
        <div class="videoBlocks scroll-pane jspScrollable">
            <div id="posts">
                <div class="post">
                    <?php
                    $this->renderPartial('/video/_blocks', array('videos' => $videos));
                    ?>
                </div>
            </div>
            <?php
//            $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
//                'contentSelector' => '#posts',
//                'itemSelector' => 'div.post',
//                'loadingText' => 'Loading...',
//                //'videos' => $videos,
//                'pages' => $pages,
//            ));
//            ?>
        </div>
    </div>
</div>