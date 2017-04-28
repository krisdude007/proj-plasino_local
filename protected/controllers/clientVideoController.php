<?php

class clientVideoController extends VideoController {

    public $activeNavLink;

    public function actionRecord($id = 0) {
        $this->activeNavLink = 'video';
        if (empty(Yii::app()->session['prize_id'])) {
            $this->redirect($this->createUrl('/playnow'));
        }
        $this->render('recorder', array(
            'user_id' => Yii::app()->user->getId(),
            'duration' => Yii::app()->params['video']['duration'],
            'wowzaip' => Yii::app()->params['wowza']['clientip'],
        ));
    }

    public function actionCapture() {
        foreach ($_POST as $k => $v) {
            $$k = $v;
        }
        $video = eVideo::model()->findByAttributes(Array('user_id' => Yii::app()->user->getId(), 'filename' => $file));
        if (is_null($video)) {
            $record = array();
            $record['filename'] = $file;
            $record['thumbnail'] = $file;
            $record['question_id'] = null;
            $record['source'] = $source;
            $record['arbitrator_id'] = Yii::app()->user->getId();
            $record['user_id'] = Yii::app()->user->getId();
            $inserted = eVideo::insertRecord($record);
            $video = $inserted;
            echo $video->id;
        } else {
            echo $video->id;
        }
    }

    public function actionProcess($id = 0) {
        $this->activeNavLink = 'video';
        if (!(!empty(Yii::app()->session['type']) && !empty(Yii::app()->session['prize_id']) && !empty(Yii::app()->session['credits']))) {
            $this->redirect($this->createUrl('/playnow'));
        }
        if ($id == 0) {
            $this->redirect(Yii::app()->createUrl('/record'));
        }
        $video = eVideo::model()->findByPk($id);
        if (is_null($video) || $video->processed == 1) {
            $this->redirect(Yii::app()->createUrl('/record'));
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'video-process-form') {
            echo CActiveForm::validate(array($video));
            Yii::app()->end();
        }
        $this->download($id);
        if (isset($_POST['eVideo'])) {
            $video->attributes = $_POST['eVideo'];
            $video->prize_id = Yii::app()->session['prize_id'];
            $video->question_id = Yii::app()->session['question_id'];
            $video->to_twitter = 0;
            $video->to_facebook = 0;
            $autoApprove = eAppSetting::model()->findByAttributes(Array('attribute' => 'auto_approve_submitted_videos'));
            if ($autoApprove->value) {
                $video->status = 'accepted';
            }
            if ($video->validate()) {
                $model = new eCreditTransaction;
                $model->type = Yii::app()->session['type'];
                $model->prize_id = Yii::app()->session['prize_id'];
                $model->credits = Yii::app()->session['credits'];

                $transaction = Yii::app()->db->beginTransaction();
                try {
                    if (!$model->save()) {
                        throw new Exception('Credit cannot be saved.');
                    }
                    if (!$video->save()) {
                        throw new Exception('Video cannot be saved.');
                    }
                    $transaction->commit();
                }
                catch (Exception $e) {
                    $transaction->rollBack();
                    $this->render('process', array(
                        'model' => $video,
                        'videoInfo' => Array(
                            'videofile' => '/' . basename(Yii::app()->params['paths']['video']) . "/{$video->filename}" . Yii::app()->params['video']['preExt'],
                            'image' => '/' . basename(Yii::app()->params['paths']['video']) . "/{$video->thumbnail}" . Yii::app()->params['video']['imageExt'],
                            'width' => 426,
                            'height' => 240,
                        ),
                    ));
                    return;
                }

                $prize = ePrize::model()->findByPk(Yii::app()->session['prize_id']);
                $prize->quantity = $prize->quantity - 1;
                $prize->save();

                unset(Yii::app()->session['type']);
                unset(Yii::app()->session['prize_id']);
                unset(Yii::app()->session['credits']);
                unset(Yii::app()->session['question_id']);
                if ($video->status == 'accepted') {
                    AuditUtility::save($this, false, Array('action' => 'autoApprove', 'type' => 'video', 'id' => $video->id));
                }
                $this->encode($video->id);
                $this->redirect($this->createUrl('/video/thanks'));
            }
        }
        $this->render('process', array(
            'model' => $video,
            'videoInfo' => Array(
                'videofile' => '/' . basename(Yii::app()->params['paths']['video']) . "/{$video->filename}" . Yii::app()->params['video']['preExt'],
                'image' => '/' . basename(Yii::app()->params['paths']['video']) . "/{$video->thumbnail}" . Yii::app()->params['video']['imageExt'],
                'width' => 426,
                'height' => 240,
            ),
        ));
    }

