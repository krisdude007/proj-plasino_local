<?php
$videoFormat = '
    <div class="videoBlock">
        <div class="videoThumb"><a href="%s"><img src="%s" /></a></div>
        <div class="videoData">
            <div class="videoTitle bold">%s</div>
            <div class="videoDate">%s</div>
            <div class="videoByline" style="%s">by <a href="%s"><span class="bold">%s</span></a></div>
            <div class="videoViews">%s views</div>
            <div class="videoRate">%s</div>
        </div>
    </div>
';
$starNum=0;
if(sizeof($videos) != 0){
    foreach($videos as $video){
        $stars='';
        $starNum = 0;
        for($i=0;$i<$video->rating;$i++){
            ++$starNum;
            $stars .= "<img src='/webassets/images/play/star_yellow.png' />";
        }
        $starNum = 0;
        for($t=0;$t<5-$i;$t++){
            ++$starNum;
            $stars .= "<img src='/webassets/images/play/star_white.png' />";
        }
        echo sprintf(
            $videoFormat,
            '/play/'.$video->view_key,
            '/'.basename(Yii::app()->params['paths']['video'])."/{$video->thumbnail}.png",
            str_replace('Vine Video: ', 'Vine: ', $video->title),
            $video->created_on,
            (isset($video->user->first_name))
                ? ''
                : 'display:none',
            '/user/'.$video->user_id,
            (isset($video->user->first_name)? $video->user->first_name : '') .' '.( isset($video->user->last_name) ? $video->user->last_name : ''),
            $video->views,
            $stars
        );
    }
}
?>
