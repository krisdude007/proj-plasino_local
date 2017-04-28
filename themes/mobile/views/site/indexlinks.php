<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.countdown.min.js', CClientScript::POS_END);
?>
<?php
            $currentWinLooseOrDrawGame = GameUtility::getCurrentWinLooseOrDrawGame($games);
?>
<script>
    $(document).ready(function(){
          $("#next-game-ends").countdown("<?php echo date('Y/m/d H:i:s', strtotime($currentWinLooseOrDrawGame['close_date'])); ?>", function(event) {
              var format = "%H:%M:%S";

              if(event.offset.days > 0) {
                format = '%-D día%!D ' + format;
              }
              var text2 = event.strftime(format);
              $(this).text(text2);
          });
    });
  </script>

<div class="homeTop" style="width: 100%; max-height: 51px; min-height: 51px; background-color: #292929;"><h5 style="text-align: right; margin-bottom: 0px; font-size: 16px; color: #ffffff; font-weight: lighter; float: left; margin-right: 5px;color: #f9d83d; width: 50%;"><?php echo Yii::t('youtoo','Participa antes de ');?></h5><h5 id="next-game-ends" style="margin-bottom: 0px; font-size: 16px; color: #ffffff; font-weight: bolder; width: 45%; float: left;"></h5></div>
<div class="link2">
        <?php
          $allDisplayedGames = GameUtility::getAllDisplayedGames($games);
          $q = 1;
          ?>
    <?php foreach ($games as $game): ?>
        <?php if($allDisplayedGames[$game->id]['is_show']) { ?>
            <!--    <hr></hr>-->
            <?php if($allDisplayedGames[$game->id]['disabled'] == "disabled"): ?>
            <div style='background-color: #292929;'><h4 <?php if($allDisplayedGames[$game->id]['disabled'] == "disabled"): ?>style='color: gray;'<?php else: ?>style='color: #f9d83d;'<?php endif; ?>><?php echo $game->description; ?></h4></div>
            <div style='background-color: #303030; display: table; width: 100%;'>
                <a style="font-weight: 100;" href="#">
                    <div style='float: left; width: 22%;'><?php echo '<h4 style="margin-bottom: 0px; padding: 5px 0px 0px 0px; margin-left: 10px; font-size: 10px; color: gray; font-weight: lighter; text-align: center;"><span style="color: gray; font-weight: bold;">' . Yii::t('youtoo', 'Entries ') . '</span><br/><br/> ' . ($game->num_plays_free + $game->num_plays_paid) . '</h4>'; ?></div>
                    <div style='float: left; width: 22%;'><?php echo '<h4 style="margin-bottom: 0px; padding: 5px 0px 0px 0px; margin-left: 10px; font-size: 10px; color: gray; font-weight: lighter; text-align: center;"><span style="color: gray;font-weight: bold;">' . Yii::t('youtoo', 'Entry fee ') . '</span><br/><br/> $' . $game->price . '</h4>'; ?></div>
                    <div style='float: left; width: 22%;'><?php echo '<h4 style="margin-bottom: 0px; padding: 5px 0px 0px 0px; margin-left: 10px; font-size: 10px; color: gray; font-weight: lighter; text-align: center;"><span style="color: gray;font-weight: bold;">' . Yii::t('youtoo', 'Prize ') . '</span><br/><br/> ' . $game->prize . '</h4>'; ?></div>
                    <div style='float: left; width: 22%;'><?php echo '<h4 style="margin-bottom: 0px; padding: 5px 0px 0px 0px; margin-left: 10px; font-size: 10px; color: gray; font-weight: lighter; text-align: center;"><span style="color: gray;font-weight: bold;">' . Yii::t('youtoo', 'Live ') . '</span><br/><br/> ' . date('m/d/Y',strtotime($game->close_date)) . '</h4>'; ?></div>
                </a>
            </div>
            <?php else: ?>
            <div style='background-color: #292929;' onclick="window.location = '<?php echo Yii::app()->createUrl((sizeof($game->gameChoiceAnswers) != 5) ? '/multiplechoice/' . $game->id : '/winlooseordraw/' . $game->id, array()); ?>';"><h4 <?php if($allDisplayedGames[$game->id]['disabled'] == "disabled"): ?>style='color: gray;'<?php else: ?>style='color: #f9d83d;'<?php endif; ?>><?php echo $game->description; ?></h4></div>
            <div style='background-color: #303030; display: table; width: 100%;' onclick="window.location = '<?php echo Yii::app()->createUrl((sizeof($game->gameChoiceAnswers) != 5) ? '/multiplechoice/' . $game->id : '/winlooseordraw/' . $game->id, array()); ?>';">
                <a style="font-weight: 100;" href="<?php echo Yii::app()->createUrl((sizeof($game->gameChoiceAnswers) != 5) ? '/multiplechoice/' . $game->id : '/winlooseordraw/' . $game->id, array()); ?>"><?php //echo $game->description;  ?>
                    <div style='float: left; width: 22%;'><?php echo '<h4 style="margin-bottom: 0px; padding: 5px 0px 0px 0px; margin-left: 10px; font-size: 10px; color: #ffffff; font-weight: lighter; text-align: center;"><span style="color: #ffffff; font-weight: bold;">' . Yii::t('youtoo', 'Entries ') . '</span><br/><br/> ' . ($game->num_plays_free + $game->num_plays_paid) . '</h4>'; ?></div>
                    <div style='float: left; width: 22%;'><?php echo '<h4 style="margin-bottom: 0px; padding: 5px 0px 0px 0px; margin-left: 10px; font-size: 10px; color: #ffffff; font-weight: lighter; text-align: center;"><span style="color: #ffffff;font-weight: bold;">' . Yii::t('youtoo', 'Entry fee ') . '</span><br/><br/> $' . $game->price . '</h4>'; ?></div>
                    <div style='float: left; width: 22%;'><?php echo '<h4 style="margin-bottom: 0px; padding: 5px 0px 0px 0px; margin-left: 10px; font-size: 10px; color: #ffffff; font-weight: lighter; text-align: center;"><span style="color: #ffffff;font-weight: bold;">' . Yii::t('youtoo', 'Prize ') . '</span><br/><br/> ' . $game->prize . '</h4>'; ?></div>
                    <div style='float: left; width: 22%;'><?php echo '<h4 style="margin-bottom: 0px; padding: 5px 0px 0px 0px; margin-left: 10px; font-size: 10px; color: #ffffff; font-weight: lighter; text-align: center;"><span style="color: #ffffff;font-weight: bold;">' . Yii::t('youtoo', 'Live ') . '</span><br/><br/> ' . date('m/d/Y',strtotime($game->close_date)) . '</h4>'; ?></div>
                </a>
            </div>
            <?php endif; ?>
        <?php $q++; ?>
        <?php } ?>
    <?php endforeach; ?>
</div>