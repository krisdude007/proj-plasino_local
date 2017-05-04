<?php

class clientSiteController extends SiteController {

    public $activeNavLink = 'index';
    public $activeSubNavLink = '';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function goToLogin() {
        $this->redirect($this->createUrl('/user/login'));
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('redeemPrize', 'payviapaypal', 'printReceipt', 'barcode', 'indexlinks', 'freecredit'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('index', 'home', 'winners', 'prizes', 'redeem', 'error', 'customerror', 'testserverload', 'confirmation', 'howtoplay', 'geocoordinates', 'geocoordinatesshare', 'ajaxGeoCoordinates', 'ajaxGeoCoordinatesNotPreshare', 'cannotplay', 'gameredirect', 'aboutlinks', 'about', 'legallinks', 'marketinglinks', 'legal', 'helplinks', 'help', 'faq', 'privacy', 'marketingpage', 'marketingpage2', 'payandplay', 'newpayandplay', 'freeplay', 'rules', 'testgame', 'terms', 'contact', 'ajaxFreeCredit'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('login'),
                'users' => array('?'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            //'deniedCallback' => array($this, 'goToLogin'),
            ),
        );
    }

    public function actionIndex($id = NULL) {
        // see which view to render based on whether or not
        // a game is currently available for play

        /* game play */
//        if (Yii::app()->user->isGuest) {
//                $validGeoUser = eGeoLocationInfo::model()->findbyAttributes(array('ip_address' => ClientUtility::getClientIpAddress()));//var_dump($validGeoUser);exit;
//                if (is_null($validGeoUser)) {
//                $this->redirect($this->createUrl('/geocoordinates'));
//            } elseif($validGeoUser->is_validlocation == 0 && $validGeoUser->city == 'unknown') {
//                $this->redirect($this->createUrl('/site/home'));
//            }
//        }
        //unset(Yii::app()->session['mainGameId']);
        //if (eGameChoice::getNumberOfActiveGames() > 0) {
//            $games = eGameChoice::getAllActiveGames();
//            var_dump($games);exit;
//            $response = new eGameChoiceResponse;
        $user_id = Yii::app()->user->getId();
        $user = clientUser::model()->findByPk($user_id);

//            if (isset($_POST['ajax']) && $_POST['ajax'] === 'game-choice-form') {
//                echo CActiveForm::validate($response);
//                Yii::app()->end();
//            }
//            if (isset($_POST['eGameChoiceResponse'])) {
//                $response->attributes = $_POST['eGameChoiceResponse'];
//                Yii::app()->session['gamechoiceanswerId'] = $response->game_choice_answer_id;
//                Yii::app()->session['gamechoiceId'] = $response->game_choice_id;
//                Yii::app()->session['source'] = $response->source;
//
//                if (empty($response->game_choice_answer_id)) {
//                    Yii::app()->user->setFlash('error', Yii::t('youtoo','Please choose an answer.'));
//                    $this->redirect($this->createUrl('/site/index'));
//                } else {
//
//                    if (Yii::app()->user->isGuest && empty($response->user_id)) {
//                        $response->user_id = 0;
//                    } else {
//                        $response->user_id = $user->id;
//                    }
//                    if ($response->validate()) {
//                        $response->save();
//                        Yii::app()->session['gamechoiceresponseId'] = $response->id;
//                    }
//                    $this->redirect($this->createUrl('/actel/payment'));
//                }
//            }

        $allCorrect = eGameChoiceResponse::model()->isCorrect()->findAllByAttributes(array('game_unique_id' => Yii::app()->session['gameUniqueId'])); //var_dump($countCorrect);exit;
        if (!empty($allCorrect)) {
            $allAnswers = eGameChoiceResponse::model()->findAllByAttributes(array('game_unique_id' => Yii::app()->session['gameUniqueId'])); //var_dump($countCorrect);exit;
            $countCorrect = sizeof($allCorrect);
            
            foreach ($allAnswers as $aa) {
                    $aa->bonus_credit = $countCorrect;
                    if($aa->validate()) {
                        $aa->update(array('bonus_credit'));
                    }
                }            
        } else {
            $countCorrect = 0;
        }
        //if (isset($game)) {
        //$formPlayNow = new FormPlayNow();
        $this->render('index', array(
            'countCorrect' => $countCorrect,
            //'games' => $games,
            //'game' => $game,
            //'response' => $response,
            'user' => $user,
                //'formPlayNow' => $formPlayNow,
        ));

        /* end game play */
//            } else {
//                Yii::app()->user->setFlash('error', "Errors found!");
//            }
//        } else {
//            $this->render('index2', array());
//        }
    }

    public function actionAjaxFreeCredit() {//var_dump($_POST);exit;
        if (empty(Yii::app()->session)) {
            echo json_encode(array('error' => Yii::t('youtoo', 'User not logged in.')));
            exit;
        }

        $userId = Yii::app()->user->getId();

        $freeCreditCode = isset($_POST['freecreditcode']) ? $_POST['freecreditcode'] : 999999;
        $usedEmail = isset($_POST['emailused']) ? $_POST['emailused'] : 'anonymous';
        $date = date('Y-m-d', time());

        $isCodeValid = eFreeCredit::model()->findByAttributes(array('freecredit_key' => $freeCreditCode, 'user_email' => $usedEmail)); //var_dump($isCodeValid);
        $user = clientUser::model()->findByAttributes(array('username' => $usedEmail));//var_dump($user);exit;
        
        if (!is_null($isCodeValid)) {
            if (!is_null($user->username) && $user->username == $isCodeValid->user_email) {
                if ($isCodeValid->is_code_used == 0) {
                    $totalFreeCredits = PaymentUtility::countFreeCreditsPerUser($user->id, $date);

                    if ($totalFreeCredits < Yii::app()->params['GamePlay']['maxFreeCredits']) {
                        $result = PaymentUtility::oneFreeCreditNEW('game_choice', Yii::app()->params['GamePlay']['freeCreditPrice'], $userId, $freeCreditCode);
                        if ($result) {
                            $isCodeValid->is_code_used = 1;
                            $isCodeValid->code_used_by = $userId;
                            if ($isCodeValid->validate()) {
                                $isCodeValid->update(array('is_code_used', 'code_used_by'));
                            }
                            echo json_encode(array('added' => Yii::t('youtoo', 'One free credit added')));
                        }
                    } else {
                        echo json_encode(array('limit_reached' => Yii::t('youtoo', 'You have reached your free credit limit. No more credits can be added for today.')));
                    }
                } else {
                    echo json_encode(array('code_expired' => Yii::t('youtoo', 'This code has been used already')));
                }
            } else {
                echo json_encode(array('invalid_email' => Yii::t('youtoo', 'This email is not associated with the code you entered.')));
            }
        } else {
            echo json_encode(array('invalid_code' => Yii::t('youtoo', 'This code entered is invalid. Please contact the administrator.')));
        }
    }

    public function actionTestGame() {

        //echo '1';
        //exit;
        //echo '<div id="flashcontent" style="height: 480px; width: 640px; overflow: hidden; margin: 0px 0px 0px 132px; background: rgb(0, 0, 0);"><object width="640" height="480" id="gameloader" name="gameloader" data="http://media.mindjolt.com/media/the-word-pyramid.swf?hcxqhd" type="application/x-shockwave-flash" style="margin-top: 0px;"><param name="allowfullscreen" value="true"><param name="allowscriptaccess" value="always"><param name="quality" value="high"><param name="name" value="gameloader"><param name="bgcolor" value="#000000"><param name="allowScriptAccess" value="always"><param name="loop" value="false"><param name="wmode" value="window"><param name="flashvars" value="mjPath=http%3A%2F%2Fmedia.mindjolt.com%2Fmedia%2Fmj_api_as3.swf%3Fv%3D1&amp;allow_scale=0&amp;mj_sig_hpm_game_id=82203&amp;mj_sig_game_id=7802&amp;mj_sig_game_key=2JQGBMPPQCKENNHE&amp;mj_sig_game_url=the-word-pyramid&amp;mj_sig_width=640&amp;mj_sig_height=480&amp;mj_sig_network=web&amp;mj_sig_network_name=mindjolt.com&amp;mj_sig_ts=1438877147877&amp;mj_sig_rand=-1021590713291627864&amp;mj_sig_play_again=true&amp;mj_sig_analytics_host=analytics.mindjolt.com&amp;mj_sig_analytics_enabled=1&amp;game_key=2JQGBMPPQCKENNHE&amp;game_url=the-word-pyramid&amp;mj_sig_recomendations=1&amp;recommendations_url=http%3A%2F%2Fwww.mindjolt.com%2Fservlet%2FRecommendation%2F%3Fid%3D82203&amp;mj_sig_play_again_ad_id=mj&amp;mj_sig_html_ads=1&amp;mj_sig_force_redraw=1&amp;mj_sig=e7dc1746d87fb8b95d363badd396e60c"></object></div>';

        $this->render('testgame', array());
    }

    public function actionGeoCoordinates($id = NULL) {

        $geoLocation = GeoUtility::GeoLocation();

        if ($geoLocation['isOtherGeoLocationShare']) {
            $this->redirect($this->createUrl("/geocoordinatesshare/{$id}"));
        }

        $this->render('geocoordinates', array('game_id' => $id));
    }

    public function actionGeoCoordinatesShare($id = NULL) {
        $this->render('geocoordinatesShare', array('game_id' => $id));
    }

    public function actionCannotPlay() {
        $this->render('cannotplay', array());
    }

//    public function actionHome() {
//        $validGeoUser = eGeoLocationInfo::model()->findbyAttributes(array('ip_address' => ClientUtility::getClientIpAddress())); //var_dump($validGeoUser);exit;
//        if (!is_null($validGeoUser) && $validGeoUser->is_validlocation == 1) {
//            $this->redirect($this->createUrl('/site/index'));
//        } elseif (!is_null($validGeoUser) && $validGeoUser->is_validlocation == 0 && $validGeoUser->city == 'unknown') {
//            $validGeoUser->delete();
//            $this->redirect($this->createUrl('/geocoordinates'));
//        } else {
//            $this->redirect($this->createUrl('/geocoordinates'));
//        }
//    }

    public function actionAjaxGeoCoordinatesNotPreshare() {
        $user_id = Yii::app()->user->getId();

        $geoLocation = GeoUtility::GeoLocation();

        if ($geoLocation['isExists']) {
            $geoLocationInfo = eGeoLocationInfo::model()->findByPk($geoLocation['geo_id']);
        } else {
            $geoLocationInfo = new eGeoLocationInfo;
        }

        $geoLocationInfo->user_id = $user_id;
        $geoLocationInfo->latitude = 'Not Shared';
        $geoLocationInfo->longitude = 'Not Shared';
        $geoLocationInfo->city = 'unknown';
        $geoLocationInfo->state = 'unknown';
        $geoLocationInfo->ip_address = ClientUtility::getClientIpAddress();
        $geoLocationInfo->is_validlocation = 0;
        $geoLocationInfo->is_preshare = 0;

        $geoLocationInfo->save();
    }

    public function actionAjaxGeoCoordinates() {

        $decodedResultForLatLng = '';
        $user_id = Yii::app()->user->getId();

        $geoLocation = GeoUtility::GeoLocation();

        if ($geoLocation['isExists']) {
            //update old record
            $geoLocationInfo = eGeoLocationInfo::model()->findByPk($geoLocation['geo_id']);
        } else {
            //enter new record
            $geoLocationInfo = new eGeoLocationInfo;
        }

        $positionLat = isset($_POST['lat']) ? $_POST['lat'] : 0;
        $positionLng = isset($_POST['lng']) ? $_POST['lng'] : 0;

        if (!($positionLat == 0) && !($positionLng == 0)) {
            if (isset(Yii::app()->params['GamePlay']['setGeoLocation']) && Yii::app()->params['GamePlay']['setGeoLocation'] == true) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $positionLat . "," . $positionLng . "&key=AIzaSyBqBZAwrI-zhDidCVDtriw1BHrQC9cuTZ4");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($ch);
                curl_close($ch);

                $decodedResultForLatLng = json_decode($response);
                $city = $decodedResultForLatLng->results[0]->address_components[3]->long_name;
                $county = $decodedResultForLatLng->results[0]->address_components[4]->long_name;
                $state = $decodedResultForLatLng->results[0]->address_components[5]->long_name;
                $country = $decodedResultForLatLng->results[0]->address_components[6]->long_name;

                if (in_array($country, Yii::app()->params['GamePlay']['Country'])) {
                    if (in_array($city, Yii::app()->params['GamePlay']['AllowedCity']) || in_array($state, Yii::app()->params['GamePlay']['AllowedState'])) {
                        $geoLocationInfo->is_validlocation = 1;
                        Yii::app()->session['IsValidGeoCode'] = 1;

                        echo json_encode(array('success' => Yii::t('youtoo', 'Bienvenido, este juego está disponible en su estado')));
                    } else {
                        $geoLocationInfo->is_validlocation = 0;

                        echo json_encode(array('error' => Yii::t('youtoo', 'Este juego no está disponible en:California, New Mexico, Louisiana, Massachusetts, Georgia, Montana')));
                    }

                    $geoLocationInfo->user_id = $user_id;
                    $geoLocationInfo->latitude = $positionLat;
                    $geoLocationInfo->longitude = $positionLng;
                    $geoLocationInfo->city = $city;
                    $geoLocationInfo->state = $state;
                    $geoLocationInfo->ip_address = ClientUtility::getClientIpAddress();
                    $geoLocationInfo->is_preshare = 1;
                    $geoLocationInfo->is_share = 1;

                    $geoLocationInfo->save();
                }
            }
        } else {
            $geoLocationInfo->user_id = $user_id;
            $geoLocationInfo->latitude = 'Not Shared';
            $geoLocationInfo->longitude = 'Not Shared';
            $geoLocationInfo->city = 'unknown';
            $geoLocationInfo->state = 'unknown';
            $geoLocationInfo->ip_address = ClientUtility::getClientIpAddress();
            $geoLocationInfo->is_validlocation = 0;
            $geoLocationInfo->is_preshare = 1;

            $geoLocationInfo->save();
        }
    }

    public function actionTestServerLoad() {

        $count = 100;
        for ($i = 1; $i <= $count; $i++) {
            $url[$i] = "https://bousalah.youtoo.com/getsms?destination=" . mt_rand(1, 50) . "&smssender=" . substr(number_format(time() * mt_rand(), 0, '', ''), 0, 12) . "&idlang=1&opid=" . mt_rand(1, 90) . "&smstext=testing" . $i . "&smsid=" . uniqid();
        }

        for ($i = 1; $i <= $count; $i++) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url[$i]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            echo $i . PHP_EOL;
        }
        curl_close($ch);
    }

    public function actionWinners() {
        $this->activeNavLink = 'winners';

        $winners = GameUtility::getWinners();
        $this->render('winners', array('winners' => $winners));
    }

    public function actionFreeCredit() {

        $this->render('freecredit', array());
    }

    public function actionCustomError() {
        $this->render('customerror', array());
    }

    public function actionHowToPlay() {
        $this->activeNavLink = 'howtoplay';

        $this->render('howtoplay', array());
    }

    public function actionConfirmation() {

        $creditId = Yii::app()->session['creditId'];
        $this->render('confirmation', array('creditId' => $creditId));
    }

    public function actionBaldinisContact() {
        $this->render('baldiniscontact', array());
    }

    public function actionPrizes() {
        $this->render('prizes', array());
    }

    public function actionBarcode($id = NULL) {
        require_once('core/protected/vendor/barcodegen/class/BCGFontFile.php');
        require_once('core/protected/vendor/barcodegen/class/BCGColor.php');
        require_once('core/protected/vendor/barcodegen/class/BCGDrawing.php');

        // Including the barcode technology
        require_once('core/protected/vendor/barcodegen/class/BCGcode39.barcode.php');

        // Loading Font
        $font = new BCGFontFile('core/protected/vendor/barcodegen/font/Arial.ttf', 18);

        // Don't forget to sanitize user inputs
        $id = isset($id) ? $id : '1234567890';

        // The arguments are R, G, B for color.
        $color_black = new BCGColor(0, 0, 0);
        $color_white = new BCGColor(255, 255, 255);

        $drawException = null;
        try {
            $code = new BCGcode39();
            $code->setScale(2); // Resolution
            $code->setThickness(30); // Thickness
            $code->setForegroundColor($color_black); // Color of bars
            $code->setBackgroundColor($color_white); // Color of spaces
            $code->setFont($font); // Font (or 0)
            $code->parse($id); // Text
        } catch (Exception $exception) {
            $drawException = $exception;
        }

        /* Here is the list of the arguments
          1 - Filename (empty : display on screen)
          2 - Background color */
        $drawing = new BCGDrawing('', $color_white);
        if ($drawException) {
            $drawing->drawException($drawException);
        } else {
            $drawing->setBarcode($code);
            $drawing->draw();
        }

        // Header that says it is an image (remove it if you save the barcode to a file)
        header('Content-Type: image/png');
        header('Content-Disposition: inline; filename="barcode.png"');

        // Draw (or save) the image into PNG format.
        $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
    }

    public function actionPrintReceipt() {
        $this->layout = NULL;

        $creditTransaction = eCreditTransaction::model()->findByPk(Yii::app()->session['creditId']);
        $prize = ePrize::model()->findByPk($creditTransaction->prize_id);
        $user = eUser::model()->with('userLocations:primary')->findByPk($creditTransaction->user_id);

        unset(Yii::app()->session['paypalTransactionID']);
        unset(Yii::app()->session['creditId']);
        unset(Yii::app()->session['transaction_id']);
        unset(Yii::app()->session['prize_id']);

        $this->render('printReceipt', array(
            'creditTransaction' => $creditTransaction,
            'user' => $user,
            'prize' => $prize,
        ));
    }

    public function actionPayViaPayPal($id = 0, $game_id = NULL) {

        if (!empty($id))
            $prize = ePrize::model()->findByPk($id);
        $total = isset($prize->credits_required) ? $prize->credits_required : 1;

        if ($game_id == NULL) {
            $game = eGameChoice::model()->multiple()->isActive()->with('gameChoiceAnswers')->find();
        } else {
            $game = eGameChoice::model()->multiple()->with('gameChoiceAnswers')->findByPk((int) $game_id);
        }

        $paypal = PaymentUtility::paypal($prize);
        if ($paypal['response'] == 'success') {
            $this->redirect($paypal['url']);
        } else {
            var_dump($paypal);
            //$this->redirect(Yii::app()->createURL('/thanks'));
        }
    }

    public function actionRedeem() {

        $this->redirect($this->createUrl('/site/index'));

        $this->activeNavLink = 'redeem';

        if (isset($_POST['ePrize'])) {
            $this->redirect($this->createUrl('/redeem/' . $_POST['ePrize']['id']));
        }
        $prizes = ePrize::getActivePrizes();
        $this->render('redeem', array('prizes' => $prizes,));
    }

    public function actionRedeemPrize($id = 0) {//start transaction
        //Yii::app()->user->setReturnUrl(Yii::app()->request->getUrl());
        $this->activeNavLink = 'redeem';

        //$prizes = ePrize::getActivePrizes();
        $random_prize = ePrize::getRandomActivePrizes();
        $balance = ClientUtility::getTotalUserBalanceCredits();

        if (!empty($id))
            $prize = ePrize::model()->findByPk($id);

        if (isset($_POST['ePrize'])) {

            if ($balance < $prize->credits_required) {
                Yii::app()->user->setFlash('error', Yii::t('youtoo', Yii::app()->params['flashMessage']['lowCreditBalance']));
                $this->redirect($this->createUrl('/redeem'));
            }
            $user = clientUser::model()->findByAttributes(array('id' => Yii::app()->user->getId()));
            $userLocation = clientUserLocation::model()->findByAttributes(array('user_id' => Yii::app()->user->getId(), 'type' => 'primary'));
            $userLocation = (is_null($userLocation)) ? new clientUserLocation : $userLocation;

            $userEmail = eUserEmail::model()->findByAttributes(array('user_id' => Yii::app()->user->getId()));
            //$user->setScenario('shipping');
//            $userValidate = $user->validate();
//            $userLocation->setScenario('shipping');
//            $userLocationValidate = $userLocation->validate();
//            if (!($userValidate && $userLocationValidate)) {
//                Yii::app()->user->setFlash('error', Yii::t('youtoo', 'Update profile for shipping'));
//                Yii::app()->session['userInfoValidate'] = 'Update profile for shipping';
//                $this->redirect($this->createUrl('user/profile'));
//            }
            $prize = ePrize::model()->findByPk($_POST['ePrize']['id']);
            $creditRequired = $prize->credits_required;

            if ($prize->type == 'video') {
                Yii::app()->session['type'] = "spent";
                Yii::app()->session['prize_id'] = $prize->id;
                Yii::app()->session['credits'] = $creditRequired;
                Yii::app()->session['question_id'] = $prize->question_id;
                $this->redirect($this->createUrl('/video/record'));
            } else if ($prize->type == 'ticker') {
                Yii::app()->session['type'] = "spent";
                Yii::app()->session['prize_id'] = $prize->id;
                Yii::app()->session['credits'] = $creditRequired;
                Yii::app()->session['question_id'] = $prize->question_id;
                $this->redirect($this->createUrl('/ticker'));
            } else {
                $transaction = new eCreditTransaction;
                $transaction->type = "spent";
                $transaction->prize_id = $prize->id;
                $transaction->credits = $creditRequired;
                $transaction->save();

                $prize->quantity = $prize->quantity - 1;
                $prize->save();
            }
            Yii::app()->session['creditId'] = $transaction->id;
            $result = MailUtility::send('confirm', $userEmail->email, array('link' => Yii::app()->createAbsoluteUrl("/", array()), 'prize' => $prize->name, 'credits' => $creditRequired, 'firstname' => isset($user->first_name) ? $user->first_name : 'John', 'lastname' => isset($user->last_name) ? $user->last_name : 'Doe', 'address' => $userLocation->address1, 'city' => $userLocation->city, 'state' => $userLocation->state, 'zipcode' => $userLocation->postal_code, 'image' => Yii::app()->createAbsoluteUrl("/" . basename(Yii::app()->params["paths"]["image"])) . "/{$prize->image}"), false);
            if ($result) {
                $this->redirect($this->createUrl('/site/confirmation'));
            } else {
                $this->redirect($this->createUrl('/site/confirmation'));
            }
        }

        $this->render('redeemPrize', array('prize' => $prize, 'randomprizes' => $random_prize));
    }

    public function actionFAQ() {
        $this->activeNavLink = 'faq';

        $this->render('faq', array());
    }

    public function actionLegallinks() {
        //if ($this->isMobile()) {
        //    Yii::app()->theme = 'mobile';
        //    $this->layout = null;
        //}
        $this->render('legallinks', array());
    }

    public function actionMarketingPage($id = NULL) {
        $this->activeNavLink = 'marketingpage';
        $this->activeSubNavLink = 'marketingpage';

        $game = eGameChoice::model()->findByPk((int) $id);

        $this->render('marketingpage', array('game' => $game));
    }

    public function actionMarketingPage2($id = NULL) {
        $this->activeNavLink = 'marketingpage';
        $this->activeSubNavLink = 'marketingpage2';

        $game = eGameChoice::model()->findByPk((int) $id);

        $this->render('marketingpage2', array('game' => $game));
    }

    public function actionPayAndPlay() {

        $this->render('payandplay', array());
    }

    public function actionNewPayAndPlay() {

        $this->render('newpayandplay', array());
    }

    public function actionHelplinks() {
        //if ($this->isMobile()) {
        //    Yii::app()->theme = 'mobile';
        //    $this->layout = null;
        //}
        $this->render('helplinks', array());
    }

    public function actionAboutlinks() {

        $this->render('aboutlinks', array());
    }

    public function actionMarketinglinks() {

        $this->render('marketinglinks', array());
    }

    public function actionFreePlay() {
        $this->render('freeplay', array());
    }

    public function actionTerms() {
        $this->render('terms', array());
    }

    public function actionPrivacy() {
        $this->render('privacy', array());
    }

    public function actionRules() {
        $this->render('rules', array());
    }

    public function actionIndexlinks() {
        $games = eGameChoice::getAllActiveGames();

        $this->render('indexlinks', array('games' => $games));
    }

}
