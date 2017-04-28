<div id="content">
    <div class="videos" style="margin-left:auto;margin-right:auto;padding-top:12px;">
        <div style="text-align:center">
            <h1>VIEWER IMAGES</h1>
            <div class="sorter" style="font-size:12px;margin-bottom:5px;">View By: &nbsp;&nbsp;
                <a style="padding:0.5% 1%" class="activeLink" href="<?php echo Yii::app()->request->baseurl; ?>/images/recent">Most Recent</a>
                <a style="padding:0.5% 1%" href="<?php echo Yii::app()->request->baseurl; ?>/images/views">Most Viewed</a>
                <a style="padding:0.5% 1%" href="<?php echo Yii::app()->request->baseurl; ?>/images/rating">Highest Rated</a>
            </div>
        </div>
        <div class="videoBlocks scroll-pane jspScrollable">
            <?php
            $this->renderPartial('/image/_blocks', array('images' => $images)
            );
            ?>
        </div>
    </div>
</div>