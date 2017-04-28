<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
require('constants.php');
//require(Yii::getPathOfAlias('core').'/config/constants.php');

//require(Yii::getPathOfAlias('core') . '/config/constants.php');
$docroot = dirname(dirname(dirname(__FILE__)));
$config = require_once "env_manager.php";

$client = basename($docroot);
$dev =  '';
if (getenv('YOUTOO_ENVIRONMENT') == "aws-development") {
    $dev = basename(dirname($docroot));
}

return array(
    'commandPath' => Yii::getPathOfAlias('core').'/commands',
    'import' => array(
        'core.models.*',
        'core.components.*',
        'core.components.utilities.*',
        'client.models.*',
    ),
    //'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name' => ucfirst($client),
    'timeZone' => 'America/New_York',
    // preloading 'log' component
    'preload' => array('log'),
    // application components
    'components' => array(
        'db' => array(
            'connectionString' => "mysql:host={$config->db_host};dbname={$config->db_name}",
            'emulatePrepare' => true,
            'schemaCachingDuration' => 3600,
		'username' => $config->db_user,
            'password' => $config->db_pass,
            'charset' => 'utf8',
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
                'consumer_key' => 'RChO1lBGkJvQTZhOgjbw8A',
                'consumer_secret' => 'NLD9sTbY1YLWz7SbvSNvQ80RTRBfoRGvAluYYJZy8',
                'callback' => 'http://' . $_SERVER['HTTP_HOST'] . '/twitterConnect',
                'streamFile'=>$_SERVER['DOCUMENT_ROOT'].'/twitter.txt',
                'adminAccessToken' =>'1967328594-hg0MWwc1GtYkdnfQUyOnrruBx3gDrzRCRWRpydB',
                'adminTokenSecret' =>'HnyF8uzVKxU1I6iR55iHOCjTtrCYOiasYXkMATPmE',
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        'docroot' => $docroot,
        'paths' => array(
            'video' => $docroot. '/uservideos',
        ),
        'video' => array(
            'postExt' => '.mp4',
            'useExtendedFilters' => true,
        ),
        'dev' => $dev,
        'client' => $client,
        'ticker' => array(
            'sleepTime' => 10,
        ),
    ),
);