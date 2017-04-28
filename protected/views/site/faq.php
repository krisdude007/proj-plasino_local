<div id="pageContainer" class="container" style="padding-left: 0px;">
    <div class="subContainer" style="padding: 0px;">
        <?php $this->renderPartial('_sideBar', array()); ?>
       <div class="col-sm-12 col-xs-12 floatRight" style="padding-right: 0px; padding-left: 0px;">
            <p>&nbsp</p>
            <h3 style="font-weight: 300; margin-bottom: 40px;"><?php echo Yii::t('youtoo', 'FAQ'); ?></h3>
            <div class="form">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'user-profile-form',
                    'enableAjaxValidation' => true,
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                ));
                ?>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>What is DFW Marine Aquarium Society?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>DFWMAS is a 501c7 which is Dedicated to promoting public interest in the marine aquarium hobby and the advancement of knowledge in the husbandry of closed ecosystems. Your contribution is not tax deductible for Federal Income tax purposes but will be used to support our mission. </div>
                    </div>
                </div>
                <br/>

                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>Do I need to pay to enter the Sweepstakes?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>There are paid and unpaid methods of entry.  You can pay to enter the Sweepstakes by using a credit card or PayPal account via the website.  You can also mail in a post card to enter.  Please see the Terms and Conditions/Official Rules for more information.  </div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>What is the price to enter if I choose the paid method?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>The Sweepstakes costs $5 (five US dollars) dollar to enter when using the paid method.  There may also be free to enter sweepstakes from time to time.</div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>Is there an age restriction?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>Yes. This is designed as a game for players 18 years or older to play, or as designated by your state’s age restrictions for paid sweepstakes.</div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>What are the hours of gameplay?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>The Game runs 24 hours a day with multiple games every week.</div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>What are the methods of entry?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>As mentioned above, there are two methods of entry.  You can pay to enter the sweepstakes by using a credit card or PayPal account via the website.  You can also mail in a post card to enter.  Please see the Term and Conditions/Official Rules for more information.</div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>What are the system requirements, if any, to install on my computer?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>You do not need to install any software on your computer.  As long as you have an Internet connection with a suitable web browser (Firefox, Safari, Chrome, Internet Explorer), you can login or register to enter the <?php echo Yii::app()->name; ?> Sweepstakes.</div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>What about privacy? Can anyone see my profile?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>We take your privacy very seriously.  Please refer to the Privacy Policy with the link at the bottom of the page for any questions you may have.</div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>How are winners selected?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>The winner(s) are randomly drawn from the pool of all eligible participants via the computerized platform. </div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>How are winners announced?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>Winners will be notified via the email address used to enter the sweepstakes and will also be available on line in the winners section.  All public or media mentions will be at the sole discretion of DFWMAS</div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>How do I obtain my prize if I am a winner?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>Confirmed winners will need to sign appropriate paperwork and receive their prize.  A representative will contact winners.   If a the winner cannot be reached after a reasonable effort has been made during five (5) business days from the first notification attempt, such person may be disqualified, with an alternate winner selected in accordance with the Official Sweepstakes Rules.  Only one attempt for a new alternate will be conducted per Prize.  If attempts fail, unclaimed Prize(s) will not be awarded.</div>
                    </div>
                </div>
                <br/>
               
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>Do I need to pay to register?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>No, you do not need to pay to register.  Please see Terms and Conditions/Official Rules for more information</div>
                    </div>
                </div>
            </div>
            <br/>

            <p>&nbsp</p>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<script>
    function collapseMe() {
        $('#collapseOne').addClass('collapse').removeClass('in');
        $('#collapseTwo').addClass('collapse').removeClass('in');
        $('#collapseThree').addClass('collapse').removeClass('in');
        return true;
    }

    $(document).on('click', '.panel-heading span.clickable', function(e) {
        var $this = $(this);
        if (!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideUp();
            $this.addClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-right');
        } else {
            $this.parents('.panel').find('.panel-body').slideDown();
            $this.removeClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-down');
        }
    })

</script>
