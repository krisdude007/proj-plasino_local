<?php
$cs = Yii::app()->clientScript;
$cs->registerCoreScript('jquery', CClientScript::POS_END);
$stripe = StripeUtility::config();
?>

<style>
    input[type=radio] {
        display:none;
        margin:20px;
    }

    input[type=radio] + label {
        display:inline-block;
    }

    input[type=radio]:checked + label {
        background-image: none;
        background-color:#d0d0d0;
    }

</style>

<div id="pageContainer" class="container" style='padding-right: 0px; padding-left: 0px;'>
    <div class='subContainer'>
        <?php $this->renderPartial('_sideBar', array()); ?>
        <div class="row" style='margin-right: -31px; margin-left: -36px;'>
            <div class="col-sm-12" style='padding-right: 0px; padding-left: 0px; top: -30px;'>
            </div>
        </div>
        <div class='row' style='margin-top:30px;'>
            <div class="col-sm-12" style="padding-right: 0px; padding-left: 0px; left: -23px;top: -30px;">

                <div class='gameEntry' style='width: 100%; background-color: #eeeeee; min-height: 299px; min-width: 823px;'>

                    <div id="flashcontent" style="height: 480px; width: 640px; overflow: hidden; margin: 0px 0px 0px 132px; background: rgb(0, 0, 0);"><object width="640" height="480" id="gameloader" name="gameloader" data="http://media.mindjolt.com/media/the-word-pyramid.swf?hcxqhd" type="application/x-shockwave-flash" style="margin-top: 0px;"><param name="allowfullscreen" value="true"><param name="allowscriptaccess" value="always"><param name="quality" value="high"><param name="name" value="gameloader"><param name="bgcolor" value="#000000"><param name="allowScriptAccess" value="always"><param name="loop" value="false"><param name="wmode" value="window"><param name="flashvars" value="mjPath=http%3A%2F%2Fmedia.mindjolt.com%2Fmedia%2Fmj_api_as3.swf%3Fv%3D1&amp;allow_scale=0&amp;mj_sig_hpm_game_id=82203&amp;mj_sig_game_id=7802&amp;mj_sig_game_key=2JQGBMPPQCKENNHE&amp;mj_sig_game_url=the-word-pyramid&amp;mj_sig_width=640&amp;mj_sig_height=480&amp;mj_sig_network=web&amp;mj_sig_network_name=mindjolt.com&amp;mj_sig_ts=1438877147877&amp;mj_sig_rand=-1021590713291627864&amp;mj_sig_play_again=true&amp;mj_sig_analytics_host=analytics.mindjolt.com&amp;mj_sig_analytics_enabled=1&amp;game_key=2JQGBMPPQCKENNHE&amp;game_url=the-word-pyramid&amp;mj_sig_recomendations=1&amp;recommendations_url=http%3A%2F%2Fwww.mindjolt.com%2Fservlet%2FRecommendation%2F%3Fid%3D82203&amp;mj_sig_play_again_ad_id=mj&amp;mj_sig_html_ads=1&amp;mj_sig_force_redraw=1&amp;mj_sig=e7dc1746d87fb8b95d363badd396e60c"></object></div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $('input[type=radio]').on('change', function() {
        $('#game-choice-form').submit();
    });
</script>
