<div id="pageContainer" class="container" style="background-color: #2d2926;">
    <div class="subContainer">
        <?php
        echo "<div class='background'>";
        echo "<img src='/webassets/images/newbground_4.png' style='max-width: 100%'/>";
echo "<h1 style='color: #df9721; font-size: 40px; text-shadow:2px 2px 0px #8f090a; background: transparent;'>What Famous Painting is this?</h1>";
//echo "<h1 style='color: #ffffff; font-size: 22px; text-shadow:2px 2px 0px #8f090a; background: transparent;'>HOW TO ENTER FOR A CHANCE TO WIN $3,500</h1>";
//echo "<h1 style='color: #df9721; font-size: 19px; text-shadow:2px 2px 0px #8f090a; background: transparent;'>JUST FOLLOW OUR THREE SIMPLE STEPS:</h1>";
echo "<h5 style='color: #ffffff; text-shadow:2px 2px 0px #8f090a; text-align: center; background: transparent; line-height: 1.5; font-size: 17px;'>Answer the question and play now for $1 for your chance to win $3500 this week!</h3>";
//echo "<h5 style='color: #ffffff; text-shadow:2px 2px 0px #8f090a; margin-left: 24px; text-align: left; background: transparent;'>2.     YOU HAVE 15 SECONDS TO ANSWER EACH QUESTION.</h3>";
//echo "<br/><br/>";
//echo "<div style='color: #ffffff; text-shadow:2px 2px 0px #8f090a; font-size: 16px; background: transparent; line-height: 1.5; padding-top: 300px; padding-bottom: 10px;'></div>";
//echo "<div style='color: #ffffff; text-shadow:2px 2px 0px #8f090a; font-size: 20px; background: transparent; width: 400px; margin: 0 auto; '>How Long Has Baldini's Been Sparks' Favorite Local Casino?</div>";
    //echo "<div style='color: #ffffff; text-shadow:2px 2px 0px #8f090a; font-size: 20px; background: transparent; width: 400px; margin: 0 auto; '>The Contest is over, look us up for a new contest in a few weeks, in the mean time check out the winner of the last contest <a href=\"https://baldinis.youtoo.com/winners\">here</a>.</div>";
echo "<div style='background: transparent; color: #ffffff; max-width: 750px; margin: 0 auto; text-align: justify; padding-top: 10px; padding-bottom: 25px; font-size: 17px; font-weight: bold;'>";
echo "To play simply click the button below to login, pay and select your answer for a chance to win $3,500! And no matter what you get 1 credit for our store to spend on drinks, food and more. Two beers are only 1 credit! You can’t loose! Your choice of two beers is guaranteed!";

echo "</div>";
echo  strpos($_SERVER["HTTP_USER_AGENT"], 'Firefox') ? "<a href='".Yii::app()->createUrl('/playnow')."' onclick='isChecked(); return false;' id='game_redirect' class='btn btn-default btn-lg active' style='margin: 9px; margin-bottom: 20px;'>Login and Play Now</a>" : "<a href='".Yii::app()->createUrl('/playnow')."' onclick='isChecked(); return false;' id='game_redirect' class='btn btn-default btn-lg active' style='margin-bottom: 20px;'>Login and Play Now</a>";

//echo "<div style='background: transparent; color: #ffffff; margin: 0px 135px 5px; font-size: 25px; '>The Contest is over, we will have a new contest starting very soon. In the mean time check out the winner of the last contest <a style='color: #DF9721;' href=\"https://baldinis.youtoo.com/winners\">here</a>.</div>";
echo strpos($_SERVER["HTTP_USER_AGENT"], 'Firefox') ? "<div style='background: transparent; color: #ffffff; margin: 5px 0px 30px; font-size: 12px; '>For each dollar you pay, you receive $1 in credits for food, beer, merchandise or free play at Baldinis! At a minimum you get 2 beers or a burger basket for each entry!</div>" : "<div style='background: transparent; color: #ffffff; margin: 0px 130px 0px; font-size: 12px; '>For each paid entry, you receive $1 in credits to exchange for beer, food, merchandise or free play at Baldinis! At a <br>minimum you get 2 beers or a burger basket for each entry!</div>";
//echo strpos($_SERVER["HTTP_USER_AGENT"], 'Firefox') ? "<div style='background: transparent; color: #ffffff; margin: 5px 130px; font-size: 10px; '>*This is not gambling or gaming</div>" : "<div style='background: transparent; color: #ffffff; margin: 10px 130px; font-size: 10px; '>*This is not gambling or gaming</div>";
//echo "<div style='background: transparent; color: #DF9721; text-align: left; margin: 10px 125px; font-size: 11px;'><a href='https://baldinis.youtoo.com/termsofuse' target='_blank' style='color: #DF9721; '>Terms of use & privacy policy</a> | <a href='https://baldinis.youtoo.com' target='_blank' style='color: #DF9721; '>Rules</a> | <a href='https://baldinis.youtoo.com' target='_blank' style='color: #DF9721; '>FAQ</a> | <a href='http://youtootech.com/patents' target='_blank' style='color: #DF9721; '>Youtootech.com/patents</a></div>";
echo "</div>";
?>
    </div>
</div>