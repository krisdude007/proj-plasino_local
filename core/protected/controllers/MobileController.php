<?php

/**
 * Mobile API Controller
 *
 * Responsible as main interface for all mobile traffic.
 *
 * @author <greg.stringer@gmail.com>
 */
class MobileController extends Controller {

    public $layout = false;
    private $authenticated = false;
    private $eUser;
    private $eUserToken;
    private $outputFormats = array('json', 'xml');
    private $outputFormat = 'json';
    private $responseCode = NULL;
    private $responseCodes = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Switch Proxy',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Unordered Collection',
        426 => 'Upgrade Required',
        449 => 'Retry With',
        450 => 'Blocked by Windows Parental Controls',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        509 => 'Bandwidth Limit Exceeded',
        510 => 'Not Extended'
    );

    const cResponseUserAuthenticationInsufficient = 'Insufficient authentication parameters.';
    const cResponseUserAuthenticationFailure = 'Username/Password invalid.';
    const cResponseUserAuthenticationSuccess = 'Login Successful.';
    const cResponseUserDeAuthenticationSuccess = 'Logout Successful.';
    const cResponseUserRegistrationInsufficient = 'Insufficient registration parameters.';
    const cResponseUserOwnershipVerificationFailure = 'Access to resource is restricted to resource owner.';
    const cResponseVideoEncodeFailure = 'Unable to encode video.';
    const cResponseUserDeAuthenticationUnnecessary = 'User must be authenticated to deauthenticate.';
    const cResponseUserTokenExpired = 'Token has expired. Please reauthenticate.';
    const cResponseUserAvatarNotApproved = 'Image must first be approved by an admin.';
    const cResponsePollAnswerOutOfRange = 'Poll response does not match available responses.';
    const cResponsePollIdInvalid = 'Unable to locate answers for provided poll id.';
    
    /**
     * Initialize. Here we set a custom error handler so that we do not 
     * output default html.
     */
    public function init() {
        parent::init();
        Yii::app()->errorHandler->errorAction = 'mobile/error';
    }

    public function filters() {
        return array();
    }

    /**
     * Dummy action so that we can output json/xml errors instead of html.
     */
    public function actionError() {
        //$this->throwException(404);
    }

    /**
     * Sets appropriate http(s) headers based on given response code.
     * In PHP 5.4 this is native functionality.
     * @param int $responseCode
     * @return int
     */
    private function setHttpResponse($responseCode = NULL) {
        if ($responseCode !== NULL) {
            $text = $this->responseCodes[$responseCode];
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . $responseCode . ' ' . $text);
            $this->responseCode = $responseCode;
        } else {
            $responseCode = (isset($this->responseCode) ? $this->responseCode : 200);
        }
        return $responseCode;
    }

    /**
     * throwException()
     * Calls renderOutput (which ends script execution) after setting http 
     * response code and deciding which type of data format to return.
     * @param int $responseCode
     * @param string $responseText 
     */
    private function throwException($responseCode = NULL, $responseText = '') {
        if ($responseText == '') {
            $responseText = $this->responseCodes[$responseCode];
        }
        $this->renderOutput(array('responseCode' => $responseCode, 'responseText' => $responseText), $responseCode);
    }

    /**
     * First sets http response then renders output in either json or xml format.
     * This is where script execution ends. Do not call exit.
     * @param type $output
     * @param type $responseCode 
     */
    private function renderOutput($output = array(), $responseCode = 200) {
        $this->setHttpResponse($responseCode);
        if (count($output) > 0) {
            switch ($this->outputFormat) {
                case 'json':
                    echo $this->renderJson($output);
                    break;
                case 'xml':
                    echo $this->renderXml($output);
                    break;
                default:
                    // Bad request
                    $this->setHttpResponse(400);
                    break;
            }
        }
        // todo - no data returned.. double check
        Yii::app()->end();
    }

    /**
     * Converts a PHP array to XML for output purposes.
     * @param array $output
     * @return XML
     */
    private function renderXml($output = array()) {

        header('Content-type: application/xml');
        $xml = new SimpleXMLElement('<root/>');
        $output = array_flip($output);
        array_walk_recursive($output, array($xml, 'addChild'));
        return $xml->asXML();
    }

    /**
     * Converts a PHP array to json for output purposes.
     * @param array $output
     * @return JSON
     */
    private function renderJson($output = array()) {
        header('Content-type: application/json');
        return CJSON::encode($output);
    }

    /**
     * Takes an array of models and returns the first error found
     * @param type $models
     * @return string:bool 
     */
    private function getErrorFromModels($models = array()) {
        foreach ($models as $model) {
            foreach ($model->attributes as $key => $val) {
                $error = $model->getError($key);
                if (!is_null($error)) {
                    return str_replace('"', '', $error);
                }
            }
        }
        return false;
    }

    /**
     * Removes crutial information from an object
     * @param object $object 
     * @return object $object
     */
    private function cleanseObject($object = null, $properties = array()) {
        if (!is_null($object) && count($properties) > 0) {
            foreach ($properties as $key => $prop) {
                if(isset($object->{$prop})) {
                    unset($object->{$prop});
                }
            }
        }

        return $object;
    }

    /**
     * Removes crutial information from eUser object
     * @param object $eUser 
     */
    private function cleanseUser($eUser) {
        $properties = array('password',
            'salt',
            'source',
            'role');
        $eUser = $this->cleanseObject($eUser, $properties);
        return $eUser;
    }

    /**
     * Removes crutial information from eUserLocation object
     * @param object $eUserLocation 
     * @return object $eUserLocation
     */
    private function cleanseUserLocation($eUserLocation) {
        $properties = array('id',
            'address1',
            'address2',
            'city',
            'state',
            'country',
            'timezone',
            'type');
        $eUserLocation = $this->cleanseObject($eUserLocation, $properties);
        return $eUserLocation;
    }

    /**
     * Removes crutial information from eUserEmail object
     * @param object $eUserEmail 
     * @return object $eUserEmail
     */
    private function cleanseUserEmail($eUserEmail) {
        $properties = array('id',
            'type',
            'active');
        $eUserEmail = $this->cleanseObject($eUserEmail, $properties);
        return $eUserEmail;
    }
    
    private function generateToken($user_id) {
        $tokenObj = eUserToken::model()->findByAttributes(array('user_id' => $user_id));
        if(!is_null($tokenObj)) {
            $tokenObj->delete();
        }
        $eUserToken = new eUserToken();
        $eUserToken->user_id = $this->eUser->id;
        $eUserToken->token = eUserToken::generateToken();
        $eUserToken->created_on = new CDbExpression('NOW()');
        $eUserToken->updated_on = new CDbExpression('NOW()');
        if($eUserToken->save()) {
            $this->eUserToken = $eUserToken->token;
            $this->authenticated = true;
            return true;
        } else {
            $this->throwException(400, $this->getErrorFromModels(array($eUserToken)));
        }
    }
    
    /**
     * Authenticates a user
     */
    public function actionLogin() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $eUser = new eUser;
            $eUser->setScenario('login');
            $eUser->username = $_SERVER['PHP_AUTH_USER'];
            $eUser->password = $_SERVER['PHP_AUTH_PW'];
            $eUser->source = 'mobile';
            if (UserUtility::login($eUser, false, true)) {
                $this->eUser = $eUser->findByAttributes(array('username' => $eUser->username));
                $this->generateToken($this->eUser->id);
                AuditUtility::save($this, $_REQUEST, array(), $this->eUser->id);
                $output = array('eUser' => $this->cleanseUser($this->eUser),
                                'eUserToken' => $this->eUserToken);
                $this->renderOutput($output);
            } else {
                // Unauthorized
                $this->throwException(401, self::cResponseUserAuthenticationFailure);
            }   
        }
        $this->throwException(405);
    }
     
   /**
     * Deauthenticates a user
     */
    public function actionLogout() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->validateToken(false)) {
                // log user out 
                $this->deleteToken();
                // Unauthorized
                $this->throwException(401, self::cResponseUserDeAuthenticationSuccess);
            } else {
                $this->throwException(401, self::cResponseUserDeAuthenticationUnnecessary);
            }
        }
        $this->throwException(405);
    }
    
    /**
     * Returns user token from HTTP Headers
     * @return type
     */
    private function getTokenFromHeader() {
        return $_SERVER['HTTP_TOKEN'];
    }
    
    private function getTokenFromDb($token) {
        return eUserToken::model()->with('user')->findByAttributes(array('token' => $token));
    }

    /**
     * Deletes a user token
     * @return boolean
     */
    private function deleteToken() {
        $tokenObj = $this->getTokenFromDb($this->getTokenFromHeader());
        if(!is_null($tokenObj)) {
            $tokenObj->delete();
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Attempts to validate a user token
     * @param type $throwException
     * @return boolean|exception
     */
    private function validateToken($throwException = true) {
        $token = $this->getTokenFromHeader();
        $tokenObj = $this->getTokenFromDb($token);
        if(!is_null($tokenObj)) {
            $t1 = strtotime($tokenObj->updated_on);
            $t2 = time();
            $tokenObj->updated_on = new CDbExpression('NOW()');
            $tokenObj->save();
            $timeDifference = $t2 - $t1;
            if($timeDifference >= Yii::app()->params['mobileAPI']['sessionTimeoutSecs']) {
                $this->deleteToken($token);
                if($throwException) {
                    $this->throwException(401, self::cResponseUserTokenExpired);
                } else {
                    return false;
                }
            }
            $this->eUser = $tokenObj->user;
            $this->authenticated = true;
            return true;
        } else {
            if($throwException) {
                $this->throwException(401, self::cResponseUserAuthenticationFailure);
            } else {
                return false;
            }
        }
    }

    /**
     * Verify that a user owns the resource they are attempting to access
     * @param int $id 
     */
    private function verifyOwnership($id) {

        if ($id != $this->eUser->id) {
            // Forbidden
            $this->throwException(403, self::cResponseUserOwnershipVerificationFailure);
        }
    }

    /**
     * Attempts to create a new eUser record.
     * @return type array
     */
    private function userAdd() {
        if (isset($_POST['eUser'], $_POST['eUserEmail'], $_POST['eUserLocation'])) {
            $eUser = new eUser;
            $eUserEmail = new eUserEmail;
            $eUserLocation = new eUserLocation;
            $eUser->setScenario('register');
            $eUserEmail->setScenario('register');
            $eUserLocation->setScenario('register');
            $eUser->attributes = $_POST['eUser'];
            $eUserEmail->attributes = $_POST['eUserEmail'];
            $eUserLocation->attributes = $_POST['eUserLocation'];
            $eUser->username = $eUserEmail->email;
            $eUser->birthday = $eUser->birthYear . '-' . $eUser->birthMonth . '-' . $eUser->birthDay;
            $eUser->source = 'mobile';
            $eUserEmail->type = 'primary';
            $eUserEmail->active = 1;
            $eUserLocation->type = 'primary';

            if (UserUtility::register($eUser, $eUserEmail, $eUserLocation)) {
                MailUtility::send('welcome', $eUserEmail->email);
                $this->eUser = $eUser;
                $this->generateToken($this->eUser->id);
                AuditUtility::save($this, $_REQUEST, array(), $this->eUser->id);
                $output =  array('eUser' => $this->cleanseUser($this->eUser),
                                'eUserLocation' => $this->cleanseUserLocation($eUserLocation),
                                'eUserEmail' => $this->cleanseUserEmail($eUserEmail),
                                'eUserToken' => $this->eUserToken);
                return $output;
            }

            $this->throwException(400, $this->getErrorFromModels(array($eUser, $eUserEmail, $eUserLocation)));
        }
    }

    /**
     * Attempts to retrieve a user based on id
     * @param int $id
     * @return object:null 
     */
    private function userGet($id) {
        $eUser = eUser::model()->findByPk($id);
        $eUserLocation = $this->userLocationGet($id);
        $eUserEmail = $this->userEmailGet($id);
        if (!is_null($eUser) && !is_null($eUserLocation) && !is_null($eUserEmail)) {
            $eUser = $this->cleanseUser($eUser);
            $eUserLocation = $this->cleanseUserLocation($eUserLocation);
            $eUserEmail = $this->cleanseUserEmail($eUserEmail);
        }
        
        $output = array('eUser' => $eUser,
                        'eUserLocation' => $eUserLocation,
                        'eUserEmail' => $eUserEmail);
        return $output;
    }

    /**
     * Attempts to retrieve a user location based on id
     * @param int $id
     * @return object:null 
     */
    private function userLocationGet($id) {
        return eUserLocation::model()->findByAttributes(array('user_id' => $id, 'type' => 'primary'));
    }

    /**
     * Attempts to retrieve a user email based on id
     * @param int $id
     * @return object:null 
     */
    private function userEmailGet($id) {
        return eUserEmail::model()->findByAttributes(array('user_id' => $id, 'type' => 'primary'));
    }

    /**
     * Attempts to update a user based on id.
     * @param int $id
     * @return array:null  
     */
    private function userUpdate($id) {
        // todo - add eUserLocation and eUserEmail
        $eUserObjects = $this->userGet($id);
        $eUser = $eUserObjects['eUser'];
        $eUserLocation = $eUserObjects['eUserLocation'];
        $eUserEmail = $eUserObjects['eUserEmail'];
        $eUserModified = false;
        $eUserLocationModified = false;
        $eUserEmailModified = false;

        if (!is_null($eUser) && !is_null($eUserLocation) && !is_null($eUserEmail)) {

            $eUser->setScenario('profile');
            $eUserEmail->setScenario('profile');
            $eUserLocation->setScenario('profile');

            if (isset($_POST['eUser']['first_name'])) {
                $eUserModified = true;
                $eUser->first_name = $_POST['eUser']['first_name'];
            }
            if (isset($_POST['eUser']['last_name'])) {
                $eUserModified = true;
                $eUser->last_name = $_POST['eUser']['last_name'];
            }
            if (isset($_POST['eUser']['birthMonth'])) {
                $eUserModified = true;
                $eUser->birthMonth = $_POST['eUser']['birthMonth'];
                $eUser->birthday = $eUser->birthYear . '-' . $eUser->birthMonth . '-' . $eUser->birthDay;
            }
            if (isset($_POST['eUser']['birthDay'])) {
                $eUserModified = true;
                $eUser->birthDay = $_POST['eUser']['birthDay'];
                $eUser->birthday = $eUser->birthYear . '-' . $eUser->birthMonth . '-' . $eUser->birthDay;
            }
            if (isset($_POST['eUser']['birthYear'])) {
                $eUserModified = true;
                $eUser->birthYear = $_POST['eUser']['birthYear'];
                $eUser->birthday = $eUser->birthYear . '-' . $eUser->birthMonth . '-' . $eUser->birthDay;
            }
            if (isset($_POST['eUser']['gender'])) {
                $eUserModified = true;
                $eUser->gender = $_POST['eUser']['gender'];
            }
            if (isset($_POST['eUser']['terms_accepted'])) {
                $eUserModified = true;
                $eUser->terms_accepted = $_POST['eUser']['terms_accepted'];
            }
            if (isset($_POST['eUserLocation']['postal_code'])) {
                $eUserLocationModified = true;
                $eUserLocation->postal_code = $_POST['eUserLocation']['postal_code'];
            }
            if (isset($_POST['eUserEmail']['email'])) {
                $eUserEmailModified = true;
                $eUserModified = true;
                $eUserEmail->email = $_POST['eUserEmail']['email'];
                $eUser->username = $eUserEmail->email;
            }

            // handle email first because if not the user model will be updated even
            // if the email model doesn't pass validation
            if ($eUserEmailModified) {
                if ($eUserEmail->validate()) {
                    $eUserEmail->updated_on = new CDbExpression('NOW()');
                    $eUserEmail->save();
                    $eUserEmail = $this->cleanseUserEmail($eUserEmail);
                } else {
                    $this->throwException(400, $this->getErrorFromModels(array($eUserEmail)));
                }
            }

            if ($eUserLocationModified) {
                if ($eUserLocation->validate()) {
                    $eUserLocation->updated_on = new CDbExpression('NOW()');
                    $eUserLocation->save();
                    $eUserLocation = $this->cleanseUserLocation($eUserLocation);
                } else {
                    $this->throwException(400, $this->getErrorFromModels(array($eUserLocation)));
                }
            }

            if ($eUserModified) {
                if ($eUser->validate()) {
                    $eUser->updated_on = new CDbExpression('NOW()');
                    $eUser->save();
                    $eUser = $this->cleanseUser($eUser);
                } else {
                    $this->throwException(400, $this->getErrorFromModels(array($eUser)));
                }
            }

            $output =  array('eUser' => $eUser,
                            'eUserLocation' => $eUserLocation,
                            'eUserEmail' => $eUserEmail);
            return $output;
        } else {
            return NULL;
        }
    }

    /**
     * Attempts to retrieve videos based on given paramaters
     * @param type $user_id
     * @param type $id
     * @param type $limit
     * @param type $offset
     * @return null
     */
    private function videosGet($user_id = NULL, $id = NULL, $limit = 10, $offset = 0) {

        if (!is_null($id) && is_null($user_id)) {
            $eVideo = eVideo::model()->with('user', 'rating', 'views', 'brightcoves')->accepted()->recent()->hasUser()->nonAdvertisement()->findByPk($id);

            if (!is_null($eVideo)) {
                
                $tags = array();
                $tagVideos = eTagVideo::model()->with('tag')->findAllByAttributes(array('video_id' => $eVideo->id));
                foreach ($tagVideos as $tag) {
                    $tags[] = $tag->tag->title;
                }
                
                $output = array(
                    'id' => $eVideo->id,
                    'title' => $eVideo->title,
                    'description' => $eVideo->description,
                    'tags' => (count($tags) > 0) ? implode(',', $tags) : '',
                    //'brightcoveID' => $eVideo->brightcoves[0]->brightcove_id,
                    'playerID' => Yii::app()->params['brightcove']['playerID'],
                    'playerKey' => Yii::app()->params['brightcove']['playerKey'],
                    'fallbackURL' => $this->createAbsoluteUrl('/' . basename(Yii::app()->params['paths']['video']) . '/' . $eVideo->filename . Yii::app()->params['video']['postExt']),
                    'thumbnail' => $this->createAbsoluteUrl('/' . basename(Yii::app()->params['paths']['video']) . '/' . $eVideo->thumbnail . Yii::app()->params['video']['imageExt']),
                    'views' => $eVideo->views,
                    'stars' => $eVideo->rating,
                    'created_on' => strtotime($eVideo->created_on),
                    'updated_on' => strtotime($eVideo->updated_on),
                    'eUser' => $this->cleanseUser($eVideo->user)
                );
                return $output;
            } else {
                return NULL;
            }
        } else {
            $criteria = new CDbCriteria();
            $criteria->limit = $limit;
            $criteria->offset = $offset;
            if (!is_null($user_id)) {
                $criteria->compare('user_id', $user_id);
            }
            $eVideos = eVideo::model()->with('user', 'rating', 'views', 'brightcoves')->accepted()->recent()->hasUser()->nonAdvertisement()->findAll($criteria);
        }

        $output = array();
        foreach ($eVideos as $eVideo) {

            $tags = array();
            $tagVideos = eTagVideo::model()->with('tag')->findAllByAttributes(array('video_id' => $eVideo->id));
            foreach ($tagVideos as $tag) {
                $tags[] = $tag->tag->title;
            }

            $output[] = array(
                'id' => $eVideo->id,
                'title' => $eVideo->title,
                'description' => $eVideo->description,
                'duration' => $eVideo->duration,
                'frame_rate' => $eVideo->frame_rate,
                'tags' => (count($tags) > 0) ? implode(',', $tags) : '',
                //'brightcoveID' => $eVideo->brightcoves[0]->brightcove_id,
                'playerID' => Yii::app()->params['brightcove']['playerID'],
                'playerKey' => Yii::app()->params['brightcove']['playerKey'],
                'fallbackURL' => $this->createAbsoluteUrl('/' . basename(Yii::app()->params['paths']['video']) . '/' . $eVideo->filename . Yii::app()->params['video']['postExt']),
                'thumbnail' => $this->createAbsoluteUrl('/' . basename(Yii::app()->params['paths']['video']) . '/' . $eVideo->thumbnail . Yii::app()->params['video']['imageExt']),
                'views' => $eVideo->views,
                'stars' => $eVideo->rating,
                'created_on' => strtotime($eVideo->created_on),
                'updated_on' => strtotime($eVideo->updated_on),
                'eUser' => $this->cleanseUser($eVideo->user)
            );
        }

        if (count($output) > 0) {
            return $output;
        } else {
            return NULL;
        }
    }

    /**
     * Attempts to upload and process an eVideo
     * based on $_POST and $_FILES (Yii handles $_FILES)
     * @return bool|null
     */
    private function videoUpload() {

        $model = new FormMobileVideoUpload;
        
        if (isset($_POST['eVideo'])) {
            
            $model->attributes = $_POST['eVideo'];       
            $model->video = CUploadedFile::getInstanceByName('eVideo[video]');
 
            if (!$model->validate()) {
                $this->throwException(400, $this->getErrorFromModels(array($model)));
            }

            $encoderResult = VideoUtility::encode('MB', $model->video->extensionName, $model->video);
            if(!$encoderResult) {
                $this->throwException(400, self::cResponseVideoEncodeFailure);
            }
            
            $eVideo = new eVideo();
            $eVideo->user_id = $this->eUser->id;
            $eVideo->question_id = $model->question_id;
            $eVideo->filename = $encoderResult['filename'];
            $eVideo->thumbnail = $encoderResult['filename'];
            $eVideo->processed = 1;
            $eVideo->watermarked = $encoderResult['watermarked'];
            $eVideo->title = $model->title;
            $eVideo->description = $model->description;
            $eVideo->duration = $encoderResult['duration'];
            $eVideo->frame_rate = $encoderResult['fileInfo']['video']['frame_rate'];
            $eVideo->view_key = eVideo::generateViewKey();
            $eVideo->source = 'mobile';
            $eVideo->source_user_id = 'mobile';
            $eVideo->to_twitter = 0;
            $eVideo->to_facebook = 0;
            $eVideo->arbitrator_id = $this->eUser->id;
            $eVideo->status = 'new';

            if (Yii::app()->params['video']['useExtendedFilters']) {
                $eVideo->extendedStatus['new'] = true;
                $eVideo->extendedStatus['new_tv'] = true;
            }

            //check auto accept
            $autoApprove = eAppSetting::model()->findByAttributes(Array('attribute' => 'auto_approve_submitted_videos'));
            if ($autoApprove->value) {
                $eVideo->status = 'accepted';
                if (Yii::app()->params['video']['useExtendedFilters']) {
                    $eVideo->extendedStatus['accepted'] = true;
                    $eVideo->extendedStatus['new_tv'] = true;
                }
            }

            if ($eVideo->save()) {

                $output = array(
                    'id' => $eVideo->id,
                    'question_id' => $eVideo->question_id,
                    'title' => $eVideo->title,
                    'description' => $eVideo->description,
                    'duration' => $eVideo->duration,
                    'frame_rate' => $eVideo->frame_rate,
                    //'tags' => (count($tags) > 0) ? implode(',', $tags) : '',
                    //'brightcoveID' => $eVideo->brightcoves[0]->brightcove_id,
                    'playerID' => Yii::app()->params['brightcove']['playerID'],
                    'playerKey' => Yii::app()->params['brightcove']['playerKey'],
                    'fallbackURL' => $this->createAbsoluteUrl('/' . basename(Yii::app()->params['paths']['video']) . '/' . $eVideo->filename . Yii::app()->params['video']['postExt']),
                    'thumbnail' => $this->createAbsoluteUrl('/' . basename(Yii::app()->params['paths']['video']) . '/' . $eVideo->thumbnail . Yii::app()->params['video']['imageExt']),
                    'views' => $eVideo->views,
                    'stars' => $eVideo->rating,
                    'created_on' => strtotime($eVideo->created_on),
                    'updated_on' => strtotime($eVideo->updated_on),
                    'eUser' => $this->cleanseUser($eVideo->user)
                );
                return $output;
            } else {
                $this->throwException(400, $this->getErrorFromModels(array($eVideo)));
            }
        } else {
            return NULL;
        }
    }
    
    /**
     * Attempts to retrieve eImages based on given paramaters
     * @param type $user_id
     * @param type $id
     * @param type $limit
     * @param type $offset
     * @return Array|null
     */
    private function imagesGet($user_id = NULL, $id = NULL, $limit = 10, $offset = 0) {

        if (!is_null($id) && is_null($user_id)) { 
            $eImage = eImage::model()->with('user', 'rating', 'views')->accepted()->recent()->findByPk($id);
            if (!is_null($eImage)) {
                
                $tags = array();
                $tagImages = eTagImage::model()->with('tag')->findAllByAttributes(array('image_id' => $eImage->id));
                foreach ($tagImages as $tag) {
                    $tags[] = $tag->tag->title;
                }
                
                $output = array(
                    'id' => $eImage->id,
                    'user_id' => $eImage->user_id,
                    'title' => $eImage->title,
                    'description' => $eImage->description,
                    'tags' => (count($tags) > 0) ? implode(',', $tags) : '',
                    'view_key' => $eImage->view_key,
                    'is_avatar' => $eImage->is_avatar,
                    'url' => $this->createAbsoluteUrl('/' . basename(Yii::app()->params['paths']['image']) . '/' . $eImage->filename),
                    'views' => $eImage->views,
                    'stars' => $eImage->rating,
                    'created_on' => strtotime($eImage->created_on),
                    'updated_on' => strtotime($eImage->updated_on),
                    'eUser' => $this->cleanseUser($eImage->user)
                );
                return $output;
            } else {
                return NULL;
            }
        } else {
            
            $criteria = new CDbCriteria();
            $criteria->limit = $limit;
            $criteria->offset = $offset;
            if (!is_null($user_id)) {
                $criteria->compare('user_id', $user_id);
            }
            
            $eImages = eImage::model()->with('user', 'rating', 'views')->accepted()->recent()->findAll($criteria);
        }

        $output = array();
        foreach ($eImages as $eImage) {
            
            $tags = array();
            $tagImages = eTagImage::model()->with('tag')->findAllByAttributes(array('image_id' => $eImage->id));
            foreach ($tagImages as $tag) {
                $tags[] = $tag->tag->title;
            }
            
            $output[] = array(
                'id' => $eImage->id,
                'user_id' => $eImage->user_id,
                'title' => $eImage->title,
                'description' => $eImage->description,
                'tags' => (count($tags) > 0) ? implode(',', $tags) : '',
                'view_key' => $eImage->view_key,
                'is_avatar' => $eImage->is_avatar,
                'url' => $this->createAbsoluteUrl('/' . basename(Yii::app()->params['paths']['image']) . '/' . $eImage->filename),
                'views' => $eImage->views,
                'stars' => $eImage->rating,
                'created_on' => strtotime($eImage->created_on),
                'updated_on' => strtotime($eImage->updated_on),
                'eUser' => $this->cleanseUser($this->eUser) // todo - weird bug when using eImage->user here
            );
            
        }

        if (count($output) > 0) {
            return $output;
        } else {
            return NULL;
        }
    }
    
    /**
     * Attempts to upload and process an eImage
     * based on $_POST and $_FILES (Yii handles $_FILES)
     * @return bool|null
     */
    private function imageUpload() {

        $model = new FormMobileImageUpload;
        
        if (isset($_POST['eImage'])) {
            
            $model->attributes = $_POST['eImage'];       
            $model->image = CUploadedFile::getInstanceByName('eImage[image]');
 
            if (!$model->validate()) {
                $this->throwException(400, $this->getErrorFromModels(array($model)));
            }
            
            $eImage = new eImage();
            $eImage->user_id = $this->eUser->id;
            $eImage->title = $model->title;
            $eImage->description = $model->description;
            $eImage->source = 'mobile';
            $eImage->arbitrator_id = $this->eUser->id;
            //$eImage->is_avatar = $model->is_avatar;
            $eImage->is_avatar = 0;
            $eImage->watermarked = 0;

            if ($eImage->to_twitter == '1') {
                if (eUserTwitter::model()->countByAttributes(array('user_id' => $this->eUser->id)) == 0) {//no connection to twitter
                    $eImage->to_twitter = 0;
                }
            }
            if ($eImage->to_facebook == '1') {
                if (eUserFacebook::model()->countByAttributes(array('user_id' => $this->eUser->id)) == 0) {//no connection to facebook
                    $eImage->to_facebook = 0;
                }
            }
            
            //by philip we need to differentiate between avator and not avator, avatar might be set to auto approve where image might not be
            if($eImage->is_avatar == 1) {
                if(Yii::app()->params['image']['autoApproveAvatar']) {
                    $eImage->status = 'accepted';
                    
                    if(Yii::app()->params['image']['useExtendedFilters']) {
                        $eImage->extendedStatus['accepted'] = true;
                        $eImage->extendedStatus['new_tv'] = true;
                    }
                }
                else {
                    $eImage->status = 'new';
                }
                
                // set all previous avatars to 0
                eImage::model()->updateAll(array( 'is_avatar' => 0 ), 'user_id = '.$this->eUser->id.' AND is_avatar = 1');
            }
            else {
                if(Yii::app()->params['image']['autoApprove']) {
                    $eImage->status = 'accepted';
                    
                    if(Yii::app()->params['image']['useExtendedFilters']) {
                        $eImage->extendedStatus['accepted'] = true;
                        $eImage->extendedStatus['new_tv'] = true;
                    }
                }
                else {
                    $eImage->status = 'new';
                }
            }
            
            
//            if(Yii::app()->params['image']['autoApproveAvatar'] || Yii::app()->params['image']['autoApprove']) {
//                $eImage->status = 'accepted';
//                
//                if($eImage->is_avatar == 1) {
//                    // set all previous avatars to 0
//                    eImage::model()->updateAll(array( 'is_avatar' => 0 ), 'user_id = '.$this->eUser->id.' AND is_avatar = 1');
//                }
//                
//                if(Yii::app()->params['image']['useExtendedFilters']){
//                    $eImage->extendedStatus['accepted'] = true;
//                    $eImage->extendedStatus['new_tv'] = true;
//                }
//            } else {
//                $eImage->is_avatar = 0;
//                $eImage->status = 'new';
//            }
            
            $eImage->filename = $this->eUser->id . "_" . md5(uniqid('',true) . $model->image) . '.' . strtolower($model->image->extensionName);
            $model->image->saveAs(Yii::app()->params['paths']['image'] . "/" . $eImage->filename);
            
            // rotate image if jpeg
            ImageUtility::orientateImage(Yii::app()->params['paths']['image'] . "/" . $eImage->filename);
            
            if ($eImage->save()) {

                $output = array(
                    'id' => $eImage->id,
                    'user_id' => $eImage->user_id,
                    'title' => $eImage->title,
                    'description' => $eImage->description,
                    //'tags' => (count($tags) > 0) ? implode(',', $tags) : '',
                    'view_key' => $eImage->view_key,
                    'is_avatar' => $eImage->is_avatar,
                    'url' => $this->createAbsoluteUrl('/' . basename(Yii::app()->params['paths']['image']) . '/' . $eImage->filename),
                    'views' => $eImage->views,
                    'stars' => $eImage->rating,
                    'created_on' => strtotime($eImage->created_on),
                    'updated_on' => strtotime($eImage->updated_on),
                    'eUser' => $this->cleanseUser($eImage->user)
                        );
                return $output;
            } else {
                $this->throwException(400, $this->getErrorFromModels(array($eImage)));
            }
        } else {
            return NULL;
        }
    }
    
    /**
     * Attempts to retrieve currently active polls with answers and response tallies.
     * @return array|null
     */
    public function pollsGet() {
        $ePolls = ePoll::model()->current()->with(array('pollAnswers', 'pollResponses'))->questionType()->findAll();
        
        if(!is_null($ePolls)) {
            $output = array();
            
            foreach($ePolls as $ePoll) {
                $ePollAnswers = array();
                $tally = $ePoll->tally();
                
                foreach($ePoll['pollAnswers'] as $ePollAnswer) {

                    $ePollAnswers[] = array('id' => $ePollAnswer->id,
                                           'poll_id' => $ePollAnswer->poll_id,
                                           'answer' => $ePollAnswer->answer,
                                           'color' => $ePollAnswer->color,
                                           'tally' => $ePollAnswer->tally(),
                                           'point_value' => $ePollAnswer->point_value,
                                           'created_on' => strtotime($ePollAnswer->created_on),
                                           'updated_on' => strtotime($ePollAnswer->updated_on),
                                           );
                }
                
                $output[] = array(
                    'id' => $ePoll->id,
                    'question' => $ePoll->question,
                    'tally' => $tally,
                    'start_time' => strtotime($ePoll->start_time),
                    'end_time' => strtotime($ePoll->end_time),
                    'created_on' => strtotime($ePoll->created_on),
                    'updated_on' => strtotime($ePoll->updated_on),
                    'ePollAnswers' => $ePollAnswers
                );
            }
            return $output;
        }
        
        return NULL;
    }
    
    /**
     * Retrieve questions for videos and tickers.
     * @param type $type (video/ticker)
     * @param type $limit
     * @param type $offset
     * @return Array|null
     */
    public function topicsGet($type = NULL, $topic_id = NULL, $limit = 10, $offset = 0) {
        $criteria = new CDbCriteria();
        $criteria->limit = $limit;
        $criteria->offset = $offset;
        
        if(!is_null($topic_id)) {
            $eTopicObject = eQuestion::model()->findByPk($topic_id);
            $eTopicResponseObjects = eTicker::model()->accepted()->with('user')->recent()->findAllByAttributes(Array('question_id' => $topic_id), $criteria);
            
            if (!is_null($eTopicObject) && !is_null($eTopicResponseObjects)) {
                  if($eTopicObject->is_ticker == 0) {
                      $tally = $eTopicObject->videoTally();
                  } else {
                      $tally = $eTopicObject->tickerTally();
                  }

                  $output1 = array(
                      'id' => $eTopicObject->id,
                      'question' => $eTopicObject->question,
                      'hashtag' => $eTopicObject->hashtag,
                      'tally' => $tally,
                      'created_on' => strtotime($eTopicObject->created_on),
                  );
                  
                  $output2 = array();
                  foreach($eTopicResponseObjects as $eTopicResponseObject) {
                      $output2[] = array(
                        'id' => $eTopicResponseObject->id,
                        'topic_id' => $topic_id,
                        'avatar' => TickerUtility::getAvatar($eTopicResponseObject),
                        'ticker' => $eTopicResponseObject->ticker,
                        'created_on' => strtotime($eTopicResponseObject->created_on),
                      );
                  }
                
              return array('eTopic' => $output1, 
                           'eTopicResponses' => $output2);
            }
            return NULL;
        } else {
            $eTopicObjects = eQuestion::model()->{$type}()->current()->orderByIDDesc()->findAll($criteria);
            if (!is_null($eTopicObjects)) {
                $output = array();
                foreach ($eTopicObjects as $eTopicObject) {
                  if($type == 'ticker') {
                      $tally = $eTopicObject->tickerTally();
                  } else {
                      $tally = $eTopicObject->videoTally();
                  }
                  $output[] = array(
                      'id' => $eTopicObject->id,
                      'question' => $eTopicObject->question,
                      'hashtag' => $eTopicObject->hashtag,
                      'tally' => $tally,
                      'created_on' => strtotime($eTopicObject->created_on),
                  );
                }
              return $output;
            }
            return NULL;
        }
    }
    
    /**
     * Attempts to post a response to a ticker question.
     * based on $_POST
     * @return array|null
     */
    private function postTopicResponse() {

        $model = new eTicker;
        
        if (isset($_POST['eTopicResponse'])) {
            //$model->attributes = $_POST['eTopicResponse'];
            $model->question_id = $_POST['eTopicResponse']['topic_id'];
            $model->ticker = $_POST['eTopicResponse']['response'];
            $model->type = 'ticker';
            $model->user_id = $this->eUser->id;
            $model->source = 'mobile';
            $model->to_web = 1;
            $model->arbitrator_id = $this->eUser->id;

            if ($model->save()) {        
                $output = array(
                    'id' => $model->id,
                    'user_id' => $model->user_id,
                    'question_id' => $model->question_id,
                    'ticker' => $model->ticker,
                    'created_on' => strtotime($model->created_on),
                    'updated_on' => strtotime($model->updated_on),
                    'eUser' => $this->cleanseUser($model->user)
                        );
                return $output;
            
            } else {
                $this->throwException(400, $this->getErrorFromModels(array($model)));
            }
        } else {
            return NULL;
        }
    }
    
    /**
     * Attempts to post a response to a poll.
     * based on $_POST
     * @return array|null
     */
    private function postPollResponse() {

        $model = new ePollResponse;
        
        if (isset($_POST['ePollResponse'])) {
            $model->attributes = $_POST['ePollResponse'];
            $model->user_id = $this->eUser->id;
            $model->source = 'mobile';
            
            // make sure response is for question provided
            $ePollAnswer = ePollAnswer::model()->findAllByAttributes(array('poll_id' => $model->poll_id));
            if(empty($ePollAnswer)) {
                $this->throwException(400, self::cResponsePollIdInvalid);
            }
            
            $answerArray = array();
            foreach($ePollAnswer as $answer) {
                $answerArray[] = $answer->id;
            }
            
            if(!in_array($model->answer_id, $answerArray)) {
                $this->throwException(400, self::cResponsePollAnswerOutOfRange);
            }

            if ($model->save()) {        
                $output = array(
                    'id' => $model->id,
                    'user_id' => $model->user_id,
                    'poll_id' => $model->poll_id,
                    'answer_id' => $model->answer_id,
                    'created_on' => strtotime($model->created_on),
                    'updated_on' => strtotime($model->updated_on),
                    'eUser' => $this->cleanseUser($model->user)
                        );
                return $output;
            
            } else {
                $this->throwException(400, $this->getErrorFromModels(array($model)));
            }
        } else {
            return NULL;
        }
    }
    
    /**
     * Attempt to retrieve a users avatar image
     * @return string
     */
    private function getAvatar() {
        $avatar = UserUtility::getAvatar($this->eUser);
        if(!strstr($avatar, 'http')) {
            $avatar = Yii::app()->createAbsoluteUrl('').$avatar;
        }
        return array('avatar' => $avatar);
    }
    
    /** 
     * Attempt to set an image as a users avatar
     * @param type $id
     * @return null
     */
    private function setAvatar($id) {
        $eImage = eImage::model()->with('rating', 'views')->findByPk($id);
        if (!is_null($eImage)) {
            $this->verifyOwnership($eImage->user_id);
            
            // make sure image is accepted
            if($eImage->status != 'accepted') {
                $this->throwException(400, 'Image must first be approved by an admin.');
            }
            $eImage->is_avatar = 1;
            $eImage->updated_on = new CDbExpression('NOW()');
            $eImage->save();
            $output =  array('eImage' => $eImage,
                             'eUser' => $this->cleanseUser($this->eUser));
            return $output;
        } else {
            return NULL;
        }
    }

    /**
     * ********************************************************
     * Begin actions
     * ******************************************************** 
     */

    /**
     * Retrieve static content
     * @param type $type
     */
    public function actionStaticContent($type=NULL) {

        $types = array('termsofservice', 
                       'privacypolicy', 
                       'yttpatents',
                       'ytttermsofservice',
                       'yttprivacypolicy',
                       'about');
        
        if(is_null($type) || !in_array($type, $types)) {
            $this->throwException(405);
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            switch($type) {
                case 'termsofservice':
                case 'privacypolicy':
                case 'about':
                    $fileUrl = Yii::app()->createAbsoluteUrl('') . '/webassets/txt/' . $type . '.txt';
                    break;
                case 'yttpatents';
                case 'ytttermsofservice':
                case 'yttprivacypolicy':
                    $fileUrl = Yii::app()->createAbsoluteUrl('') . '/core/webassets/txt/' . $type . '.txt';
                    break;
                
                default:
                    $this->throwException(405);
                    break;
            }
            
            $staticContent = @file_get_contents($fileUrl);
            if(!$staticContent) {
                $this->throwException(400, $type . ': Static content could not be located on the server.');
            }
            
            $output = array('eStaticContent' => $staticContent);
            $this->renderOutput($output);
        }
        
        $this->throwException(405);
    }
    
    /**
     * Adds, retrieves or updates an eVideo record. Expects GET or POST.
     * @param type $user_id
     * @param type $id
     * @param type $limit
     * @param type $offset
     */
    public function actionVideos($user_id = NULL, $id = NULL, $limit = 10, $offset = 0) {

        if (!is_null($user_id) && !is_numeric($user_id)) {
            $this->throwException(400, 'User ID must be numeric.');
        }

        if (!is_null($id) && !is_numeric($id)) {
            $this->throwException(400, 'ID must be numeric.');
        }

        if (!is_numeric($limit)) {
            $this->throwException(400, 'Limit must be numeric.');
        }

        if (!is_numeric($offset)) {
            $this->throwException(400, 'Offset must be numeric.');
        }

        $this->validateToken();

        switch ($_SERVER['REQUEST_METHOD']) {
            // retrieve eVideos
            case 'GET':

                // get all of a users eVideos
                if (!is_null($user_id)) {
                    $eVideoObjects = $this->videosGet($user_id, NULL, $limit, $offset);
                } elseif (!is_null($id)) {
                    // get eVideo by id
                    $eVideoObjects = $this->videosGet(NULL, $id, NULL, NULL);
                } else {
                    // get all eVideos regardless of user
                    $eVideoObjects = $this->videosGet(NULL, NULL, $limit, $offset);
                }

                if (!is_null($eVideoObjects)) {
                    $output = array('eVideos' => $eVideoObjects);
                    $this->renderOutput($output);
                }
                $this->throwException(400);
                break;

            // uploading an eVideo
            case 'POST':

                $eVideoObject = $this->videoUpload();
                if (!is_null($eVideoObject)) {
                    $output = array('eVideo' => $eVideoObject);
                    $this->renderOutput($output);
                }
                $this->throwException(400);
                break;

            // we do not allow deletion of videos
            case 'DELETE':
                $this->throwException(403);
                break;

            default:
                $this->throwException(400);
                break;
        }

        $this->throwException(400);
    }

    /**
     * Adds, retrieves or updates eUser, eUserEmail and eUserLocation objects. 
     * Expects GET or POST. If user id is null, and method is post, performs insert.
     * If user id not null, and method is post, performs update.
     * @param type $user_id
     */
    public function actionUsers($user_id = null) {

        if (!is_null($user_id)) {
            $this->validateToken();
            $this->verifyOwnership($user_id);
        }

        switch ($_SERVER['REQUEST_METHOD']) {
            // retrieve eUser, eUserEmail and eUserLocation objects
            case 'GET':
                $eUserObjects = $this->userGet($user_id);
                $eUser = $eUserObjects['eUser'];
                $eUserLocation = $eUserObjects['eUserLocation'];
                $eUserEmail = $eUserObjects['eUserEmail'];
                if (!is_null($eUser) && !is_null($eUserLocation) && !is_null($eUserEmail)) {

                    $output = array('eUser' => $eUser,
                        'eUserLocation' => $eUserLocation,
                        'eUserEmail' => $eUserEmail);
                    ;
                    $this->renderOutput($output);
                }
                $this->throwException(400);
                break;

            // add/update eUser, eUserEmail and eUserLocation objects
            // todo - add update password
            case 'POST':
                if ($this->authenticated) {
                    // update eUser, eUserEmail and eUserLocation objects
                    $eUserObjects = $this->userUpdate($user_id);
                    if (!is_null($eUserObjects)) {
                        $output = $eUserObjects;
                        $this->renderOutput($output);
                    }
                    $this->throwException(400);
                } else {
                    // add eUser, eUserEmail and eUserLocation objects

                    $eUserObjects = $this->userAdd();
                    if (!is_null($eUserObjects)) {
                        $output = $eUserObjects;
                        $this->renderOutput($output);
                    }

                    $this->throwException(400, self::cResponseUserRegistrationInsufficient);
                }
                break;

            // we do not allow deletion of users
            case 'DELETE':
                $this->throwException(403);
                break;

            default:
                $this->throwException(400);
                break;
        }

        $this->throwException(400);
    }
    
    
    
    /**
     * Attempt to retrieve a users avatar image
     */
    public function actionAvatar() {
        $this->validateToken();

        switch ($_SERVER['REQUEST_METHOD']) {
            // retrieve eImages
            case 'GET':
                $eImageObject = $this->getAvatar();
                if (!is_null($eImageObject)) {
                    $output = array('eImages' => $eImageObject);
                    $this->renderOutput($output);
                }
                $this->throwException(400);
                break;

            case 'POST':
            case 'DELETE':
                $this->throwException(403);
                break;

            default:
                $this->throwException(400);
                break;
        }
        $this->throwException(400);
    }
    
    /**
     * Adds, retrieves or updates an eImage record. Expects GET or POST.
     * @param type $user_id
     * @param type $id
     * @param type $limit
     * @param type $offset
     */
    public function actionImages($user_id = NULL, $id = NULL, $limit = 10, $offset = 0) {

        if (!is_null($user_id) && !is_numeric($user_id)) {
            $this->throwException(400, 'User ID must be numeric.');
        }

        if (!is_null($id) && !is_numeric($id)) {
            $this->throwException(400, 'ID must be numeric.');
        }

        if (!is_numeric($limit)) {
            $this->throwException(400, 'Limit must be numeric.');
        }

        if (!is_numeric($offset)) {
            $this->throwException(400, 'Offset must be numeric.');
        }

        $this->validateToken();

        switch ($_SERVER['REQUEST_METHOD']) {
            // retrieve eImages
            case 'GET':

                // get all of a users eImages
                if (!is_null($user_id)) {
                    $eImageObjects = $this->imagesGet($user_id, NULL, $limit, $offset);
                } elseif (!is_null($id)) {
                    // get eImage by id
                    $eImageObjects = $this->imagesGet(NULL, $id, NULL, NULL);
                } else {
                    // get all eImages regardless of user
                    $eImageObjects = $this->imagesGet(NULL, NULL, $limit, $offset);
                   
                }

                if (!is_null($eImageObjects)) {
                    $output = array('eImages' => $eImageObjects);
                    $this->renderOutput($output);
                }
                $this->throwException(400);
                break;

            // uploading an eImage / setting image as avatar
            case 'POST':
                
                if(isset($_POST['eImage'])) {
                    $eImageObject = $this->imageUpload();
                    if (!is_null($eImageObject)) {
                        $output = array('eImage' => $eImageObject);
                        $this->renderOutput($output);
                    }
                    $this->throwException(400);
                } else {
                    $eImageObject = $this->setAvatar($id);
                    if (!is_null($eImageObject)) {
                        $output = $eImageObject;
                        $this->renderOutput($output);
                    }
                    $this->throwException(400);
                }
                break;

            // we do not allow deletion of videos
            case 'DELETE':
                $this->throwException(403);
                break;

            default:
                $this->throwException(400);
                break;
        }

        $this->throwException(400);
    }
    
    /**
     * Retrieves topics (not sure why we called them questions) 
     * for tickers and videos. Expects GET.
     * @param type $type
     * @param type $limit
     * @param type $offset
     */
    public function actionTopics($type = NULL, $topic_id = NULL, $limit = 10, $offset = 0) {
        
        if (!is_null($type) && !in_array($type, array('ticker','video'))) {
            $this->throwException(400, 'Unrecognized topic type.');
        }
        
        if (!is_null($topic_id) && !is_numeric($topic_id)) {
            $this->throwException(400, 'Topic id must be numeric.');
        }
        
        if (!is_numeric($limit)) {
            $this->throwException(400, 'Limit must be numeric.');
        }

        if (!is_numeric($offset)) {
            $this->throwException(400, 'Offset must be numeric.');
        }

        $this->validateToken();

        switch ($_SERVER['REQUEST_METHOD']) {
            // retrieve eQuestions (really topics)
            case 'GET':
                
                if(!is_null($topic_id)) {
                    $eTopicResponseObjects = $this->topicsGet(NULL, $topic_id, $limit, $offset);
                    if (!is_null($eTopicResponseObjects)) {
                        $output = array('eTopic' => $eTopicResponseObjects['eTopic'],
                                        'eTopicResponses' => $eTopicResponseObjects['eTopicResponses']);
                        $this->renderOutput($output);
                    }
                    $this->throwException(400);
                } else {
                    $eTopicObjects = $this->topicsGet($type, NULL, $limit, $offset);
                    if (!is_null($eTopicObjects)) {
                        $output = array('eTopics' => $eTopicObjects);
                        $this->renderOutput($output);
                    }
                    $this->throwException(400);
                }
                break;
                
            case 'POST':
                $eTopicResponse = $this->postTopicResponse();
                if (!is_null($eTopicResponse)) {
                    $output = array('eTopicResponse' => $eTopicResponse);
                    $this->renderOutput($output);
                }
                $this->throwException(400);
                break;

            default:
                $this->throwException(400);
                break;
        }

        $this->throwException(400);
    }

    /**
     * Retrieves polls with associated answers and response tallies.
     * Expects GET and POST.
     */
    public function actionPolls() {
        $this->validateToken();

        switch ($_SERVER['REQUEST_METHOD']) {
            // retrieve polls
            case 'GET':
                $ePollObjects = $this->pollsGet();
                if (!is_null($ePollObjects)) {
                    $output = array('ePolls' => $ePollObjects);
                    $this->renderOutput($output);
                }
                $this->throwException(400);
                break;
                
            case 'POST':
                $ePollResponse = $this->postPollResponse();
                if (!is_null($ePollResponse)) {
                    $output = array('ePollResponse' => $ePollResponse);
                    $this->renderOutput($output);
                }
                $this->throwException(400);
                break;

            default:
                $this->throwException(400);
                break;
        }

        $this->throwException(400);
    }
    
    /**
     * Process for recovering a user account
     * Expects POST
     */
    public function actionRecover() {
        $model = new eUser;
        
        if (isset($_POST['eUserEmail'])) {            
            $model->username = $_POST['eUserEmail']['email'];
            if ($model->validate()) {
                $userRecord = $model->findByAttributes(array('username' => $model->username));
                $userEmail = eUserEmail::model()->findByAttributes(array('user_id' => $userRecord->id));
                
                $reset = new eUserReset;
                $reset->user_id = $userRecord->id;
                $reset->key = sha1(uniqid());
                $reset->expired = 0;
                
                if ($reset->save()) {
                    $result = MailUtility::send('password', $userEmail->email, array('link' => Yii::app()->createAbsoluteUrl("forgot/{$reset->key}", array())), false);
                    if ($result) {
                        $output = array('eUser' => $this->cleanseUser($userRecord));
                        $this->renderOutput($output);
                    } else {
                        $this->throwException(400, 'Unable to send email.');
                    }
                } else {
                    $this->throwException(400, $this->getErrorFromModels(array($reset)));
                }
            } else {
                $this->throwException(400, $this->getErrorFromModels(array($model)));
            }
        } else {
            $this->throwException(400);
        }        
    }
    
    public function actionConnectFb() {
        
        $model = new FormMobileConnectFacebook();
        if (isset($_POST['eUserFacebook'])) { 
            $model->attributes = $_POST['eUserFacebook'];
            
            if($model->validate()) {
                $fb = eUserFacebook::model()->with('user')->findByAttributes(array('access_token' => $model->access_token));
                
                if(!is_null($fb)) {
                    $output = array('eUser' => $this->cleanseUser($fb->user));
                    $this->renderOutput($output);
                } else {
                    print 'cant find';
                }
            } else {
                $this->throwException(400, $this->getErrorFromModels(array($model)));
            }
            
        } else {
            $this->throwException(400);
        }
    }
    
    
    public function actionTest() {
        $headers = array();
    foreach($_SERVER as $key => $value) {
        if (substr($key, 0, 5) <> 'HTTP_') {
            continue;
        }
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
    }
    //print_r($headers);
    
    print $_SERVER['HTTP_TOKEN'];
        exit;
    }
    /*
     * >
> authorizeWithFacebook
> authorizeWithTwitter
> getStaticContent[GET]
> getAppConfig[GET]
> getAd[GET]
     */
}
