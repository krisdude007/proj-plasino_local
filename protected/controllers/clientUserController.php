<?php

class clientUserController extends UserController {

    public $activeNavLink = 'account';
    public $activeSubNavLink = 'basicinfo';
    public $userBalance = null;

    function init() {
        parent::init();

        if (!Yii::app()->user->isGuest) {
            $this->user = ClientUtility::getUser();
            $this->userBalance = eCreditBalance::getTotalUserBalance(Yii::app()->user->id);
        }
    }

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('logout', 'login', 'profile', 'credits', 'password', 'paymentinfo', 'photoid', 'connections', 'twitterConnect', 'ajaxTwitterDisconnect', 'ajaxFacebookDisconnect', 'ajaxFacebookConnect', 'paymentinfosaved', 'paymentinfonotsaved', 'settingLinks', 'ajaxPayPalDirect'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('login', 'loginpay', 'activity', 'register', 'registerpay', 'getpassword', 'termsofuse', 'privacypolicy', 'ajaxPayPalDirect', 'registernew', 'loginnew','baldiniscontact', 'rules'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionCredits($id = NULL) {
        $this->activeSubNavLink = 'credits';

        if ($id == NULL) {
                $game = eGameChoice::model()->multiple()->isActive()->with('gameChoiceAnswers')->find();
            } else {
                $game = eGameChoice::model()->multiple()->with('gameChoiceAnswers')->findByPk((int) $id);
            }

        $credits = eCreditTransaction::model()->with('prize')->recent()->findAllByAttributes(array('user_id' => Yii::app()->user->id)); //var_dump($credits);
        $this->render('credits', array('credits' => $credits)
        );
    }

    public function actionProfile() {
        $user_id = Yii::app()->user->getId();
        $user = clientUser::model()->findByPK($user_id);
        $userEmail = clientUserEmail::model()->findByAttributes(array('user_id' => $user->id, 'type' => 'primary'));
        $userEmail = (is_null($userEmail)) ? new clientUserEmail : $userEmail;
        $userLocation = clientUserLocation::model()->findByAttributes(array('user_id' => $user->id, 'type' => 'primary'));
        $userLocation = (is_null($userLocation)) ? new clientUserLocation : $userLocation;

        $user->setScenario('profile');
        $userEmail->setScenario('profile');
        $userLocation->setScenario('profile');

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-profile-form') {
            echo CActiveForm::validate(array($user, $userEmail, $userLocation));
            Yii::app()->end();
        }

        if (isset($_POST['clientUser'], $_POST['clientUserEmail'], $_POST['clientUserLocation'])) {
            $user->attributes = $_POST['clientUser'];
            $userEmail->attributes = $_POST['clientUserEmail'];
            $userEmail->user_id = $user->id;
            $userEmail->type = 'primary';
            $userLocation->attributes = $_POST['clientUserLocation'];
            if (!empty($userLocation))
            $userLocation->user_id = $user->id;

            $userValidate = $user->validate();
            $userLocationValidate = $userLocation->validate();
            $userEmailValidate = $userEmail->validate();
            if ($userValidate && $userEmailValidate && $userLocationValidate) {
                $user->password = '';//var_dump($user);var_dump($userEmail);var_dump($userLocation);exit;
                if($userLocation->type == '')
                $userLocation->type = 'primary';
                $user->save();
                $userEmail->save();
                $userLocation->save();
            }
        }

        if (!empty($_POST) && empty($user->getErrors()) && empty($userLocation->getErrors()) && empty($userEmail->getErrors())) {
            Yii::app()->user->setFlash('success', Yii::t('youtoo', Yii::app()->params['flashMessage']['profileUpdateSuccess']));
            $this->redirect($this->createUrl('/user/profile'));
        }

        $this->render('profile', array(
            'user' => $user,
            'userEmail' => $userEmail,
            'userLocation' => $userLocation,
        ));
    }

    public function actionPassword() {
        $this->activeSubNavLink = 'password';

        $user_id = Yii::app()->user->getId();
        $user = clientUser::model()->findByPK($user_id);

        $user->setScenario('changePassword');

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-password-form') {
            echo CActiveForm::validate(array($user));
            Yii::app()->end();
        }

        if (isset($_POST['clientUser'])) {
            $user->attributes = $_POST['clientUser'];
            if ($user->validate()) {
                $user->password = $user->newPassword;
                if ($user->save()) {
                    Yii::app()->user->setFlash('success', Yii::t('youtoo', 'Password has been reset'));
                    $this->redirect($this->createUrl('/user/password'));
                }
            }
        }

        $this->render('password', array(
            'user' => $user,
        ));
    }

