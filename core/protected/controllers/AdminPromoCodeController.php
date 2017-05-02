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
                    'copyMonth',
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
            $promo = eFreeCredit::model()->findByPK($id);
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

        $promos = new eFreeCredit('search');//var_dump($programs);exit;
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
        $model->setScenario('copyToNewMonth');
        $userId = Yii::app()->user->getId();
        $userInfo = eUser::model()->findByPK($userId);

        if (isset($_POST['FormPromoCode'])) {
            $model->attributes = $_POST['FormPromoCode'];
            if ($model->validate()) {
                $month = $model->month;
                $newMonthToCopy = $model->new_month;
                $monthNo = date('m', strtotime($month));
                $newMonthNo = date('m', strtotime($newMonthToCopy));
                $currYear = date('Y');
                //if ($currYear >= Yii::app()->params['affidavit'] ['newYear']) {
                if ($newMonthNo > $monthNo && !empty($checkData)) {
                    $result = eProgram::model()->copyToNewMonth($month, $newMonthToCopy);
                    if ($result == true) {
//                        $programupdate = new eProgramUpdatedBy();
//                        $programupdate->user_id = Yii::app()->user->getId();
//                        $programupdate->is_updated = 0;
//                        $programupdate->updated_month = $newMonthToCopy;
//                        $programupdate->created_on = date("Y-m-d H:i:s");
//
//                        if ($programupdate->save()) {
                            Yii::app()->user->setFlash('success', 'Data copied successfully');
                            $this->redirect('/adminAffidavit');
                       // }
                    } else {
                        Yii::app()->user->setFlash('error', 'Cannot copy data. Data cannot be duplicated.');
                        $this->redirect('/adminAffidavit');
                    }
                } else {
                    Yii::app()->user->setFlash('error', 'Cannot copy data. Selected month is either greater than current OR data does not exist for current.');
                    $this->redirect('/adminAffidavit');
                }
//            } else {
//                Yii::app()->user->setFlash('error', 'Cannot copy data. Year needs to be greater than current year.');
//                $this->redirect('/adminAffidavit');
//            }
            }
        }
    }

    public function actionDelete($id = false) {
        if (is_null($id) || !is_numeric($id)) {
            throw new CHttpException(404, 'No id was provided.');
        }

        $program = eProgram::model()->isNotDeleted()->findByPk($id);
        if (!is_null($program)) {
            $program->is_deleted = 1;
            $program->updated_on = new CDbExpression('NOW()');
            $program->save();
            Yii::app()->user->setFlash('success', "Program has been deleted.");
            $this->redirect('/adminAffidavit');
        } else {
            Yii::app()->user->setFlash('success', "Program does not exist.");
            $this->redirect('/adminAffidavit');
        }
    }

}

?>
