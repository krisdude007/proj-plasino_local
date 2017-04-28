<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AdminAffidavitController extends Controller {

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
        $formProgram = new FormProgram;
        if ($id) {
            $user_id = Yii::app()->user->getId();
            $user = eUser::model()->findByPK($user_id);
            $program = eProgram::model()->isNotDeleted()->findByPK($id);
            $program->setScenario('affidavit');
        } else {
            $program = new eProgram;
            $user_id = Yii::app()->user->getId();
            $user = eUser::model()->findByPK($user_id);
            $program->setScenario('new');
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'admin-affidavit-form') {
            echo json_encode(
                    CMap::mergeArray(json_decode(CActiveForm::validate($program), true))
            );
            Yii::app()->end();
        }

        if (isset($_POST['eProgram'])) {
            $program->attributes = $_POST['eProgram'];
            $program->user_id = $user->id;

            $flash = ($user->isNewRecord) ? 'Add' : 'Updat';
            if ($program->validate()) {
                $program->save();
                // TODO: more extensive validation; these extra permissions can only exist for less than super admin and greater than user.

                Yii::app()->user->setFlash('success', "Program {$flash}ed!");
            } else {
                Yii::app()->user->setFlash('error', "Error {$flash}ing Program!");
            }
        }

        $programs = new eProgram('search');//var_dump($programs);exit;
        $programs->unsetAttributes();

        if (isset($_GET['eProgram'])) {
            $programs->attributes = $_GET['eProgram'];
        }

        //$permissions = UserUtility::getAvailablePermissions();
        //$userPermissions = eUserPermission::model()->findAllByAttributes(Array('user_id'=>$id));

        $this->render('index', array(
            'program' => $program,
            'programs' => $programs,
            'formProgram' => $formProgram,
                )
        );
    }

    public function actionCopyMonth() {

        $model = new FormProgram;
        $model->setScenario('copyToNewMonth');
        $userId = Yii::app()->user->getId();
        $userInfo = eUser::model()->findByPK($userId);

        if (isset($_POST['FormProgram'])) {
            $model->attributes = $_POST['FormProgram'];
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