    public function actionLoginOld($id = NULL) {

                if (!Yii::app()->user->isGuest) {
                    $this->redirect($this->createUrl('/user/logout'));
                }
                $this->activeNavLink = 'login';
                $user = new clientUser;

                if ($id == NULL) {
                    $game = eGameChoice::model()->multiple()->isActive()->with('gameChoiceAnswers')->find();
                } else {
                    $game = eGameChoice::model()->multiple()->with('gameChoiceAnswers')->findByPk((int) $id);
                }

                $user->setScenario('login');
                if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-login-form') {
                    echo CActiveForm::validate($user);
                    Yii::app()->end();
                }
                if (isset($_POST['clientUser'])) {
                    $user->attributes = $_POST['clientUser'];
                    if (UserUtility::login($user)) {

                        if (!empty(Yii::app()->user->returnUrl) && Yii::app()->user->returnUrl !== "/") {
                            $this->redirect(Yii::app()->user->returnUrl);
                        }

                            $checkDuplicateEntry = GameUtility::isDuplicateUserGame($user->id, 60);

                            if ($checkDuplicateEntry == FALSE) {

                                if (GameUtility::updateResponseUser(Yii::app()->user->getId())) {

                                }
                            }

                            $this->redirect($this->createUrl('/playnow'));
                            AuditUtility::save($this, $_REQUEST);

                    } else {
                        Yii::app()->user->setFlash('error', Yii::t('youtoo', Yii::app()->params['flashMessage']['loginError']));
                        $this->redirect($this->createUrl('/user/loginnew'));
                    }
                }

