
<div id="content">
    <div class="you">
        <?php
        $this->renderPartial('/user/_sidebar', array(
            'user' => $user,
                )
        );
        ?>
        <div class="verticalRule">
            <img src="<?php echo Yii::app()->request->baseurl;?>/webassets/images/you/profile.divider.png" />
        </div>
        <div class="youContent">
            <h1>NEED HELP?</h1>
            <div class="textBox">
                <div style="background-color: #0a0f39;overflow: hidden;">
                    <div class="numBox">STEP 1</div>
                    <div class="txtBox">
                    <b>Click "Record" Lights, Camera, Action!</b><br>
                    Look towards the webcam, speak up clearly, smile and
                    have fun recording your video.
                    </div>
                </div>
                <div style="background-color: #0a0f39;overflow: hidden;">
                    <div class="numBox">STEP 2</div>
                    <div class="txtBox">
                    <b>Describe Your Video</b><br>
                    Add a title, tags, and description. Don't forget to
                    review your video. You can re-record your video if you don't like it.
                    </div>
                </div>
                <div style="background-color: #0a0f39;overflow: hidden;">
                     <div class="numBox">STEP 3</div>
                     <div class="txtBox">
                    After you click submit you will be prompted to log in if you have not already done so.
                     </div>
                </div>
            </div>
            <div style="margin:10px;float:right;">
                <a href="mailto:<?php echo Yii::app()->params['email']['mailto'];?>" style="color: #fff">Contact Us</a>
            </div>
        </div>
    </div>
</div>
