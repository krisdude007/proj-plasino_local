<?php

class ClientUserUtility {

    public static function register($user){
        if($user->validate()) {
            $user->save();
            $audit = new eAudit;
            $audit->user_id = $user->id;
            $audit->action = 'created an account via '.$user->source;
            $audit->save();
            return true;
        }
        return false;
    }

        public static function login($user, $adminAuthAttempt = false, $mobileAuthAttempt = false) {
        if ($user->validate()) {

            if($adminAuthAttempt) {
                $userRecord = $user->isAdmin()->findByAttributes(array('username' => $user->username));
            } else {
                $userRecord = $user->findByAttributes(array('username' => $user->username));
            }

            if(is_null($userRecord)) {
                return false;
            }

            $identity = new UserIdentity($user->username,$user->password,$user->scenario);
            $userLogin = new eUserLogin;
            $userLogin->source = $user->source;
            $userLogin->user_id = $userRecord->id;

//            $ipinfo = ClientUtility::getIPInfo(Yii::app()->request->getUserHostAddress());
//            $ipinfo2 = json_decode(file_get_contents('https://api.ipinfodb.com/v3/ip-city/?key=3f72533052823233b8c2be0286285ab9d2cf5284c8e3da26e77f595c71c4ee16&ip='.Yii::app()->request->getUserHostAddress().'format=json?'));//var_dump($ipinfo2);exit;
//            $userLogin->ip_basedcity = isset($ipinfo) ? $ipinfo->city : 'unknown';
//            $userLogin->ip_basedstate = isset($ipinfo) ? $ipinfo->region : 'unknown';

            if ($identity->authenticate()) {

                if(!$mobileAuthAttempt) {
                    Yii::app()->user->login($identity, Yii::app()->params['session']['duration']);
                }

                $userLogin->result = 'PASS';
                $userLogin->save();

                $userTech = new eUserTech();
                $userTech->user_id = $userRecord->id;
                $userTech->login_id = $userLogin->id;
                $userTech->user_agent = $_SERVER['HTTP_USER_AGENT'];
                $userTech->screen_height =  (isset($_POST['screen_height'])) ? $_POST['screen_height'] : 0;
                $userTech->screen_width = (isset($_POST['screen_width'])) ? $_POST['screen_width'] : 0;
                $userTech->save();



                return true;
            } else {

                $userLogin->result = 'FAIL';
                $userLogin->save();

                if(!$mobileAuthAttempt) {
                    Yii::app()->user->setFlash('error', Yii::app()->params['flashMessage']['loginError']);
                }

                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * logout
     *
     * Put these here to avoid duplicate methods for admin and client
     */
    public static function logout($deleteCookies = true) {
        if($deleteCookies) {
            Yii::app()->request->cookies->clear();
        }
        $audit = new eAudit;
        $audit->action = 'Logged Out';
        $audit->save();
        Yii::app()->user->logout();
        return true;
    }

    public static function getPhotoId($user) {
        if ($user) {
            if ($image = eImage::model()->accepted()->recent()->isPhotoId()->findByAttributes(array('user_id' => $user->id))) {
                return '/' . basename(Yii::app()->params['paths']['image']) . "/{$image->filename}";
            } else {
                return '/webassets/images/profile-photoId.png';
                }
            }
        return '/webassets/images/profile-photoId.png';
    }

    public static function getFullName() {
        if(!empty(Yii::app()->user->getId())) {
           $user = eUser::model()->findByPk(Yii::app()->user->getId());
           return $user->first_name .' '. $user->last_name;
        }
    }

}
?>