    public function actionTestUpload($id = 0) {
        if (Yii::app()->user->isGuest) {
            Yii::app()->user->setReturnUrl(Yii::app()->request->getUrl());
            $this->redirect('/login');
        }

        $uploadvideo = new FormVideoUpload;
        if ($id == 0) {
            $questions = eQuestion::model()->video()->current()->findAll();
            foreach ($questions as $q) {
                $question = $q->question;
                $id = $q->id;
            }
        } else {
            $uploadvideo->question_id = $id;
        }
        $uploadvideo->is_ad = 0;
        $title = 'test upload';
        $description = 'test description';

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'video-uploader-form') {
            echo CActiveForm::validate(array($uploadvideo));
            Yii::app()->end();
        }

        if (isset($_POST['FormVideoUpload'])) {
            $uploadvideo->attributes = $_POST['FormVideoUpload'];
            $uploadvideo->video = CUploadedFile::getInstance($uploadvideo, 'video');
            $uploadvideo->title = $title;
            $uploadvideo->question_id = $id;
            //$uploadvideo->validate();
            //var_dump($uploadvideo->getErrors());exit;
            if ($uploadvideo->validate()) {
                $encoderResult = VideoUtility::encode(Yii::app()->params['video']['filePrefix'], $uploadvideo->video->extensionName, $uploadvideo->video);

                // add record
                $record = array();
                $record['filename'] = $encoderResult['filename'];
                $record['thumbnail'] = $encoderResult['filename'];
                if ($uploadvideo->question_id != '0') {
                    $record['question_id'] = $uploadvideo->question_id;
                }

                $record['arbitrator_id'] = Yii::app()->user->getId();
                $record['user_id'] = Yii::app()->user->getId();
                $record['processed'] = 1;
                $record['source'] = 'web/upload';
                $record['title'] = $title;
                $record['description'] = $description;

                $record['view_key'] = eVideo::generateViewKey();
                $record['duration'] = $encoderResult['duration'];
                $record['watermarked'] = $encoderResult['watermarked'];

                $record['frame_rate'] = $encoderResult['fileInfo']['video']['frame_rate'];
                $record['hero_user_id'] = NULL;

                if (!empty($_POST['contestants'])) {
                    $record['hero_user_id'] = $_POST['contestants'];
                }
                $inserted = eVideo::insertRecord($record);

                $autoApprove = eAppSetting::model()->findByAttributes(Array('attribute' => 'auto_approve_submitted_videos'));
                if ($autoApprove->value) {
                    $inserted->status = 'accepted';
                    if (Yii::app()->params['video']['useExtendedFilters']) {
                        $inserted->extendedStatus['accepted'] = true;
                        $inserted->extendedStatus['new_tv'] = true;
                    }
                } else {
                    $inserted->status = 'new';
                    if (Yii::app()->params['video']['useExtendedFilters']) {
                        $inserted->extendedStatus['new'] = true;
                        $inserted->extendedStatus['new_tv'] = true;
                    }
                }

                // see if user selected share to twitter or facebook
                if ($uploadvideo->to_twitter == '1')
                    if (eUserTwitter::model()->countByAttributes(array('user_id' => Yii::app()->user->id)) == 0)//no connection to twitter
                        $inserted->to_twitter = 0;
                    else {
                        $inserted->to_twitter = 1;
                    }
                if ($uploadvideo->to_facebook == '1')
                    if (eUserFacebook::model()->countByAttributes(array('user_id' => Yii::app()->user->id)) == 0)//no connection to facebook
                        $inserted->to_facebook = 0;
                    else {
                        $inserted->to_facebook = 1;
                    }

                if ($inserted) {
                    $inserted->save();
                    Yii::app()->user->setFlash('success', 'Success upload');
                } else {
                    Yii::app()->user->setFlash('error', Yii::app()->params['custom_params']['video_insertrecord_error']);
                }
            } else {
                Yii::app()->user->setFlash('error', Yii::app()->params['custom_params']['video_encode_error']);
            }
        }
        $this->render('testupload', array(
            'uploadvideo' => $uploadvideo,
        ));
    }

    public function actionThanks() {
        $this->render('thanks', array(
        ));
    }

}

?>
