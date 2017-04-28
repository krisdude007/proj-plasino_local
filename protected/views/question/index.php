<div id="content">
    <div class="questions centerBlock">
        <?php if($type == 'video'): ?>
        <div class="gradient" style="overflow: hidden;padding: 12px;border-top-left-radius: 14px;border-top-right-radius:14px;">
            <div style="float:left;width:146px;padding: 1%;"><h1 class="circularNumber" style="float:left;">1</h1><h2 class="headerTxt">PICK</h2><h6 class="smallTxt">A TOPIC</h6></div>
            <div style="float:left;width:196px;padding: 1%;"><h1 class="circularNumber" style="float:left;">2</h1><h2 class="headerTxt">RECORD</h2><h6 class="smallTxt">YOUR VIDEO</h6></div>
            <div style="float:left;width:208px;padding: 1%;"><h1 class="circularNumber" style="float:left;">3</h1><h2 class="headerTxt">SUBMIT</h2><h6 class="smallTxt">GET STARTED BELOW</h6></div>
        </div>
        <?php endif; ?>
        <div style="background-color:#091AAC;">
            <div style="display:inline-block;min-height:60px; width:100%;">
                <div class="bold" style="clear:both;padding:10px;">
                    <div style="text-align:center;">
                        <?php
                        if ($type == 'video') {
                            echo 'Click on the question you want to record yourself answering.<br>';
                        } else {
                            echo 'Click on the question you want to shout an answer.<br>';
                        }
                        ?>
                        Now you're one step closer to getting on TV!
                    </div>
                </div>
            </div>
            <hr style="border-top:1px solid #0000ea;">
            <?php
            $i = 1;
            if ($type == 'video') {
                $actionLink = '/record?id=';
            } else {
                $actionLink = '/ticker?id=';
            }
            ?>
            <?php $i = 1;foreach ($questions as $question): ?>
            <?php if ($type == 'video'): ?>
            <a style="color:#FFF" href="<?php echo $actionLink.$question->id; ?>">
            <?php else: ?>
                <a style="color:#FFF" href="<?php echo $actionLink.$question->id; ?>">
            <?php endif;?>
                    <div style="display:inline-block;min-height:60px;">
                        <div class="bold" style="padding:10px;overflow: hidden;">
                            <div style="float:left;width:100px;">Question <?php echo $i; ?></div>
                            <div style="overflow:hidden;"><?php echo $question->question; ?></div>
                        </div>
                    </div>
                </a>
                <hr style="border-top:1px solid #0000ea;">
                <?php ++$i; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
