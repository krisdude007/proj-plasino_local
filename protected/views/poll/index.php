<?php $this->renderPartial('/csrf/_csrfToken'); ?>
<div id="content">
    <div class="tleft centerBlock">
        <div id="voteDetail">
            <?php if (!is_null($activePoll)): ?>
                <div id="voteHead" style="padding-top:12px">
                    <h1>
                        <?php if (strtotime($activePoll->end_time) <= time()): ?>
                            Voting Closed!
                        <?php else: ?>
                            VOTE NOW
                        <?php endif; ?>
                    </h1>
                    <div id="question" style="font-family: Helvetica, Arial, sans-serif;font-size:24px;font-weight:100;">
                        <?php echo $activePoll->question; ?>
                    </div>
                </div>
                <div class="afterVote" rel="<?php echo $activePoll->id; ?>">
                    <?php
                    $this->renderPartial('_voteButtons', array('answers' => $activePoll->pollAnswers));
                    ?>
                </div>
                <div class="afterVote" style="display:none;margin: 2% 1%;">
                    <div class='vote'>
                        <?php foreach ($activePoll->pollAnswers as $answer): ?>
                            <div class='vote_label'>
                                <span class='pull-left answer-title'><?php echo $answer->answer; ?></span>
                                <span class='pull-right percent'>0%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"  >
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class='vote_footer'>
                            <span class='pull-left'>0%</span>
                            <span class='pull-right text-right'>100%</span>
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <?php if (strtotime($activePoll->end_time) <= time()): ?>
                            <div style="width:125px;display: inline-block;margin: 0px 2%;"><a href="/vote"><img src="<?php echo Yii::app()->request->baseurl; ?>/webassets/images/vote/vote-button.png" /></a></div>
                        <?php else: ?>
                            <div style="width:125px;display: inline-block;margin: 0px 2%;"><a href="#" class="voteAgain"><img src="<?php echo Yii::app()->request->baseurl; ?>/webassets/images/buttons/vote-again.png" border="0"></a></div>
                        <?php endif; ?>
                        <div style="width:125px;display: inline-block;margin: 0px 2%;"><a href="<?php echo Yii::app()->request->baseurl; ?>/videos/recent"><img src="<?php echo Yii::app()->request->baseurl; ?>/webassets/images/buttons/watch-videos.png" border="0"></a></div>
                    </div>
                </div>
            <?php else: ?>
                <div id="voteHead" style="padding-top:12px">
                    <h1>
                        No Polls Open!
                    </h1>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>