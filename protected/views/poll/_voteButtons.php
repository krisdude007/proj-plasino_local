<div id="voteButtons" style="max-width: 400px;padding: 1% 1%;margin: 0 auto;">
    <?php foreach ($answers as $answer): ?>
        <div style="background-color:<?php echo $answer->color; ?>;margin: 10px;padding: 6px 4px;">
            <a class="voteButton" style="color:#ffffff;font-size:25px;font-weight:bold;cursor:pointer;" rel="<?php echo $answer->id; ?>"><?php echo $answer->answer; ?></a>
        </div>
    <?php endforeach; ?>
</div>
