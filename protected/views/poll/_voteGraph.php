<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('/webassets/vendor/RGraph/libraries/RGraph.common.core.js', CClientScript::POS_END);
$cs->registerScriptFile('/webassets/vendor/RGraph/libraries/RGraph.common.tooltips.js', CClientScript::POS_END);
$cs->registerScriptFile('/webassets/vendor/RGraph/libraries/RGraph.hbar.js', CClientScript::POS_END);
$cs->registerScript('graph',"getGraphData({$poll->id});setInterval('getGraphData({$poll->id})',1000);",CClientScript::POS_READY);
?>
<div class="tcenter centerBlock" style="margin-left:auto;margin-right:auto;width:388px;height:220px;background:url('/webassets/images/vote/graph-background3.png');background-repeat:no-repeat; background-size: 100% 100%;">
    <canvas class="cvs" id="cvs" width="600" height="191px" style="margin-left:-197px; padding-top:10px">[No canvas support]</canvas>
</div>
