<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AdminPromoCodeController extends Controller {

    public $user;
    public $notification;
    public $layout = '//layouts/admin';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array(
                    'index',
                    'delete',
                    'affidavit',
                    'newpromo',
                    'ajaxgeneratenewpromo',
                ),
                'expression' => "(Yii::app()->user->isSuperAdmin() || Yii::app()->user->isSiteAdmin() || Yii::app()->user->hasPermission('adminuser'))",
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    function init() {
        parent::init();
        Yii::app()->setComponents(array('errorHandler' => array('errorAction' => 'admin/error',)));
        $this->user = ClientUtility::getUser();
        $this->notification = eNotification::model()->orderDesc()->findAllByAttributes(array('user_id' => Yii::app()->user->id));
    }

    public function actionIndex($id = false) {
        $formPromo = new FormPromoCode;
        if ($id) {
            $user_id = Yii::app()->user->getId();
            $user = eUser::model()->findByPK($user_id);
            $promo = eFreeCredit::model()->isNotDeleted()->findByPK($id);
            $promo->setScenario('promocode');
        } else {
            $promo = new eFreeCredit;
            $user_id = Yii::app()->user->getId();
            $user = eUser::model()->findByPK($user_id);
            $promo->setScenario('new');
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'admin-promocode-form') {
            echo json_encode(
                    CMap::mergeArray(json_decode(CActiveForm::validate($promo), true))
            );
            Yii::app()->end();
        }

        if (isset($_POST['eFreeCredit'])) {
            $promo->attributes = $_POST['eFreeCredit'];
            $promo->user_id = $user->id;

            $flash = ($user->isNewRecord) ? 'Add' : 'Updat';
            if ($promo->validate()) {
                $promo->save();
                // TODO: more extensive validation; these extra permissions can only exist for less than super admin and greater than user.

                Yii::app()->user->setFlash('success', "Promo {$flash}ed!");
            } else {
                Yii::app()->user->setFlash('error', "Error {$flash}ing Promo!");
            }
        }

        $promos = new eFreeCredit('search'); //var_dump($programs);exit;
        $promos->unsetAttributes();

        if (isset($_GET['eFreeCredit'])) {
            $promos->attributes = $_GET['eFreeCredit'];
        }

        //$permissions = UserUtility::getAvailablePermissions();
        //$userPermissions = eUserPermission::model()->findAllByAttributes(Array('user_id'=>$id));

        $this->render('index', array(
            'promo' => $promo,
            'promos' => $promos,
            'formPromo' => $formPromo,
                )
        );
    }

    public function actionNewPromo() {

        $model = new FormPromoCode;
        $model->setScenario('newpromocode');
        $userId = Yii::app()->user->getId();
        $userInfo = eUser::model()->findByPK($userId);
        
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'new-promocode-form') {
            echo json_encode(
                    CMap::mergeArray(json_decode(CActiveForm::validate($model), true))
            );
            Yii::app()->end();
        }
        
        if (isset($_POST['FormPromoCode'])) {
            $model->attributes = $_POST['FormPromoCode'];
            $model->start_date = empty($model->start_date) ? date('Y-m-d h:i:s') : date('Y-m-d h:i:s', strtotime($model->start_date));
            $model->end_date = empty($model->end_date) ? date('Y-m-d h:i:s', strtotime("+ 1 day")) : date('Y-m-d h:i:s', strtotime($model->end_date));
            
            if ($model->validate()) {
//                $criteria = new CDbCriteria;
//                $criteria->select = 'distinct t.username';
                $allUsers = eUser::model()->recent()->findAll(); //var_dump($allUsers->username);exit;
                foreach ($allUsers as $au) {
                    $existingPromo = eFreeCredit::model()->findByAttributes(array('user_email' => $au->username));
                    if (!is_null($existingPromo)) {
                        $existingPromo->freecredit_key = $model->freecredit_key;
                        $existingPromo->freecredit_price = $model->freecredit_price;
                        $existingPromo->start_date = $model->start_date;
                        $existingPromo->end_date = $model->end_date;
                        $existingPromo->code_update_count += 1;
                        $existingPromo->code_added_by = $userId;
                        $existingPromo->is_code_used = 0;
                        $existingPromo->code_used_by = '';
                        $existingPromo->updated_on = new CDbExpression('NOW()');
                        if ($existingPromo->validate()) {
                            //$existingPromo->save();
                            $existingPromo->update(array('freecredit_key', 'freecredit_price', 'start_date', 'end_date', 'code_update_count', 'code_added_by', 'code_added_by', 'is_code_used', 'code_used_by'));
                        }
                        $result = true;
                    } else {
                        $promo = new eFreeCredit;
                        $promo->user_id = $au->id;
                        $promo->freecredit_key = $model->freecredit_key;
                        $promo->freecredit_price = $model->freecredit_price;
                        $promo->user_email = $au->username;
                        $promo->start_date = $model->start_date;
                        $promo->end_date = $model->end_date;
                        $promo->code_update_count += 1;
                        $promo->code_added_by = $userId;
                        $promo->is_code_used = 0;
                        $promo->code_used_by = '';
                        if ($promo->validate()) {
                            $promo->save();
                        }
                        $result = true;
                    }

                    //more code for creating promocodes before sending out emails.
//                if ($result == true) {
//                $result = MailUtility::send('welcome', $au->email, array('link' => Yii::app()->createAbsoluteUrl("/", array()), 'promo' => isset($existingPromo->freecredit_key) ? $existingPromo->freecredit_key : $promo->freecredit_key), false);
//                }
                }
                Yii::app()->user->setFlash('success', 'Promo Code Generated successfully & sent to all users.');
                $this->redirect('/adminPromoCode');
            }
        }
    }

    public function actionAjaxGenerateNewPromo() {
        if ($_POST['promo'] == true) {
            echo json_encode(array('success' => substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), -6)));
        }
    }

    public function actionDelete($id = false) {
        if (is_null($id) || !is_numeric($id)) {
            throw new CHttpException(404, 'No id was provided.');
        }

        $promo = eFreeCredit::model()->isNotDeleted()->findByPk($id);
        if (!is_null($promo)) {
            $promo->is_deleted = 1;
            $promo->updated_on = new CDbExpression('NOW()');
            $promo->save();
            Yii::app()->user->setFlash('success', "Promo has been deleted.");
            $this->redirect('/adminPromoCode');
        } else {
            Yii::app()->user->setFlash('success', "Promo does not exist.");
            $this->redirect('/adminPromoCode');
        }
    }

}

?>
