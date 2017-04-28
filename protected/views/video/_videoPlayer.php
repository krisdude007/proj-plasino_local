<?php if (is_array($videoInfo['videofile'])): ?>
    <div id="mediaplayer"></div>
    <script type='text/javascript'>
        jwplayer('mediaplayer').setup({
            'flashplayer': '/webassets/swf/player.swf',
            'playlist': [
    <?php
    foreach ($videoInfo['videofile'] as $k => $v) {
        print "{ 'file': '{$v['file']}', 'image': '{$v['image']}' },";
    }
    ?>
            ],
            'controlbar': 'none',
            'width': '<?php print $videoInfo['width']; ?>',
            'height': '<?php print $videoInfo['height']; ?>',
            'stretching': 'exactfit',
            'repeat': 'list'
        });
    </script>
<?php else: ?>
    <div class="videoObject">
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="<?php print $videoInfo['width']; ?>" height="<?php print $videoInfo['height']; ?>" allowFullScreen="true">
            <param name="flashvars" value="file=<?php print $videoInfo['videofile']; ?>&image=<?php print $videoInfo['image']; ?>&controlbar=none&dock=false&autostart=false&stretching=exactfit" />
            <param name="movie" value="/webassets/swf/player.swf" />
            <param name="wmode" value="transparent" />
            <embed src="/webassets/swf/player.swf"
                   width="<?php print $videoInfo['width']; ?>"
                   height="<?php print $videoInfo['height']; ?>"
                   wmode="transparent"
                   type="application/x-shockwave-flash"
                   pluginspage="http://www.macromedia.com/go/getflashplayer"
                   allowFullScreen="true"
                   flashvars="file=<?php print $videoInfo['videofile']; ?>&image=<?php print $videoInfo['image']; ?>&controlbar=none&dock=false&autostart=false&stretching=exactfit" />
        </object>
    </div>
    <script>
        var resize_flash = function() {
            var width = $('.videoWindow').width();
            width = (width < 667) ? width : 667;
            $('embed').attr('width', width).attr('height', width * 400 / 700);
        };
        $(document).ready(function() {
            resize_flash();
            $(window).resize(function() {
                resize_flash();
            });
        });
    </script>
<?php endif; ?>
