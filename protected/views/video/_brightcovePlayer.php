<?php
if(!isset($width)) $width = '528';
if(!isset($height)) $height = '297';
$path = PATH_USER_VIDEOS;
?>

<video controls style='width:100%; background-color:#000000;display:none;'>
    <?php if (file_exists(Yii::app()->params['paths']['video'] . '/' . $video->filename . '.mp4')): ?>
        <source src='<?php echo $path . '/' . $video->filename; ?>.mp4' type='video/mp4'>
    <?php endif; ?>
    <?php if (file_exists(Yii::app()->params['paths']['video'] . '/' . $video->filename . '.ogg')): ?>
        <source src='<?php echo $path . '/' . $video->filename; ?>.ogg' type='video/ogg'>
    <?php endif; ?>
</video>

<!-- Start of Brightcove Player -->

<!--
By use of this code snippet, I agree to the Brightcove Publisher T and C
found at https://accounts.brightcove.com/en/terms-and-conditions/.
-->

<script type="text/javascript" src="https://sadmin.brightcove.com/js/BrightcoveExperiences.js"></script>

<object id="myExperience" class="BrightcoveExperience">
  <param name="showNoContentMessage" value="true" />
  <param name="wmode" value="transparent" />
  <param name="bgcolor" value="#FFFFFF" />
  <param name="width" value="<?php echo $width;?>" />
  <param name="height" value="<?php echo $height;?>" />
  <param name="playerID" value="<?php echo Yii::app()->params['brightcove']['playerID']; ?>" />
  <param name="playerKey" value="<?php echo Yii::app()->params['brightcove']['playerKey']; ?>" />
  <param name="isVid" value="true" />
  <param name="dynamicStreaming" value="true" />
  <param name="@videoPlayer" value="<?php echo $video->brightcoves[0]->brightcove_id; ?>" />
  <param name="secureConnections" value="true" />
  <param name="secureHTMLConnections" value="true" />
</object>

<!--
This script tag will cause the Brightcove Players defined above it to be created as soon
as the line is read by the browser. If you wish to have the player instantiated only after
the rest of the HTML is processed and the page load is complete, remove the line.
-->
<script type="text/javascript">brightcove.createExperiences();</script>

<!-- End of Brightcove Player -->

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
    var resize_flash = function() {
        var width = $('.video').width();
        width = (width < 667) ? width : 667;
        $('embed').attr('width', width).attr('height', width * 400 / 700);
    };
    $(document).ready(function() {
        if (/Firefox/.test(navigator.userAgent) == false || !detectflash()) {
            $('object').hide();
            $('video').show();
        }

        resize_flash();
        $(window).resize(function() {
            resize_flash();
        });

    });
</script>