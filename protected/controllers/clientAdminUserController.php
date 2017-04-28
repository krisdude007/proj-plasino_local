<?php

class clientAdminUserController extends AdminUserController
{
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
                'actions'=>array(
                    'index',
                    'userLoginReport',
                    ),
                'expression'=> "(Yii::app()->user->isSuperAdmin() || Yii::app()->user->isSiteAdmin() || Yii::app()->user->hasPermission('adminuser'))",
            ),

            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Anything required on every page should be loaded here
     * and should also be made a class member.
     */
    function init() {
        parent::init();
        Yii::app()->setComponents(array('errorHandler' => array('errorAction' => 'admin/error',)));
        $this->user = ClientUtility::getUser();
        $this->notification = eNotification::model()->orderDesc()->findAllByAttributes(array('user_id' => Yii::app()->user->id));
    }

    /* User Admin actions */

    public function actionIndex($id = false) {
        if ($id) {
            $user = clientUser::model()->findByPK($id);
            $user->setScenario('profile');
            $userEmail = eUserEmail::model()->findByAttributes(array('user_id' => $id, 'type' => 'primary'));
            $userEmail = (is_null($userEmail)) ? new eUserEmail : $userEmail;
            $userEmail->setScenario('profile');
            $userLocation = clientUserLocation::model()->findByAttributes(array('user_id' => $id, 'type' => 'primary'));
            $userLocation = (is_null($userLocation)) ? new clientUserlocation : $userLocation;
            $userLocation->setScenario('profile');
            $userPhoto = new eImage;
            $imageId = new eImage;
            //$userPhoto = (is_null($userPhoto)) ? new eImage() : $userPhoto;
            //TODO:  Remove enum from user roles and create a sperate role table so we can do simple > or < compares.
            switch (Yii::app()->user->role) {
                case 'super admin':
                    $editable = true;
                    break;
                case 'site admin':
                    $editable = ($user->role == 'super admin') ? false : true;
                    break;
                case 'producer admin':
                    $editable = ($user->role == 'super admin' || $user->role == 'site admin') ? false : true;
                    break;
                default:
                    $editable = false;
                    break;
            }
            if (!$editable) {
                Yii::app()->user->setFlash('error', 'You do not have permission to edit this user.');
                $user = new clientUser;
                $userEmail = new eUserEmail;
                $userLocation = new clientUserLocation;
                $userPhoto = new eImage;
                $imageId = new eImage;
                $user->setScenario('register');
                $userEmail->setScenario('register');
                $userLocation->setScenario('register');
            }
        } else {
            $user = new clientUser;
            $userEmail = new eUserEmail;
            $userLocation = new clientUserLocation;
            $userPhoto = new eImage;
            $imageId = new eImage;
            $user->setScenario('adminRegister');
            $userEmail->setScenario('adminRegister');
            $userLocation->setScenario('register');
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'admin-user-form') {
            echo json_encode(
                CMap::mergeArray(
                    json_decode(CActiveForm::validate($user), true), json_decode(CActiveForm::validate($userEmail), true), json_decode(CActiveForm::validate($userLocation), true), json_decode(CActiveForm::validate($userPhoto), true)
                )
            );
            Yii::app()->end();
        }

        // todo - replace eUserImage with eImage
        if (isset($_POST['clientUser'])) {
            $user->attributes = $_POST['clientUser'];
            $user->birthday = $user->birthYear . '-' . $user->birthMonth . '-' . $user->birthDay;
            $userEmail->attributes = $_POST['eUserEmail'];
            $userLocation->attributes = $_POST['clientUserLocation'];
            $userPhoto->attributes = $_POST['eImage'];
            $userPhoto->user_id = $user->id;
            $userPhoto->image = CUploadedFile::getInstance($userPhoto, 'image');
            $userPhoto->title = 'Avatar';
            $userPhoto->description = 'User avatar image.';
            $userPhoto->source = 'web';
            $userPhoto->to_facebook = 0;
            $userPhoto->to_twitter = 0;
            $userPhoto->status = (Yii::app()->params['image']['autoApproveAvatar']) ? 'accepted' : 'new';
            $userPhoto->arbitrator_id = $user->id;
            $userPhoto->is_avatar = 1;
            //$user->username = $userEmail->email;

            $flash = ($user->isNewRecord) ? 'Add' : 'Updat';
            $user->birthday = $user->birthYear . '-' . $user->birthMonth . '-' . $user->birthDay;
            if ($user->validate()) {
                $user->save();
                // TODO: more extensive validation; these extra permissions can only exist for less than super admin and greater than user.
                $permissions = eUserPermission::model()->deleteAllByAttributes(Array('user_id'=>$user->id));
                if(!empty(Yii::app()->request->getPost('permissions'))) {
                    foreach(Yii::app()->request->getPost('permissions') as $k=>$v){
                        $permission = new eUserPermission;
                        $permission->user_id = $user->id;
                        $permission->controller = $v;
                        $permission->save();
                    }
                }
                $userEmail->user_id = $user->id;
                $userEmail->type = 'primary';
                $userLocation->user_id = $user->id;
                $userLocation->type = 'primary';
                if ($userEmail->validate() && $userLocation->validate() && $userPhoto->validate()) {
                    $userEmail->save();
                    $userLocation->save();
                    if (!empty($userPhoto->image)) {
                        if ($userPhoto->validate()) {
                            preg_match('/\..{3,4}$/', $userPhoto->image->getName(), $matches);
                            $filetype = $matches[0];
                            $userPhoto->filename = $filename = "{$user->id}_" . uniqid('',true) . $filetype;
                            $userPhoto->image->saveAs(Yii::app()->params['paths']['avatar'] . "/{$filename}");
                            $userPhoto->save();
                        }
                    }
                }
                Yii::app()->user->setFlash('success', "User {$flash}ed!");
            } else {
                Yii::app()->user->setFlash('error', "Error {$flash}ing User!");
            }
        }

        $users = new clientUser('search');
        $users->unsetAttributes();

        if (isset($_GET['clientUser'])) {
            $users->attributes = $_GET['clientUser'];
        }

//        if (Yii::app()->params['enableUserFunctionality'] == true) {
//        if (isset($_POST['eImage'])) {
//            $imageId->attributes = $_POST['eImage'];
//            $imageId->user_id = $user->id;
//            $imageId->image = CUploadedFile::getInstance($imageId, 'imageId');
//            $imageId->title = 'PhotoId';
//            $imageId->description = 'User Photo ID.';
//            $imageId->source = 'web';
//            $imageId->to_facebook = 0;
//            $imageId->to_twitter = 0;
//            $imageId->status = (Yii::app()->params['image']['autoApproveAvatar'] === true) ? 'accepted' : 'new';
//            $imageId->arbitrator_id = $user->id;
//            $imageId->is_avatar = 2;
//            if (!empty($imageId->image) && $imageId->validate()) {
//
//                preg_match('/\..{3,4}$/', $imageId->image->getName(), $matches);
//                $filetype = $matches[0];
//                $filename = "{$user->id}_" . uniqid('', true) . $filetype;
//                $imageId->image->saveAs(Yii::app()->params['paths']['avatar'] . "/{$filename}");
//                $imageId->filename = $filename;
//                $imageId->save();
//                Yii::app()->user->setFlash('success', "User Photo ID updated.");
//            }
//            else {
//                $pattern = 'profile-photoId';
//                $matches = stripos(ClientUserUtility::getPhotoId($user), $pattern);
//                if ($matches != false) {
//                Yii::app()->user->setFlash('error', "Photo ID not updated.");
//                }
//            }
//        }
//        }
        $permissions = UserUtility::getAvailablePermissions();
        $userPermissions = eUserPermission::model()->findAllByAttributes(Array('user_id'=>$id));

        $arr = array(
            'user' => $user,
            'userEmail' => $userEmail,
            'userPhoto' => $userPhoto,
            'userLocation' => $userLocation,
            'userPermissions' => $userPermissions,
            'users' => $users,
            'permissions' => $permissions,
            );

        if (Yii::app()->params['enableUserFunctionality'] == true) {
            $arr['imageId'] = $imageId;
        }

        $this->render('index',$arr);
    }

    public function actionUserLoginReport() {

        $from = '2010-09-01 00:00:00';
        $to = '2015-09-8 00:00:00';

        $sql = "SELECT U.id AS user_id, U.username, U.created_on AS joined_date,
                L.id, L.ip_address, L.ip_basedcity, L.ip_basedstate, L.source, L.created_on AS logedin_date,
                T.user_agent,
                G.city, G.state
                FROM user_login AS L
                LEFT JOIN user AS U ON U.id = L.user_id
                LEFT JOIN user_tech AS T ON T.user_id = L.user_id
                LEFT JOIN geolocation_info AS G ON G.ip_address = L.ip_address
                GROUP by L.id
                ORDER BY L.id DESC
                LIMIT 1000";

        $users = Yii::app()->db->createCommand($sql)->queryAll(true);

        $this->render('userLoginReport',
                      array('users' => $users));
    }
}