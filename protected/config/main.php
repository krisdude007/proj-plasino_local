<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
// left this for backwards compatibility
//require('constants.php');

$config = require_once "env_manager.php";
$config_array = array(
    'import' => array(
        'client.models.*',
        'client.components.*',
    ),
    //'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name' => 'Playsino-iSweepsUSA',
    'timeZone' => 'America/Chicago',
    // preloading 'log' component
    'preload' => array('log'),
    'sourceLanguage' => 'en_us',
    'language' => 'en',
    // application components
    'components' => array(
        'messages' => array(
            'basePath' => 'protected/messages',
            'onMissingTranslation' => array('MissingTranslation', 'handler'),
        ),
        'yexcel' => array(
            'importFile' => $_SERVER['DOCUMENT_ROOT'] . '/trivia_game_questions',
            'class' => 'ext.yexcel.Yexcel'
        ),
        'clientScript' => array(
            'packages' => array(
                'jquery' => array(
                    'baseUrl' => '/core/webassets/js',
                    'js' => array('jquery-1.8.3.min.js'),
                    'coreScriptPosition' => CClientScript::POS_HEAD
                ),
            ),
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl' => array('user/login'),
            'class' => 'WebUser',
            'autoUpdateFlash' => false,
        ),
        'request' => array(
            'csrfTokenName' => 'CSRF_TOKEN',
            'enableCsrfValidation' => false,
            'enableCookieValidation' => true,
            'class' => 'HttpRequest',
        //'class' => 'application.components.GHttpRequest',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'showScriptName' => false,
            'urlFormat' => 'path',
            'rules' => array(
                '/' => '/site/index',
                'paypal' => '/site/paypal',
                'marketingpage' => '/site/marketingpage',
                'marketingpage/<id:\d+>' => '/site/marketingpage',
                'marketingpage2' => '/site/marketingpage2',
                'marketingpage2/<id:\d+>' => '/site/marketingpage2',
                'payandplay' => '/site/payandplay',
                'newpayandplay' => '/site/newpayandplay',
                'geocoordinates' => '/site/geocoordinates',
                'gametrivia' => '/game/gametrivia',
                'geocoordinatesshare' => '/site/geocoordinatesshare',
                'geocoordinates/<id:\d+>' => '/site/geocoordinates',
                'geocoordinatesshare/<id:\d+>' => '/site/geocoordinatesshare',
                'testgame' => '/site/testgame',
                'contestrules' => '/user/rules',
                'confirmation' => '/site/confirmation',
                'gameredirect' => '/site/gameredirect',
                'barcode/<id:\w+>' => '/site/barcode/',
                'printreceipt' => '/site/printReceipt',
                'testresults' => '/site/testResults',
                'cannotplay' =>  '/site/cannotplay',
                'site/index' => '/site/payandplay',
                'contact' => '/site/contact',
                'freecredit' => '/site/freecredit',
                'multiplechoice/<id:\d+>' => '/game/multiple4',
                'thankyoumobile' => '/game/thankyoumobile',
                'thankyou' => '/game/thankyou',
                'continue' => '/game/thankyou',
                'continue/<id:\d+>' => '/game/thankyou',
                'continuepaid' => '/game/paidthankyou',
                'continuepaid/<id:\d+>' => '/game/paidthankyou',
                'winlooseordraw' => '/game/winlooseordraw',
                'winlooseordraw/<id:\d+>' => '/game/winlooseordraw',
                'pickgame' => '/game/pickgame',
                'payviapaypal' => 'site/payviapaypal',
                'payviapaypal/<id:\d+>' => 'site/payviapaypal',
                'howtoplay' => '/site/howtoplay',
                'baldiniscontact' => '/user/baldiniscontact',
                'customerror' => '/site/customerror',
                'redeem' => '/site/redeem',
                'activity' => '/user/activity',
                'redeemtw/<i:\d+>' => '/site/redeem',
                'payPrepapproval/<id:\d+>' => '/payment/payPrepapproval',
                'payment' => '/payment/index2',
                'expressCheckOut/<modelName:\w+>/<amount:\w+>/<prizeId:\d+>' => '/payment/expressCheckOut',
                'expressCheckOut/<amount:\w+>' => '/payment/expressCheckOut',
                'expressCheckOut/<amount:\w+>/<id:\d+>' => '/payment/expressCheckOut',
                'payprocess/<modelName:\w+>/<id:\d+>' => '/payment/payprocess',
                'payprocess/<modelName:\w+>' => '/payment/payprocess',
                'prizes' => '/site/prizes',
                'processstripeprepay' => '/payment/processstripeprepay',
                'processpaypalprepay' => '/payment/processpaypalprepay',
                'processstripeproduct/<id:\d+>' => '/payment/processstripeproduct',
                'processpaypaldirect/<modelName:\w+>/<id:\d+>' => '/payment/processpaypaldirect',
                'processpaypalproduct/<id:\d+>' => '/payment/processpaypalproduct',
                'paymentdone/thankyou' => '/payment/thankyou',
                'paymentdone/thankyou/<id:\d+>' => '/payment/thankyou',
                'cancelpayment' => 'payment/cancelpayment',
                'cancelpayment/thankyou/<modelName:\w+>/<id:\d+>' => '/payment/thankyou',
                //'payment' => '/actel/payment',
                'paymentsaved' => 'actel/paymentsaved',
                'paymentthankyou' => '/actel/paymentthankyou',
                'paidiscorrect' => '/actel/thankyou',
                'paidisincorrect' => '/actel/sorry',
                'getsms' => '/actel/getsms',
                'getuserstatus' => '/actel/getuserstatus',
                'gamesms' => '/actel/gamesms',
                //'testserverload' => '/site/index',
                'testupload' => '/video/testupload',
                'sendsms' => '/actel/sendsms',
                'redeem/<id:\d+>' => '/site/redeemPrize',
                'winners' => '/site/winners',
                'confirmation' => '/site/confirmation',
                'connections' => '/user/connections',
                'thanks' => '/video/thanks',
                'help' => '/user/help',
                'capture' => '/video/capture',
                'process/<id:\d+>' => '/video/process',
                'register' => '/user/register',
                'register/<id:\d+>' => '/user/register',
                'silentlogin' => '/user/registerimported',
                'silentlogin/<id:\d+>' => '/user/registerimported',
                'silentlogin/email:\w+' => '/user/registerimported',
                'registerold' => '/user/registerold',
                'registerpay' => '/user/registerpay',
                'login' => '/user/login',
                'login/<id:\d+>' => '/user/login',
                //'loginold' => '/user/loginold',
                'loginpay' => '/user/loginpay',
                'logout' => '/user/logout',
                'getpassword/<key:\w+>' => '/user/getpassword',
                'getpassword' => '/user/getpassword',
                //'forgot/<key:\w+>' => '/user/forgot',
                'forgot' => '/user/forgot',
                'videos' => '/video/index',
                'videos/<order:\w+>' => '/video/index',
                'videoupload/<id:\d+>' => '/video/videoupload',
                'play/<view_key:\w+>' => '/video/play',
                'images' => '/image/index',
                'images/<order:\w+>' => '/image/index',
                'viewimage/<view_key:\w+>' => '/image/view',
                'vote/<id:\d+>' => '/poll/index',
                'vote' => '/poll/index',
                'user' => '/user/index',
                'faq' => '/site/faq',
                'termsofuse' => '/user/termsofuse',
                'privacypolicy' => '/user/privacypolicy',
                'terms' => '/user/termsoverlay',
                'privacy' => '/user/privacyoverlay',
                'mobilePrivacy' => '/user/mobilePrivacy',
                'mobileTerms' => '/user/mobileTerms',
                'user/<order:recent|views|rating>' => '/user/index',
                'user/<action:\w+>' => '/user/<action>',
                'record/<id:\d+>' => '/video/record',
                'record' => '/video/record',
                'upload/<id:\d+>' => '/image/upload',
                'upload' => '/image/upload',
                'videoupload/<id:\d+>' => '/video/videoupload',
                'videoupload' => '/video/videoupload',
                'questions' => '/question/index',
                'ticker' => '/ticker/index',
                'user/<id:\d+>' => '/user/view',
                'user/video/<id:\d+>' => '/user/video',
                'user/image/<id:\d+>' => '/user/image',
                'user/video/<id:\d+>/<order:\w+>' => '/user/video',
                'user/image/<id:\d+>/<order:\w+>' => '/user/image',
                'user/<id:\d+>/<order:\w+>' => '/user/view',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'db' => array(
            'connectionString' => "mysql:host={$config->db_host};dbname={$config->db_name}",
            'schemaCachingDuration' => 3600,
            'emulatePrepare' => true,
            'username' => $config->db_user,
            'password' => $config->db_pass,
            'charset' => 'utf8',
        ),
        'cache' => array(
            'class' => 'system.caching.CMemCache',
            'servers' => array(
                array(
                    'host' => $config->memcached_host,
                    'port' => $config->memcached_port
                ),
            ),
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
        'twitter' => array(
            'active' => true,
            'advancedFilters' => true,
            'class' => 'ext.yiitwitteroauth.YiiTwitter',
            'accountName' => '',
            'consumer_key' => 'RChO1lBGkJvQTZhOgjbw8A',
            'consumer_secret' => 'NLD9sTbY1YLWz7SbvSNvQ80RTRBfoRGvAluYYJZy8',
            'callback' => 'http://' . $_SERVER['HTTP_HOST'] . '/twitterConnect',
            'streamFile' => $_SERVER['DOCUMENT_ROOT'] . '/twitter.txt',
            'adminAccessToken' => '1967328594-hg0MWwc1GtYkdnfQUyOnrruBx3gDrzRCRWRpydB',
            'adminTokenSecret' => 'HnyF8uzVKxU1I6iR55iHOCjTtrCYOiasYXkMATPmE',
            'filterLatitude' => '37.09024',
            'filterLongitide' => '-95.712891',
            'renderTwitterMetaTags' => false,
            'gamingUserId' => '1967328594',
            'gamingOauthToken' => '1967328594-hg0MWwc1GtYkdnfQUyOnrruBx3gDrzRCRWRpydB',
            'gamingOauthTokenSecret' => 'HnyF8uzVKxU1I6iR55iHOCjTtrCYOiasYXkMATPmE',
        ),
        'facebook' => array(
            'appNamespace' => 'youtoosandbox',
            'pageId' => '745902258779750',
            'class' => 'ext.yii-facebook-opengraph.SFacebook',
            'appId' => '177992429059463', // needed for JS SDK, Social Plugins and PHP SDK
            'secret' => 'ed3e68e1e14fd9d4069040276be986ed', // needed for the PHP SDK
            'fileUpload' => true, // needed to support API POST requests which send files
            //'trustForwarded'=>false, // trust HTTP_X_FORWARDED_* headers ?
            //'locale'=>'en_US', // override locale setting (defaults to en_US)
            //'jsSdk'=>true, // don't include JS SDK
            //'async'=>true, // load JS SDK asynchronously
            //'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
            //'status'=>true, // JS SDK - check login status
            //'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
            //'oauth'=>true,  // JS SDK - enable OAuth 2.0
            //'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
            //'frictionlessRequests'=>true, // JS SDK - enable frictionless requests for request dialogs
            //'html5'=>true,  // use html5 Social Plugins instead of XFBML
            'fbPost' => 'Check out my new video!',
            'videoShareText' => 'Video uploaded via admin.',
            'ogTags' => array(// set default OG tags
                'title' => 'Laliga',
                'description' => 'Laliga',
                'image' => 'http://' . $_SERVER['HTTP_HOST'] . '/images/logo.png',
            ),
        ),
        // access with Yii::app()->Paypal->apiUsername
        'Paypal' => array(
            'active' => true,
            'class' => 'application.components.Paypal',
//            'apiUsername' => 'paypal-facilitator_api1.youtootech.com',
//            'apiPassword' => '8WPA486AHBZ54BZB',
//            'apiSignature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AzjWjeTGR2C3s4tvXBUehoxSVYqM',
            'apiUsername' => 'paypal_api1.youtootech.com',
            'apiPassword' => 'EPTJ4XBE8D63VCCM',
            'apiSignature' => 'A.yVyb8ItK2brt09ekATnTlMNjOTAxhhMzsxR0dPEloXt3iqqDkJSuSt',
            'apiLive' => true,
            'registeredEmail' => 'paypal@youtootech.com',//Required for preapproval pay.
            'appId' => '',//https://developer.paypal.com/docs/classic/api/gs_PayPalAPIs/
            'returnUrl' => 'paypal/confirmPreapproval/', //regardless of url management component
            'cancelUrl' => 'paypal/cancelPreapproval/', //regardless of url management component
            'returnUrlExpress' => 'paypal/confirmExpresspay3/',
            'cancelUrlExpress' => 'paypal/cancelExpresspay3/',
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        'session' => array('durationOffset' => 60 * 5,
            'duration' => 86400),
        'email' => array(
            'title' => 'Plasino EMAIL',
            'mailto' => 'youtootechsupport@youtootech.com',
            'showEmailAssistanceLink' => true,
        ),
        'Stripe' => array(
           'secret_key'      => 'sk_test_sIp96bnKtxz6Rfq8ED9Hd7T0',
           'publishable_key' => 'pk_test_jabbdHFhU7zzRHe2k3H36oCw',
          //'secret_key'      => 'sk_live_vBST257nN2oDh2CZJmLALdUM',
          //'publishable_key' => 'pk_live_oxxbhTzevQdiUUK09F6530AV'
        ),
        'clientIframeUrl' => '',
        'enableSweepstakes' => false,
        'useMobileTheme' => false,
        'enableYtFunctionality' => true,
        'enableUserFunctionality' => true,
        'enableUserPermissions' => false,
        'showUserCountry' => false,
        'noCsrfValidationRoutes' => array('api/importVideoYt', 'facebook/index'),
        /* moved to twitter extension/component
          'twitter' => array(
          'consumerKey'=>'RChO1lBGkJvQTZhOgjbw8A',
          'consumerSecret'=>'NLD9sTbY1YLWz7SbvSNvQ80RTRBfoRGvAluYYJZy8',
          'adminAccessToken' =>'1967328594-hg0MWwc1GtYkdnfQUyOnrruBx3gDrzRCRWRpydB',
          'adminTokenSecret' =>'HnyF8uzVKxU1I6iR55iHOCjTtrCYOiasYXkMATPmE',
          'streamFile'=>$_SERVER['DOCUMENT_ROOT'].'/twitter.txt',
          ),
         * *
         */
        'client' => $subdomain,
        'maxActiveQuestions' => 3,
        'triviaQuestions' => array(
            'maxQuestionsAllowed' => 6,
            
        ),
        'perPage' => 50,
        'currencySymbol' => '$',
        'vine' => array(
            'username' => 'greg.stringer@gmail.com',
            'password' => 'i!ur@ss4o',
            'url' => 'https://api.vineapp.com',
            'ext' => '.mp4',
        ),
        'keek' => array(
            'username' => 'greg.stringer@gmail.com',
            'password' => 'g33m4n',
            'url' => 'https://www.keek.com',
            'url2' => 'https://keek-a.akamaihd.net/keek/video/{VIDEO_ID}/flv',
            'ext' => '.flv',
        ),
        'brightcove' => array(
            'playerID' => '2929404736001',
            'playerKey' => 'AQ~~,AAABqrGtIvE~,QfeoOVnmCtWkqkvPSP8vkpR8r-f6WBvi',
        ),
        /*
         * FTP
         */
        'ftp' => array(
            'server' => '168.215.163.186',
            'port' => 21,
            'secure' => false,
            'passive' => true,
            'user' => 'youtootech',
            'pass' => 'yt121',
            'uploadPath' => '/',
            'uploadPathMxf' => '/',
            'sendVideoXML' => true,
            'sendImageXML' => true,
        ),
        'reporting' => array(
            'showTwitterAmplifyStats' => true,
            'showImageStats' => true,
            'getMobileRegisteredUsers' => true,
            'enableWeeklyReportOnDashBoard' => false,
        ),
        'ticker' => array(
            'allowCreateAsEntity' => false,
            'sleepTime' => 10,
            'breakingTweets' => false,
            'defaultHashtag' => '',
            'defaultEndTime' => time() + 60 * 60 * 24,
            'defaultQuestion' => 0,
            'useExtendedFilters' => true,
            'extendedFilterLabels' => array(array('new' => 'New', 'accepted' => 'Accepted')),
            'superAdminExtendedFilterLabels' => array('denied' => 'Denied'),
        ),
        'video' => array(
            'filePrefix' => '',
            'watermark' => '/webassets/images/watermark.png',
            'watermarkLocation' => 'topRight',
            'duration' => 15,
            'fps' => 30,
            'imageExt' => '.png',
            'preExt' => '.flv',
            'postExt' => '.mp4',
            'flipExt' => '.mov',
            'allowMovUploadToNetwork' => true,
            'allowMxfUploadToNetwork' => false,
            'acceptedFileTypes' => 'mov,m4v,mp4',
            'maxUploadFileSize' => 1024 * 1024 * 30,
            'allowCustomFileNameToNetwork' => false,
            'useEvalForCustomFileName' => false,
            'customFileNamePrefix' => 'TAL',
            'customFileNameExt' => '.mov',
            'customFileNameExtMxf' => '.mxf',
            'customFileNameFormat' => "sprintf('%05d', {INCREMENTED_VALUE});",
            'defaultHashtag' => '',
            'defaultEndTime' => time() + 365 * 60 * 60 * 24,
            'useExtendedFilters' => false,
            'extendedFilterLabels' => array(array('new' => 'New', 'accepted' => 'Accepted')),
            'superAdminExtendedFilterLabels' => array('denied' => 'Denied', 'all' => 'All'),
            'allow3rdPartyImport' => true,
            'allowImportVine' => true,
            'allowImportKeek' => true,
            'allowImportInstagram' => true,
            'adminAllowUpload' => true,
            'adminAllowAdUpload' => true,
            'adminAllowAmplify' => true,
            'autoFtpBasedOnStatus' => false,
            'autoFtpStatuses' => array('accepted'),
        ),
        'ffmpeg' => array(
            'concatParams' => '-q:v 1 -async 1  -r 30 -b:v 2M -bt 4M -vcodec libx264 -preset placebo -g 1 -movflags +faststart -acodec libfdk_aac -ac 2 -ar 48000 -ab 192k',
            'tvParams' => ' -y -i {FILE_INPUT} -s 1920:1080 -vcodec mjpeg -b 20M -s 1920x1080 -r 30000/1001 -acodec pcm_s16le -ar 48000 -y {FILE_OUTPUT}',
            'tvParamsMxf' => ' -y -i {FILE_INPUT} -pix_fmt yuv422p -vcodec mpeg2video -non_linear_quant 1 -flags +ildct+ilme -top 1 -dc 10 -intra_vlc 1 -qmax 3 -lmin "1*QP2LAMBDA" -vtag xd5c -rc_max_vbv_use 1 -rc_min_vbv_use 1 -g 12 -s 720x576 -b:v 50000k -minrate 50000k -maxrate 50000k -bufsize 8000k -f mxf_d10 -acodec pcm_s16le -ar 48000 -bf 2 -ac 2 {FILE_OUTPUT_MXF}',
            'imageToVideoParams' => ' -loop 1 -f image2 -r 29.97 -i {FILE_INPUT} -vcodec libx264 -t 00:00:01 {FILE_OUTPUT} -y',
            'imageToVideoToTvParams' => ' -i {FILE_INPUT} -vcodec libx264 -preset placebo -bufsize 5000 -g 1 -acodec libfdk_aac -ac 2 -ar 48000 -ab 192k -r 30000/1001 {FILE_OUTPUT} -y',
            'imageToVideoWithAudioParams' => ' -i {FILE_INPUT_AUDIO} -i {FILE_INPUT} -map 0:0 -map 1:0 {FILE_OUTPUT} -shortest -y',
            'imageScaleParams' => ' -i {FILE_INPUT} -vf "scale=iw*min(1920/iw\,1080/ih):ih*min(1920/iw\,1080/ih), pad=1920:1080:(1920-iw*min(1920/iw\,1080/ih))/2:(1080-ih*min(1920/iw\,1080/ih))/2" {FILE_OUTPUT} -y',
        ),
        'videoAdmin' => array(
            'perPage' => 12,
            'indicatorThreshold' => array(
                'min' => 0.2,
                'max' => 0.5,
            ),
        ),
        'image' => array(
            'allowImageToVideo' => true,
            'acceptedFileTypes' => 'gif,png,jpg,jpeg',
            'maxUploadFileSize' => 1024 * 1024 * 5,
            'allowCustomFileNameToNetwork' => false,
            'useEvalForCustomFileName' => true,
            'customFileNamePrefix' => 'TAL',
            'customFileNameFormat' => "sprintf('%05d', {INCREMENTED_VALUE});",
            'autoApprove' => false,
            'autoApproveAvatar' => true,
            'useExtendedFilters' => false,
            'extendedFilterLabels' => array(array('new' => 'New', 'accepted' => 'Accepted')),
            'superAdminExtendedFilterLabels' => array('denied' => 'Denied', 'all' => 'All'),
            'thumb-xs' => 80,
            'thumb-sm' => 120,
            'thumb-lg' => 180,
        ),
        'imageAdmin' => array(
            'perPage' => 12,
        ),
        'training' => array(
            'showManual' => false,
        ),
        'analytics' => array(
            'username' => 'lee4youtoo@gmail.com',
            'password' => 'Dallas1101',
            'projectId' => '72166659',
            'startDate' => '2015-01-01',
        ),
        'analyticsTracking' => array(
            'id' => 'UA-25950024-9',
        ),
        'mobileAPI' => array(
            'sessionTimeoutSecs' => 60 * 60,
        ),
        'GamePlay' => array(
          'setGeoLocation' => false,
          'Country' => array('United States','India'),
          'AllowedCity' => array('Hyderabad'),
          'AllowedState' => array('Alabama','Alaska','Arkansas','Colorado',
              'Connecticut','Delaware','District of Columbia','Florida',
              'Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas',
              'Kentucky','Maine','Maryland','Michigan','Minnesota',
              'Mississippi','Missouri','Nebraska','Nevada','New Hampshire',
              'New Jersey','New Mexico','New York','North Carolina',
              'North Dakota','Ohio', 'Oklahoma','Oregon','Pennsylvania',
              'Rhode Island','South Carolina','South Dakota','Tennessee',
              'Texas','Utah','Vermont','Virginia','Washington','West Virginia',
              'Wisconsin','Wyoming'),
            'maxFreeCredits' => 5,
            'freeCreditPrice' => 5,
        ),
        'user' => array(
            'extendedPermissions' => array("new" => "Producer Web", "newtv" => "Producer TV"),),
        'DashboardCounts' => array(
            'video' => false,
            'image' => false,
            'poll' => false,
            'ticker' => false,
                ),
        'features' => array(
            "HAS_USER",
            "HAS_AUDIT",
            "HAS_GAME",
            "HAS_GAME_MULTIPLE_CHOICE",
            "HAS_PRIZES",
            "HAS_CONTACT",
            "HAS_PROMO_CONTROL"
       ),
        'statusBit' => array(
            'new' => 128,
            'accepted' => 64,
            'denied' => 32,
            'newTv' => 16,
            'acceptedTv' => 8,
            'deniedTv' => 4,
            'acceptedSuperAdmin1' => 2,
            'acceptedSuperAdmin2' => 1,),
        'xml' => array(
            'encoding' => 'utf-16',
        ),
        'flashMessage' => array(
            'lowCreditBalance' => Yii::t('youtoo','Not enough credits'),
            'loginSuccess' => Yii::t('youtoo','Welcome back.'),
            'loginError' => Yii::t('youtoo','Username and password invalid.'),
            'profileUpdateSuccess' => Yii::t('youtoo','Thank you, User profile updated.'),
            'avatarUpdateSuccess' => Yii::t('youtoo','Avatar updated successfully.'),
            'avatarUpdateError' => Yii::t('youtoo','Unable to update Avatar.'),
            'error_invalid_type' => 'Invalid image format',
            'image_upload_filetype' => 'jpg, png, gif',
            'registrationSuccess' => Yii::t('youtoo','You have successfully registered. Check your email for confirmation.'),
            'registrationError' => Yii::t('youtoo','Failed to register.'),
            'passwordUpdateSuccess' => Yii::t('youtoo','Your password has been successfully reset.'),
            'tickerSuccess' => 'Ticker saved.',
            'tickerError' => 'Unable to save ticker.',
            'tickerInactive' => 'Ticker is not active.',
            'resetPasswordSuccess' => Yii::t('youtoo','<b>Thank You.</b> An email will be sent shortly with instructions on how to reset your password.'),
            'resetPasswordError' => Yii::t('youtoo','Unable to send a reset password email.'),
            'imageUploadSuccess' => Yii::t('youtoo','Image uploaded successfully.'),
            'videoUploadSuccess' => 'Video uploaded successfully.',
            'invalidFiletype' => Yii::t('youtoo','Invalid file type.'),
        ),
        'global' => array(
        'replaceValue' => 'Playsino',
        ),
        'custom_params' => array(
        'client_support_email' => 'danny.ohman@youtootech.com, bhrobinson@me.com', //CLIENT_SUPPORT_EMAIL
        'toggle_preview_ticker' => false,
        'video_post_file_ext_mxf' => true,
        'invalid_file_size' => Yii::t('youtoo','Invalid File Size'),
        'invalid_file_type' => Yii::t('youtoo','Invalid File Type'),
        ),
        'dashboard_user_map' => '/webassets/images/dashboard-map.jpg'
    ),
);

//if (isset($developer)) {
    $config_array['components']['db']['enableProfiling'] = true;
    $config_array['components']['db']['enableParamLogging'] = true;
    $config_array['components']['log']['routes'][] = array('class' => 'CWebLogRoute', 'levels' => 'error, warning');
    $config_array['components']['log']['routes'][] = array('class' => 'CProfileLogRoute');
//}
return $config_array;

