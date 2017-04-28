<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AdminAffidavitReportController extends Controller {

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
                    'reportbymonth',
                    'reportbystation',
                    'reportbymonthandstation',
                    'getreportall',
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

    public function actionIndex($month = false) {
        $formProgramMonth = new FormProgramMonth;
        $user_id = Yii::app()->user->getId();
        $user = eUser::model()->findByPK($user_id);

        $programs = eProgram::model()->findAllByAttributes(array('aired_month' => $month));

        $this->render('index', array(
            'user' => $user,
            'programs' => $programs,
            'formProgramMonth' => $formProgramMonth,
            //'formProgramMonthStation' => $formProgramMonthStation,
                )
        );
    }

    public function actionReportByMonth() {
        $model = new FormProgramMonth;
        $model->setScenario('reportm');

        if (isset($_POST['FormProgramMonth'])) {
            $model->attributes = $_POST['FormProgramMonth'];
            if ($model->validate()) {
                $now = gmdate("D, d M Y H:i:s");
                header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
                header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
                header("Last-Modified: {$now} GMT");
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header("Content-Disposition: attachment;filename=AffidavitReportByMonth-$userInfo->username.csv");
                header("Content-Transfer-Encoding: binary");
                $headerArray = array('Station', 'Program', 'User ID', 'Aired?', 'Aired Time', 'Aired Day', 'Aired Month', 'Date Created');

                $programs = eProgram::getAllProgramsByMonth($model->month);

                $df = fopen("php://output", 'w');
                fputcsv($df, $headerArray);

                foreach ($programs as $program) {
                    $station = $program->station;
                    $dailyprogram = $program->program_name;
                    $userId = $program->user_id;
                    $aired = (isset($program->aired) && $program->aired == 1) ? 'Yes' : 'No';
                    $airTimeHour = substr($program->air_time, 0, 1) + 12;
                    $airTimeHour = "$airTimeHour" . ":00";
                    $airTime = date('g:i A', strtotime($airTimeHour));
                    $airedDay = $program->aired_day;
                    $airedMonth = $program->aired_month;
                    $createdOn = date('Y/m/d', strtotime($program->created_on));

                    $row = array($station, $dailyprogram, $userId, $aired, $airTime, $airedDay, $airedMonth, $createdOn);
                    fputcsv($df, $row);
                }
                fclose($df);
            }
        }
    }

    public function actionReportByStation() {

        if (isset($_POST['user'])) {
            $userId = $_POST['user'];
            $userInfo = eUser::model()->findByPK($userId);

            $now = gmdate("D, d M Y H:i:s");
            header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
            header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
            header("Last-Modified: {$now} GMT");
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header("Content-Disposition: attachment;filename=AffidavitReportByStation-$userInfo->username.csv");
            header("Content-Transfer-Encoding: binary");
            $headerArray = array('Station', 'Program', 'User ID', 'Aired?', 'Aired Time', 'Aired Day', 'Aired Month', 'Date Created');

            $programs = eProgram::getAllProgramsByStation($userInfo->username);

            $df = fopen("php://output", 'w');
            fputcsv($df, $headerArray);

            foreach ($programs as $program) {
                $station = $program->station;
                $dailyprogram = $program->program_name;
                $userId = $program->user_id;
                $aired = (isset($program->aired) && $program->aired == 1) ? 'Yes' : 'No';
                $airTimeHour = substr($program->air_time, 0, 1) + 12;
                $airTimeHour = "$airTimeHour" . ":00";
                $airTime = date('g:i A', strtotime($airTimeHour));
                $airedDay = $program->aired_day;
                $airedMonth = $program->aired_month;
                $createdOn = date('Y/m/d', strtotime($program->created_on));

                $row = array($station, $dailyprogram, $userId, $aired, $airTime, $airedDay, $airedMonth, $createdOn);
                fputcsv($df, $row);
            }
            fclose($df);
        } else {
            Yii::app()->user->setFlash('error', 'You have not selected a specific user');
            $this->redirect('/adminAffidavitReport');
        }
    }

    public function actionReportByMonthAndStation() {
        $model = new FormProgramMonth;
        $model->setScenario('reportms');
        //var_dump($_POST['user']); var_dump($_POST['FormProgramMonth']['month']);exit;
        if ((isset($_POST['FormProgramMonth']) && $_POST['FormProgramMonth']['month'] != '') && (isset($_POST['user'])&& $_POST['user'] != '')) {
            $model->attributes = $_POST['FormProgramMonth'];
            if ($model->validate()) {
                $userId = $_POST['user'];
                $userInfo = eUser::model()->findByPK($userId);

                $now = gmdate("D, d M Y H:i:s");
                header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
                header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
                header("Last-Modified: {$now} GMT");
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header("Content-Disposition: attachment;filename=AffidavitReportByMonth&Station-$userInfo->username.csv");
                header("Content-Transfer-Encoding: binary");
                $headerArray = array('Station', 'Program', 'User ID', 'Aired?', 'Aired Time', 'Aired Day', 'Aired Month', 'Date Created');

                $programs = eProgram::getAllProgramsByMonthAndStation($model->month, $userInfo->username);

                $df = fopen("php://output", 'w');
                fputcsv($df, $headerArray);

                foreach ($programs as $program) {
                    $station = $program->station;
                    $dailyprogram = $program->program_name;
                    $userId = $program->user_id;
                    $aired = (isset($program->aired) && $program->aired == 1) ? 'Yes' : 'No';
                    $airTimeHour = substr($program->air_time, 0, 1) + 12;
                    $airTimeHour = "$airTimeHour" . ":00";
                    $airTime = date('g:i A', strtotime($airTimeHour));
                    $airedDay = $program->aired_day;
                    $airedMonth = $program->aired_month;
                    $createdOn = date('Y/m/d', strtotime($program->created_on));

                    $row = array($station, $dailyprogram, $userId, $aired, $airTime, $airedDay, $airedMonth, $createdOn);
                    fputcsv($df, $row);
                }
                fclose($df);
            }
        } else {
            Yii::app()->user->setFlash('error', 'You have not selected a specific month or a station');
            $this->redirect('/adminAffidavitReport');
        }
    }

    public function actionGetReportAll() {

        $programs = eProgram::model()->recent()->findAll(array('condition' => 'station != :station', 'params' => array(':station' => 'default'),));

        //$userId = $_POST['user'];
        //$userInfo = eUser::model()->findByPK($userId);

        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=AffidavitReportForAllStations.csv");
        header("Content-Transfer-Encoding: binary");
        $headerArray = array('Station', 'Program', 'User ID', 'Aired?', 'Aired Time', 'Aired Day', 'Aired Month', 'Date Created');

        $df = fopen("php://output", 'w');
        fputcsv($df, $headerArray);

        foreach ($programs as $program) {
            $station = $program->station;
            $dailyprogram = $program->program_name;
            $userId = $program->user_id;
            $aired = (isset($program->aired) && $program->aired == 1) ? 'Yes' : 'No';
            $airTimeHour = substr($program->air_time, 0, 1) + 12;
            $airTimeHour = "$airTimeHour" . ":00";
            $airTime = date('g:i A', strtotime($airTimeHour));
            $airedDay = $program->aired_day;
            $airedMonth = $program->aired_month;
            $createdOn = date('Y/m/d', strtotime($program->created_on));

            $row = array($station, $dailyprogram, $userId, $aired, $airTime, $airedDay, $airedMonth, $createdOn);
            fputcsv($df, $row);
        }
        fclose($df);
    }

}

?>
