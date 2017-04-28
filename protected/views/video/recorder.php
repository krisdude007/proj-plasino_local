<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('/webassets/js/swfobject.js', CClientScript::POS_HEAD);
$cs->registerScriptFile('/webassets/js/cbUtil.js', CClientScript::POS_HEAD);
?>
<script type="text/javascript">
    var swfVersionStr = "10.0.0";
    var xiSwfUrlStr = "expressInstall.swf";
    var flashvars = {'max_dur': '<?php echo $duration; ?>','uid':'<?php echo $user_id; ?>', 'recMode': '', 'server': 'rtmp://<?php echo $wowzaip; ?>/vod/', 'integrationURL': '/newrecorder/hd/', 'micTint': 100, 'micHexColor': '0x2796A9', 'frameTint': 100, 'frameHexColor': '0x2796A9'};
    var params = {};
    params.quality = "high";
    params.wmode = "opaque";
    params.allowscriptaccess = "true";
    params.allowfullscreen = "true";
    var attributes = {};
    attributes.id = "youtoorecorder";
    attributes.name = "youtoorecorder";
    attributes.align = "middle";
    swfobject.embedSWF("/core/webassets/swf/recorder.swf?id=<?php echo time(); ?>", "flashContent", "700", "420", swfVersionStr, xiSwfUrlStr, flashvars, params, attributes);
    swfobject.createCSS("#flashContent", "display:block;");
</script>

<div id="pageContainer" class="container">
    <div class="recorder row text-center" style="padding: 2% 0px;">
        <div id="flashContent">
            <p>To view this page ensure that Adobe Flash Player version 10.3.187.7 or greater is installed.</p>
            <script type="text/javascript">
                var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://");
                document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='"
                        + pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>");
            </script>
        </div>
    </div>
</div>
<?php if (!isset($_COOKIE['hideRecorderOverlay'])): ?>
    <div class="dim">
        <div class="overlay">
            <div class="overlaytitle">
                Wait, Before You Get Started Recording...
            </div>
            <div class="overlaybody">
                <div class="columnleft">
                    <div class="columntitle">FIRST</div>
                    <div class="columnbody" style="width:175px">
                        <ul class="recorderinstructions1">
                            <li>Do you want us to hear you?  Great&mdash;please turn down your TV and turn up your microphone!</li>
                            <li>Please speak up and speak clearly in to the microphone&mdash;and please keep it as clean as you can.</li>
                            <li>MOST IMPORTANTLY&mdash;BE YOURSELF!! Have fun, but don't include music, brand names or logos, or anything offensive, indecent or in bad taste. </li>
                        </ul>
                    </div>
                </div>
                <div class="columnright">
                    <div class="columntitle">THEN, SET YOUR RECORDER SETTINGS</div>
                    <div class="columnbody" style="width:540px;text-align:center">
                        <div style="position:relative;text-align:left;font-size:13px;color:#1a93a8">
                            <?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false): ?>
                                <img src="/webassets/images/record/Image_Flash_Setting_Chrome.png" alt="Adobe Flash settings diagram" />
                            <?php else: ?>
                                <img src="/webassets/images/record/Image_Flash_Setting_Firefox.png" alt="Adobe Flash settings diagram" />
                            <?php endif; ?>
                            <?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false): ?>
                            <?php endif; ?>
                        </div>

                        Get started now - click below to set your recorder settings.<br />
                        <!--                        <a href="#" class="hide_dim">-->
                        <button class="darkBtn hide_dim" style="margin:5px;">CLICK HERE</button>
                        <!--                        </a>-->
                        <br />
                        <label for="hiderecorderhelp">
                            <input type="checkbox" id="hiderecorderhelp" name="hiderecorderhelp" value="1" />
                            Do not show again
                        </label>
                    </div>
                </div>
                <div style="clear:both;padding:1px"></div>
            </div>
        </div>
    </div>
<?php endif; ?>
<script>
    function detectflash() {
        if (navigator.plugins != null && navigator.plugins.length > 0) {
            return navigator.plugins["Shockwave Flash"] && true;
        }
        if (~navigator.userAgent.toLowerCase().indexOf("webtv")) {
            return true;
        }
        if (~navigator.appVersion.indexOf("MSIE") && !~navigator.userAgent.indexOf("Opera")) {
            try {
                return new ActiveXObject("ShockwaveFlash.ShockwaveFlash") && true;
            } catch (e) {
            }
        }
        return false;
    }
    $(document).ready(function() {
        if (!detectflash()) {
            $('#flashContent').hide();
        }
    });
    var resize_flash = function() {
        var width = $('.recorder').width();
        width = (width < 829) ? width : 720;
        $('#youtoorecorder').attr('width', width).attr('height', width * 420 / 720);
    };
    resize_flash();
    $(window).resize(function() {
        resize_flash();
    });
</script>