<?php
if (!isset($width))
    $width = '700';
if (!isset($height))
    $height = '400';
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
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="528" height="297" allowFullScreen="true">
    <param name="flashvars" value="file=<?php print '/' . basename(Yii::app()->params['paths']['video']) . '/' . $video->filename; ?><?php echo Yii::app()->params['video']['postExt']; ?>&image=<?php print '/' . basename(Yii::app()->params['paths']['video']) . '/' . $video->thumbnail; ?><?php echo Yii::app()->params['video']['imageExt']; ?>&controlbar=none&dock=false&autostart=false&stretching=exactfit" />
    <param name="movie" value="/webassets/swf/player.swf" />
    <param name="wmode" value="transparent" />
    <embed src="/webassets/swf/player.swf"
           width="<?php echo $width; ?>"
           height="<?php echo $height; ?>"
           wmode="transparent"
           type="application/x-shockwave-flash"
           pluginspage="http://www.macromedia.com/go/getflashplayer"
           allowFullScreen="true"
           flashvars="file=<?php print '/' . basename(Yii::app()->params['paths']['video']) . '/' . $video->filename; ?><?php echo Yii::app()->params['video']['postExt']; ?>&image=<?php print '/' . basename(Yii::app()->params['paths']['video']) . '/' . $video->thumbnail; ?><?php echo Yii::app()->params['video']['imageExt']; ?>&controlbar=none&dock=false&autostart=false&stretching=exactfit" />
</object>
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