        $this->render('login', array('model' => $user,
        ));
    }

    public function actionLogin($id = NULL) {


        if (!Yii::app()->user->isGuest) {
            $this->redirect($this->createUrl('/user/logout'));
        }
        $this->activeNavLink = 'login';
        $user = new clientUser;

        $user->setScenario('login');
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-loginnew-form') {
            echo CActiveForm::validate($user);
            Yii::app()->end();
        }
        if (isset($_POST['clientUser'])) {
            $user->attributes = $_POST['clientUser'];
            if (ClientUserUtility::login($user)) {

                if(!empty(Yii::app()->user->returnUrl) && Yii::app()->user->returnUrl !== "/") {
                    $this->redirect(Yii::app()->user->returnUrl);
                }

                //$geoLocation = GeoUtility::GeoLocation();

                //if(!$geoLocation['isExists']) {
                //    $this->redirect($this->createUrl('/geocoordinates'));
                //}

//                if (is_null($validGeoUser)) {
//                    $this->redirect($this->createUrl('/geocoordinates'));
//                } elseif(!is_null($validGeoUser) && $validGeoUser->is_validlocation == 0 && $validGeoUser->city == 'unknown') {
//                    //Yii::app()->user->setFlash('error', Yii::t('youtoo','Sorry, Either you have not shared your location or your in a location where this game play is not valid. In order to re-share, please reset your location by doing the following.
//                    //    <div><img src="/webassets/images/final_instructions.png"/></div>'));
//                    //$this->redirect($this->createUrl('/geocoordinates'));
//                } elseif (!is_null($validGeoUser) && $validGeoUser->is_validlocation == 0) {
//                    //Yii::app()->user->setFlash('error', Yii::t('youtoo','Este juego no está disponible en:California, Arizona, Louisiana, Massachusetts, Georgia, Montana'));
//                    //$this->redirect($this->createUrl('/site/index'));
//                }

                GameUtility::redirectToGame($this, $id);

                $checkDuplicateEntry = GameUtility::isDuplicateUserGame($user->id, 60);

                if ($checkDuplicateEntry == FALSE) {

                    if (GameUtility::updateResponseUser(Yii::app()->user->getId())) {

                    }
                }
                
                $this->redirect($this->createUrl('/payment?ci=1'));
                AuditUtility::save($this, $_REQUEST);

            } else {
                Yii::app()->user->setFlash('error', Yii::t('youtoo', Yii::app()->params['flashMessage']['loginError']));
                $this->redirect($this->createUrl('/user/login'));
            }
        }

        $this->render('loginnew', array('user' => $user,
                                        'game_url' => '/'.$id,
        ));
    }

    public function actionAjaxPayPalDirect() {

        $paymentInfo = NULL;

        $validateCreditCard = PaymentUtility::luhn_check($_POST['card_number']);
        if (!$validateCreditCard === true) {
            echo json_encode(array('error' => Yii::t('youtoo', 'Invalid Credit Card Number')));
            //$this->redirect($this->createUrl('/user/loginpay'));
        } else {
            $paymentInfo = array('Member' =>
                array(
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'billing_address' => $_POST['street_1'],
                    'billing_address2' => '',
                    'billing_country' => 'United States',
                    'billing_city' => $_POST['city'],
                    'billing_state' => $_POST['state'],
                    'billing_zip' => $_POST['postal_code'],
                ),
                'CreditCard' =>
                array(
                    'card_number' => $_POST['card_number'],
                    'expiration_month' => $_POST['expire_month'],
                    'expiration_year' => $_POST['expire_year'],
                    'cv_code' => $_POST['cvv2'],
                ),
                'Order' =>
                array('theTotal' => $_POST['amount'])
            );

            $transaction = Yii::app()->Paypal->DoDirectPayment($paymentInfo);

            if ($transaction['ACK'] == 'Failure') {
                echo json_encode(array('error' => Yii::t('youtoo', $transaction['L_LONGMESSAGE0'])));
            }

            if ($transaction['ACK'] == 'Success') {
                echo json_encode(array('success' => Yii::t('youtoo', $transaction['ACK'])));
                Yii::app()->session['amount'] = $paymentInfo['Order']['theTotal'];
                Yii::app()->session['paypalTransactionID'] = $transaction['TRANSACTIONID'];
                Yii::app()->session['firstname'] = $paymentInfo['Member']['first_name'];
                Yii::app()->session['lastname'] = $paymentInfo['Member']['last_name'];
                Yii::app()->session['street_1'] = $paymentInfo['Member']['billing_address'];
                Yii::app()->session['city'] = $paymentInfo['Member']['billing_city'];
                Yii::app()->session['state'] = $paymentInfo['Member']['billing_state'];
                Yii::app()->session['postalcode'] = $paymentInfo['Member']['billing_zip'];
            }
        }
    }

    public function actionLoginPay($id = NULL) {
                if (!Yii::app()->user->isGuest) {
                    $this->redirect($this->createUrl('/user/logout'));
                }
                $this->activeNavLink = 'login';
                $user = new clientUser;
                $tw_user = eUserTwitter::model()->findByAttributes(array('user_id' => Yii::app()->user->getId()));

                if ($id == NULL) {
                    $game = eGameChoice::model()->multiple()->isActive()->with('gameChoiceAnswers')->find();
                } else {
                    $game = eGameChoice::model()->multiple()->with('gameChoiceAnswers')->findByPk((int) $id);
                }

                $user->setScenario('loginpay');
                if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-login-register-pay-form') {
                    echo CActiveForm::validate($user);
                    Yii::app()->end();
                }
                if (isset($_POST['clientUser'])) {
                    $user->attributes = $_POST['clientUser'];
                    if (UserUtility::login($user)) {
                        if(GameUtility::updateResponseUser(Yii::app()->user->getId())) {

                        }

                        AuditUtility::save($this, $_REQUEST);

                        if(!is_null(Yii::app()->session['gamechoiceresponseId'])) {
                            $gameChoiceResponseID = Yii::app()->session['gamechoiceresponseId'];
                        } else {
                            $gameChoiceResponseID = 1;
                        }

                        $gameManager = GameUtility::managerPayPlay(Yii::app()->user->getId());

                        if (empty($_POST['stripeToken'])) {
                            $this->redirect($this->createUrl('/site/redeem'));
                        } else {

                            $transactionID = PaymentUtility::stripePaymentGame("game_choice", $gameManager['game_id'], $_POST['stripeToken']);
                            $this->redirect(Yii::app()->createURL("/paymentdone/thankyou/{$transactionID}"));
                        }
                    } else {
                        Yii::app()->user->setFlash('error', Yii::t('youtoo', Yii::app()->params['flashMessage']['loginError']));
                        $this->redirect($this->createUrl('/user/loginpay'));
                    }
                }

        $this->render('loginpay', array('model' => $user, 'type' => 'l'));
    }

    public function actionLogout() {
        if (!Yii::app()->user->isGuest) {
            UserUtility::logout();
        }
        $this->redirect($this->createUrl('/user/login'));
    }

    public function actionRegisterOld($id = NULL) {
        $this->activeNavLink = 'register';
        $user = new clientUser;
        $userEmail = new clientUserEmail;
        $userLocation = clientUserLocation::model()->findByAttributes(array('user_id' => Yii::app()->user->getId()));
        $userLocation = (is_null($userLocation)) ? new clientUserLocation : $userLocation;

        if ($id == NULL) {
            $game = eGameChoice::model()->multiple()->isActive()->with('gameChoiceAnswers')->find();
        } else {
            $game = eGameChoice::model()->multiple()->with('gameChoiceAnswers')->findByPk((int) $id);
        }

        $user->setScenario('register');
        $userEmail->setScenario('register');
        $userLocation->setScenario('register');

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-register-form') {
            echo CActiveForm::validate(array($user));
            Yii::app()->end();
        }

        if (isset($_POST['clientUser'])) {
            $user->attributes = $_POST['clientUser'];
            $user->birthday = '0000-00-00';
            $user->source = 'web';
            $user->gender = '';
            $user->first_name = '';
            $user->last_name = '';
            $user->terms_accepted = 1;

            if (ClientUserUtility::register($user)) {
                $userEmail->user_id = $user->id;
                $userEmail->email = $user->username;
                $userEmail->type = 'primary';
                $userEmail->active = 1;
                $userEmail->save();

                $userLocation->user_id = $user->id;
                $userLocation->city = ' ';
                $userLocation->type = 'primary';
                $userLocation->save();

                $user->password = $_POST['clientUser']['password'];
                $user->setScenario('login');
                UserUtility::login($user);

                    if ($game && !is_null(Yii::app()->session['gamechoiceresponseId'])) {
                        $gameresponse = eGameChoiceResponse::model()->findByPK(Yii::app()->session['gamechoiceresponseId']);
                        $gameresponseuser_id = Yii::app()->user->getId();
                        $gameresponseuser = clientUser::model()->findByPk($gameresponseuser_id);
                        $gameresponse->user_id = isset($gameresponseuser->id) ? $gameresponseuser->id : $user->id;
                        if ($gameresponse->validate()) {
                            $gameresponse->update(array('user_id'));
                        }
                    } else {
                        $this->redirect($this->createUrl('site/index'));
                    }

                    AuditUtility::save($this, $_REQUEST);

                    if (isset(Yii::app()->session['return']) && Yii::app()->session['return'] == "actel/payment") {
                        Yii::app()->session['return'] = null;
                        $this->redirect($this->createUrl('site/index'));
                    } else {
                        Yii::app()->session['return'] = null;
                        $this->redirect($this->createUrl('site/index'));
                    }
                }
            }
        $this->render('login', array(
            'model' => $user,
        ));
    }

    public function actionRegister($id = NULL) {
        $this->activeNavLink = 'register';

        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->createURL('site/index'));
        }
        $user = new clientUser;
        $userEmail = new clientUserEmail;
        $userLocation = clientUserLocation::model()->findByAttributes(array('user_id' => Yii::app()->user->getId()));
        $userLocation = (is_null($userLocation)) ? new clientUserLocation : $userLocation;

        $user->setScenario('register');
        $userEmail->setScenario('register');
        $userLocation->setScenario('register');

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-registernew-form') {
            echo CActiveForm::validate(array($user, $userLocation));
            Yii::app()->end();
        }
        if (isset($_POST['clientUser'], $_POST['clientUserLocation'])) {
            $user->attributes = $_POST['clientUser'];
            $userLocation->attributes = $_POST['clientUserLocation'];
            $user->birthday = '0000-00-00';
            if($this->isMobile()) {
                $user->source = 'mobile';
            }
            $user->source = 'web';
            $user->gender = '';

            if (ClientUserUtility::register($user)) {
                $userEmail->user_id = $user->id;
                $userEmail->email = $user->username;
                $userEmail->type = 'primary';
                $userEmail->active = 1;
                $userEmail->save();

                $userLocation->user_id = $user->id;
                $userLocation->city = ' ';
                $userLocation->type = 'primary';
                $userLocation->save();

                $user->password = $_POST['clientUser']['password'];
                $user->setScenario('login');
                UserUtility::login($user);

                $settings = eAppSetting::model()->active()->findAll();
                foreach ($settings as $k => $v) {
                    $pageSettings[$v->attribute] = $v->value;
                }

                if(!empty($pageSettings['game_free_credit_on_reg']) && $pageSettings['game_free_credit_on_reg'] == 1) {
                    $transaction = new eTransaction;
                    $transaction->user_id = Yii::app()->user->getId();
                    $transaction->processor = 'credit';
                    $transaction->response = 'credit';
                    $transaction->item = 'prepay';
                    $transaction->item_id = 1;
                    $transaction->description = 'prepay';
                    $transaction->price = 1;
                    $transaction->save();

                    $creditTransaction = new eCreditTransaction;
                    $creditTransaction->game_type = "sweepstakes";
                    $creditTransaction->type = "earned";
                    $creditTransaction->credits = 1;
                    $creditTransaction->trans_id = $transaction->id;
                    $creditTransaction->save();
                }

                $result = MailUtility::send('welcome', $userEmail->email, array('link' =>Yii::app()->createAbsoluteUrl("/", array()),'storelink' => Yii::app()->createAbsoluteUrl("/payment?ci=1", array())), false);
                if($result) {
                    AuditUtility::save($this, $_REQUEST);

                    GameUtility::redirectToGame($this, $id);

                    $this->redirect(Yii::app()->createURL('site/index'));
                }
            }
        }
        $this->render('registernew', array(
            'user' => $user,
            'userEmail' => $userEmail,
            'userLocation' => $userLocation,
        ));
    }

    public function actionRegisterPay($id = NULL) {
        $twitterSession = Yii::app()->session['twitter'];
        $this->activeNavLink = 'register';
        $user = new clientUser;
        $userEmail = new clientUserEmail;
        $userLocation = clientUserLocation::model()->findByAttributes(array('user_id' => Yii::app()->user->getId()));
        $userLocation = (is_null($userLocation)) ? new clientUserLocation : $userLocation;

        if ($id == NULL) {
            $game = eGameChoice::model()->multiple()->isActive()->with('gameChoiceAnswers')->find();
        } else {
            $game = eGameChoice::model()->multiple()->with('gameChoiceAnswers')->findByPk((int) $id);
        }

        $user->setScenario('register');
        $userEmail->setScenario('register');
        $userLocation->setScenario('register');

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-login-register-pay-form') {
            echo CActiveForm::validate(array($user));
            Yii::app()->end();
        }

        if (isset($_POST['clientUser'])) {
            $user->attributes = $_POST['clientUser'];
            $user->birthday = '0000-00-00';
            $user->source = 'web';
            $user->gender = '';
            $user->first_name = '';
            $user->last_name = '';
            $user->terms_accepted = 1;

            if (ClientUserUtility::register($user)) {
                $userEmail->user_id = $user->id;
                $userEmail->email = $user->username;
                $userEmail->type = 'primary';
                $userEmail->active = 1;
                $userEmail->save();

                $userLocation->user_id = $user->id;
                $userLocation->city = ' ';
                $userLocation->type = 'primary';
                $userLocation->save();

                $user->password = $_POST['clientUser']['password'];
                $user->setScenario('login');
                if (UserUtility::login($user)) {



                    if ($game && !is_null(Yii::app()->session['gamechoiceresponseId'])) {
                        $gameresponse = eGameChoiceResponse::model()->findByPK(Yii::app()->session['gamechoiceresponseId']);
                        $gameresponseuser_id = Yii::app()->user->getId();
                        $gameresponseuser = clientUser::model()->findByPk($gameresponseuser_id);
                        $gameresponse->user_id = isset($gameresponseuser->id) ? $gameresponseuser->id : $user->id;
                        if ($gameresponse->validate()) {
                            $gameresponse->update(array('user_id'));
                        }
                    }

                    AuditUtility::save($this, $_REQUEST);

                    if(!is_null(Yii::app()->session['gamechoiceresponseId'])) {
                        $gameChoiceResponseID = Yii::app()->session['gamechoiceresponseId'];
                    } else {
                        $gameChoiceResponseID = 1;
                    }

                    $gameManager = GameUtility::managerPayPlay(Yii::app()->user->getId());

                    if (empty($_POST['stripeToken'])) {
//                        if (isset(Yii::app()->session['paypalTransactionID']) && !Yii::app()->session['paypalTransactionID'] == NULL) {
//                            $transactionID = PaymentUtility::paypalDirectPayGame("game_choice", $gameManager['game_id'], Yii::app()->session['paypalTransactionID']);
//                            $userInfo = ClientUserUtility::addUserInfo(Yii::app()->user->getId());
//                            $this->redirect(Yii::app()->createURL("/paymentdone/thankyou/{$transactionID}"));
//                        }
                        $this->redirect($this->createUrl('/site/redeem'));
                    } else {
                        $transactionID = PaymentUtility::stripePaymentGame("game_choice", $gameManager['game_id'], $_POST['stripeToken']);
                        $this->redirect(Yii::app()->createURL("/paymentdone/thankyou/{$transactionID}"));

                    }
                } else {
                    Yii::app()->user->setFlash('error', Yii::t('youtoo', Yii::app()->params['flashMessage']['loginError']));
                    $this->redirect($this->createUrl('/user/loginpay'));
                }
            }
        }
        $this->render('loginpay', array(
            'model' => $user,
            'type' => 'r'
                //'userEmail' => $userEmail,
                //'userLocation' => $userLocation,
        ));
    }

    public function actionGetPassword($key = false) {//var_dump($key);exit;
        if (!$key) {
            $model = new clientUser;
            $model->setScenario('getpassword');
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-retrieve-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            if (isset($_POST['clientUser'])) {
                $model->attributes = $_POST['clientUser'];
                if ($model->validate()) {
                    $userRecord = $model->findByAttributes(array('username' => $model->username));
                    if (!empty($userRecord)) {
                        $userEmail = eUserEmail::model()->findByAttributes(array('user_id' => $userRecord->id));
                        $reset = new eUserReset;
                        $reset->user_id = $userRecord->id;
                        $reset->key = sha1(uniqid());
                        $reset->expired = 0;
                        if ($reset->save()) {
                            $result = MailUtility::send('password', $userEmail->email, array('link' => Yii::app()->createAbsoluteUrl("getpassword/{$reset->key}", array())), false);
                            if ($result) {
                                Yii::app()->user->setFlash('success', Yii::t('youtoo',Yii::app()->params['flashMessage']['resetPasswordSuccess']));
                            } else {
                                Yii::app()->user->setFlash('error', Yii::t('youtoo',Yii::app()->params['flashMessage']['resetPasswordError']));
                            }
                        } else {
                            Yii::app()->user->setFlash('error', Yii::t('youtoo',Yii::app()->params['flashMessage']['resetPasswordError']));
                        }
                    } else {
                        Yii::app()->user->setFlash('error', Yii::t('youtoo',Yii::app()->params['flashMessage']['resetPasswordError']));
                    }
                }
            }
            $this->render('getpassword', array('model' => $model));
        } else {
            if ($reset = eUserReset::model()->active()->findByAttributes(array('key' => $key, 'expired' => 0))) {
                $reset->expired = 1;
                $reset->save();
                $user = clientUser::model()->findByPK($reset->user_id);
                $user->scenario = 'reset';
                if (UserUtility::login($user)) {
                    $this->redirect(array('/user/password', 'reset' => 'password'));
                } else {
                    $this->redirect('/login');
                }
            } else {
                $this->redirect(Yii::app()->createUrl('/user/login'));
            }
        }
    }
    
        public function actionActivity() {
        $this->activeSubNavLink = 'activity';
        
        $userId = Yii::app()->user->getId();
        if(!empty($_GET['userid'])){
            $userId = $_GET['userid'];
        }
        
        $gameHistory = GameUtility::getGameHistory($userId);//var_dump($gameHistory);exit;
        
        for ($i = 0; $i < count($gameHistory); $i++) {
            
            $total = GameUtility::getNoOfCorrectAnswersByGameId ($gameHistory[$i]['gameId']);//var_dump($total);exit;
            $gameHistory[$i]['NoOfCorrectAnswers'] = $total;
            if (is_null($gameHistory[$i]['BonusCredits'])) {
                $gameHistory[$i]['NoOfCorrectAnswers'] = 'Pending';
                //var_dump($gameHistory[$i]['NoOfQuestions']);
                $gameHistory[$i]['BonusCredits'] = 'upto '.GameUtility::getBonusCredit($gameHistory[$i]['NoOfQuestions'], $gameHistory[$i]['NoOfQuestions']);
            }
        }//exit;
        //$activityResults = GameUtility::getActivity(Yii::app()->user->getId());
        
        $this->render('activity', array('gameHistory' => $gameHistory)
        );
    }

        public function actionConnections() {
        $this->activeSubNavLink = 'connections';
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->createURL('site/index'));
        }
        $user_id = Yii::app()->user->getId();
        $user = eUser::model()->with('userFacebooks', 'userTwitters')->findByPK($user_id);
        if (isset($user->userFacebooks[0]->access_token) && $user->userFacebooks[0]->access_token) {
            Yii::app()->facebook->setAccessToken($user->userFacebooks[0]->access_token);
            $facebook = Yii::app()->facebook->api('/me');
        }
        if (isset($user->userTwitters[0]->oauth_token) && $user->userTwitters[0]->oauth_token) {
            $twitter = Yii::app()->twitter->getTwitterTokened($user->userTwitters[0]->oauth_token, $user->userTwitters[0]->oauth_token_secret);
            $twuser = $twitter->get("account/verify_credentials");
        }
        $this->render('connections', array(
            'user' => $user,
            'facebook' => isset($facebook) ? $facebook : false,
            'twuser' => isset($twuser) ? $twuser : false,
                )
        );
    }

    public function actionTwitterConnect() {
        $twitter = Yii::app()->twitter->getTwitter();
        if (empty($_REQUEST['oauth_token'])) {
            $request_token = $twitter->getRequestToken('http://' . $_SERVER['HTTP_HOST'] . '/user/twitterConnect');
            if ($twitter->http_code == 200) {
                $url = $twitter->getAuthorizeURL($request_token);
                $this->redirect($url);
            }
        } else {
            $twitter = Yii::app()->twitter->getTwitterTokened($_REQUEST['oauth_token'], Yii::app()->twitter->consumer_secret);
            $access_token = $twitter->getAccessToken($_REQUEST['oauth_verifier']);
            if (200 == $twitter->http_code) {
                Yii::app()->session['status'] = 'verified';
                $twitter = Yii::app()->twitter->getTwitterTokened($access_token['oauth_token'], $access_token['oauth_token_secret']);
                $twuser = $twitter->get("account/verify_credentials");

                if (!$twitter = eUserTwitter::model()->findByAttributes(array('user_id' => Yii::app()->user->getId()))) {
                    $twitter = new eUserTwitter; //only insert when user_twitter not found.
                }
                $twitter->user_id = Yii::app()->user->getId();
                $twitter->twitter_user_id = $twuser->id;
                $twitter->oauth_token = $access_token['oauth_token'];
                $twitter->oauth_token_secret = $access_token['oauth_token_secret'];
                try {
                    $twitter->save();
                } catch (Exception $e) {
                    $existingUserInfo = eUserTwitter::model()->findByAttributes(array('twitter_user_id' => $twuser->id));
                    $existingUserName = eUser::model()->findByAttributes(array('id' => $existingUserInfo->user_id));
                    $this->render('_twitter', Array('connected' => true));
                    Yii::app()->user->setFlash('error', Yii::t('youtoo','You have already connected this twitter account to another user ' . $existingUserName->username . '. Please login as that user or disconnect from there.'));
                    Yii::app()->end();
                }
            }
            $this->render('_twitter', Array('connected' => true));
        }
    }

    public function actionBaldinisContact() {
        $this->render('baldiniscontact', array());
    }

    public function actionAjaxTwitterDisconnect() {
        $twitter = eUserTwitter::model()->deleteAllByAttributes(array('user_id' => Yii::app()->user->getId()));
    }

    public function actionTermsOfUse() {
        $this->render('termsofuse', array());
    }

    public function actionRules() {
        $this->render('rules', array());
    }

    public function actionPrivacyPolicy() {
        $this->render('privacypolicy', array());
    }

    public function actionSettinglinks() {
        $this->render('settingLinks', array());
    }

}
