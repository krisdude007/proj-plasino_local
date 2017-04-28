<?php

class clientActelController extends ActelController {
    public $layout = '//layouts/main';
    public $user;
    public $activeNavLink = 'pay';

    /**
     * Anything required on every page should be loaded here
     * and should also be made a class member.
     */
    public function goToLogin() {
        $this->redirect($this->createUrl('/user/login'));
    }

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('getsms', 'getuserstatus', 'ajaxGetPinCode', 'index', 'otp', 'twittererror'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('payment', 'paymentthankyou', 'paymentsaved', 'thankyou', 'sorry'),
                'users' => array('@'),
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

    public function actionThankYou($id = NULL) {

        if ($id == NULL) {
            $game = eGameChoice::model()->multiple()->isActive()->with('gameChoiceAnswers')->find();
        } else {
            $game = eGameChoice::model()->multiple()->with('gameChoiceAnswers')->findByPk((int) $id);
        }

        $response = 'Demo Twitter Pay';
        $url = 'demofortwitterdotcom';
        $price = 5;
        $country = 'USA';
        $operator = 'Youtoo Demo';

        $transaction = new eGamingTransaction();

        $user = ClientUtility::getUser();
        $transaction->user_id = isset($user->id) ? $user->id : 0;
        $transaction->processor = 'Demo Pay For Twitter';
        $transaction->game_choice_id = $game->id;
        $transaction->response = $response;

        $transaction->request = $url;
        $transaction->description = 'This is just for demo purposes.';
        $transaction->price = $price;
        $transaction->country = $country;
        $transaction->operator = $operator;
        $transaction->created_on = new CDbExpression('NOW()');

        if ($transaction->validate()) {
            if ($transaction->save()) {

                $credittransaction = new eCreditTransaction;
                $credittransaction->game_type = "game_choice";
                $credittransaction->game_id = $game->id;
                $credittransaction->type = "earned";

                $credittransaction->credits = 10;
                $credittransaction->save();

                $gamechoiceresponseId = Yii::app()->session['gamechoiceresponseId']; //var_dump(Yii::app()->session['gamechoiceresponseId']);exit;
                $gameresponse = eGameChoiceResponse::model()->findByPK($gamechoiceresponseId);
                if (!empty($gameresponse)) {
                    $gameresponse->transaction_id = $transaction->id;
                    $gameresponse->save();
                }
            }
        }

        $this->render('thankyou', array(
            'game' => $game,
        ));
    }

    public function actionPaymentThankYou($id = NULL) {

        $this->render('payment_thankyou', array(
        ));
    }

    public function actionPaymentSaved($id = NULL, $play = 1) {
        $user_id = Yii::app()->user->getId();
        $location = clientUserLocation::model()->findByAttributes(array('user_id' => $user_id));

        if ($id == NULL) {
            $game = eGameChoice::model()->multiple()->isActive()->with('gameChoiceAnswers')->find();
        } else {
            $game = eGameChoice::model()->multiple()->with('gameChoiceAnswers')->findByPk((int) $id);
        }

//        $transaction = new eCreditTransaction;
//        $transaction->game_type = "game_choice";
//        $transaction->game_id = $game->id;
//        $transaction->type = "earned";
//
//        $transaction->credits = 10;
//        $transaction->save();

        $this->render('payment_saved', array(
            'location' => $location,
        ));
    }

    public function actionSorry($id = NULL) {

        if ($id == NULL) {
            $game = eGameChoice::model()->multiple()->isActive()->with('gameChoiceAnswers')->find();
        } else {
            $game = eGameChoice::model()->multiple()->with('gameChoiceAnswers')->findByPk((int) $id);
        }

        $response = 'Demo Twitter Pay';
        $url = 'demofortwitterdotcom';
        $price = 5;
        $country = 'USA';
        $operator = 'Youtoo Demo';

        $transaction = new eGamingTransaction();

        $user = ClientUtility::getUser();
        $transaction->user_id = isset($user->id) ? $user->id : 0;
        $transaction->processor = 'Demo Pay For Twitter';
        $transaction->game_choice_id = $game->id;
        $transaction->response = $response;

        $transaction->request = $url;
        $transaction->description = 'This is just for demo purposes.';
        $transaction->price = $price;
        $transaction->country = $country;
        $transaction->operator = $operator;
        $transaction->created_on = new CDbExpression('NOW()');

        if ($transaction->validate()) {
            if ($transaction->save()) {

                $credittransaction = new eCreditTransaction;
                $credittransaction->game_type = "game_choice";
                $credittransaction->game_id = $game->id;
                $credittransaction->type = "earned";

                $credittransaction->credits = 10;
                $credittransaction->save();

                $gamechoiceresponseId = Yii::app()->session['gamechoiceresponseId']; //var_dump(Yii::app()->session['gamechoiceresponseId']);exit;
                $gameresponse = eGameChoiceResponse::model()->findByPK($gamechoiceresponseId);
                if (!empty($gameresponse)) {
                    $gameresponse->transaction_id = $transaction->id;
                    $gameresponse->save();
                }
            }
        }

        $this->render('sorry', array(
            'game' => $game,
        ));
    }

    public function actionPayment($id = NULL, $save = 0, $play = 1) {

        if ($id == NULL) {
            $game = eGameChoice::model()->multiple()->isActive()->with('gameChoiceAnswers')->find();
        } else {
            $game = eGameChoice::model()->multiple()->with('gameChoiceAnswers')->findByPk((int) $id);
        }

        $user_id = Yii::app()->user->getId();
        $user = clientUser::model()->findByPk($user_id);
        $location = clientUserLocation::model()->findByAttributes(array('user_id' => $user_id));
        $location = (is_null($location)) ? new clientUserLocation : $location;
        $tw_user = eUserTwitter::model()->findByAttributes(array('user_id' => $user_id));

        if (!empty($location)) {
            $user->setScenario('payment');
            $location->setScenario('payment');
        } else {
            $user->setScenario('profile');
            $location->setScenario('profile');
        }

        if (!empty($_POST)) {
            if (!empty($_POST['twitter_pay'])) {

                if (!empty($tw_user)) {
                    $tw_user->authorize_pay = 1;
                    if ($tw_user->validate()) {
                        $tw_user->save();
                    }
                }

                if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-payment-form') {
                    echo CActiveForm::validate(array($user, $location));
                    Yii::app()->end();
                }

                if (isset($_POST['clientUser'], $_POST['clientUserLocation'])) {
                    $user->attributes = $_POST['clientUser'];
                    $location->attributes = $_POST['clientUserLocation'];
                    //$card = substr($location->card, -4);
                    //$location->card = 'XXXX-XXXX-XXXX-' . $card;

                    if ($user->validate() && $location->validate()) {
                        $user->password = '';
                        $user->save();
                        $location->user_id = $user->id;
                        $location->type = 'primary';
                        $location->save();
                    }
                }
                if ($play == 1) {
                    $answers = eGameChoiceResponse::model()->recent()->findByAttributes(array('game_choice_id' => $game->id, 'user_id' => $user_id));
                    $isCorrectAnswer = false;

                    if ($answers) {
                        if ($answers->game_choice_answer_id == $game->gameChoiceAnswers[0]->id) {
                            $isCorrectAnswer = true;
                        }
                    }

                    if ($isCorrectAnswer) {
                        $this->redirect($this->createUrl('/actel/thankyou'));
                    } else {
                        $this->redirect($this->createUrl('/actel/sorry'));
                    }
                } else {
                    $this->redirect($this->createUrl('/actel/paymentthankyou'));
                }
            } else {

                if (!empty($tw_user)) {
                    $tw_user->authorize_pay = 0;
                    if ($tw_user->validate()) {
                        $tw_user->save();
                    }
                }

                if ($save == 1) {
                    $this->redirect($this->createUrl('/actel/paymentthankyou'));
                }

                $this->redirect($this->createUrl('/actel/paymentthankyou'));
            }
        }

        if ($save == 1) {
            $this->render('payment_saved', array(
                'model' => $tw_user,
                'user' => $user,
                'location' => $location,
            ));
        } else {
            $this->render('payment', array(
                'user' => $user,
                'model' => $tw_user,
                'location' => $location,
            ));
        }
    }

    public function actionTwitterError() {

        $this->render('twittererror', array(
        ));
    }

}

?>
