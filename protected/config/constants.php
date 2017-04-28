<?php

define('SITE_NAME','INITECH');
define('CLIENT_EMAIL_NAME','INITECH EMAIL');
define('CLIENT_TZ', 'America/New_York');

define('MOBILE_WEB_THEME', false);//paste themes/mobile/views/*, allow videoipload/id, past webassets/mobile/*

define('PAYPAL_ACTIVE',false);
define('PAYPAL_USERNAME','kyrie42-facilitator_api1.gmail.com');
define('PAYPAL_PASSWORD','1364840459');
define('PAYPAL_SIGNATURE','AiPC9BjkCyDFQXbSkoZcgqH3hpacAMim7FhqR5hEznOFh8CIior9BSdJ');
define('PAYPAL_API_LIVE',false);
define('PAYPAL_RETURN_URL','paypal/confirm/');
define('PAYPAL_CANCEL_URL','paypal/cancel/');

//This is YoutooSandbox app: http://dev.twitter.com/apps/5239419
//This is YoutooSandbox twitter page: http://www.twitter.com/YoutooSandbox
define('TWITTER_ACTIVE',true);
define('TWITTER_CONSUMER_KEY','RChO1lBGkJvQTZhOgjbw8A');
define('TWITTER_CONSUMER_SECRET','NLD9sTbY1YLWz7SbvSNvQ80RTRBfoRGvAluYYJZy8');
define('TWITTER_ADMIN_ACCESS_TOKEN','1967328594-hg0MWwc1GtYkdnfQUyOnrruBx3gDrzRCRWRpydB');
define('TWITTER_ADMIN_TOKEN_SECRET','HnyF8uzVKxU1I6iR55iHOCjTtrCYOiasYXkMATPmE');
define('TWITTER_ADVANCED_FILTERS', true);

//This is YoutooSandbox app: http://apps.facebook.com/YoutooSandbox
//This is YoutooSandbox facebook page: http://www.facebook.com/YoutooSandbox
define('FACEBOOK_ACTIVE',true);
define('FACEBOOK_APPLICATION_NAMESPACE','youtoosandbox');
define('FACEBOOK_APPLICATION_ID','177992429059463');
define('FACEBOOK_APPLICATION_SECRET','ed3e68e1e14fd9d4069040276be986ed');
define('FACEBOOK_PAGE_ID','430827127022450');

define('BRIGHTCOVE_PLAYER_ID','2929404736001');
define('BRIGHTCOVE_PLAYER_KEY','AQ~~,AAABqrGtIvE~,QfeoOVnmCtWkqkvPSP8vkpR8r-f6WBvi');

define('MAX_ACTIVE_QUESTIONS',3);
define('MODAL_COUNTRY_ADMIN',false);

define('SET_FLASH',true);

define('FTP_SECURE',false);
define('FTP_PASSIVE',true);
define('FTP_PORT',21);
define('FTP_SERVER','ftp.comstarmedia.com');
define('FTP_USER','youtootech1');
define('FTP_PASSWORD','Youtoot3ch#');
define('FTP_PATH','/CAMIOTEST');

define('FTP_XML',true);
define('FTP_XML_IMAGE',false);
define('VIDEO_POST_MOVFILE_ONLY',true);
define('VIDEO_POST_FILE_EXT_MXF',true);
define('FTP_PATH_MXF','/ADTV');

define('SESSION_DURATION',86400);

// image related
define('IMAGE_UPLOAD_FILE_TYPE','gif,png,jpg,jpeg');
define('IMAGE_UPLOAD_FILE_SIZE',1024 * 1024 * 5);

// video related
define('VIDEO_DURATION',15);
define('VIDEO_FRAMES_PER_SEC', 30);
define('VIDEO_WATERMARK','/webassets/images/watermark.png');
define('VIDEO_WATERMARK_LOCATION','topRight');
define('VIDEO_PARAMS','-q:v 1 -async 1  -r 30 -b:v 2M -bt 4M -vcodec libx264 -preset placebo -g 1 -movflags +faststart -acodec libfdk_aac -ac 2 -ar 48000 -ab 192k');
define('VIDEO_UPLOAD_FILE_TYPE','mov,m4v,mp4');
define('VIDEO_UPLOAD_FILE_SIZE',1024 * 1024 * 30);

// sending video to client
define('VIDEO_TO_TV_FFMPEG_PARAMS', ' -y -i {FILE_INPUT} -s 1920:1080 -vcodec mjpeg -b 20M -s 1920x1080 -r 30000/1001 -acodec pcm_s16le -ar 48000 -y {FILE_OUTPUT}');

// custom ftp filename
define('VIDEO_TO_TV_FILE_HAS_CUSTOM_FORMAT', false);
// uncomment these if the above constant is true
// then adjust accordingly.
define('VIDEO_TO_TV_FILE_MUST_EVAL', true);
define('VIDEO_TO_TV_FILE_FORMAT_PREFIX', 'TAL');
define('VIDEO_TO_TV_FILE_FORMAT', "sprintf('%05d', {INCREMENTED_VALUE});");
define('VIDEO_TO_TV_FILE_FORMAT_SUFFIX', '.mov');

// custom ftp image filename
define('IMAGE_TO_TV_FILE_HAS_CUSTOM_FORMAT', false);
define('IMAGE_TO_TV_FILE_MUST_EVAL', true);
define('IMAGE_TO_TV_FILE_FORMAT_PREFIX', 'TAL');
define('IMAGE_TO_TV_FILE_FORMAT', "sprintf('%05d', {INCREMENTED_VALUE});");

// THIS FLAG WILL ALLOW US TO SWITCH BETWEEN
// NATIVE YTT FUNCTIONALITY SUCH AS SPOT FILLER
define('ENABLE_YOUTOO_FUNCTIONALITY',  true);

define('CLIENT_SUPPORT_EMAIL','greg.stringer@gmail.com');

define('TICKER_SLEEP_TIME',10);
define('TICKER_BREAKING',false);

define('QUESTION_T_DEFAULT_HASHTAG','');
define('QUESTION_V_DEFAULT_HASHTAG','');
define('T_QUESTION_DEFAULT_END_TIME', time() + 60 * 60 * 24);
define('V_QUESTION_DEFAULT_END_TIME', time() + 365 * 60 * 60 * 24);

// whether or not to auto approve avatars and/or images when they are uploaded
define('IMAGE_AUTO_APPROVE_AVATAR', true);
define('IMAGE_AUTO_APPROVE', false);

define('LOCATION_LAT', '37.09024');
define('LOCATION_LNG', '-95.712891');

define('ANALYTICS_PROJECT_ID','72166659');
define('ANALYTICS_START_DATE', '2013-01-02');

//admin video page flags
define('VIDEO_FILTERS_EXTENDED',false);
define("VIDEO_FILTERS_EXTENDED_LABELS", serialize(array(array('new' => 'New', 'accepted' => 'Accepted'))));
define("VIDEO_FILTERS_EXTENDED_SUPADMIN_LABELS", serialize(array('denied' => 'Denied', 'all' => 'All')));

define('ADMIN_VIDEO_IMPORT',true);
define('ADMIN_VIDEO_IMPORT_VINE', true);
define('ADMIN_VIDEO_IMPORT_INSTAGRAM', true);
define('ADMIN_VIDEO_IMPORT_KEEK', true);
define('ADMIN_VIDEO_UPLOAD',true);
define('ADMIN_VIDEO_UPLOAD_AD', true);
define('ADMIN_VIDEO_AMPLIFY',true);

define('REPORT_TWITTER_AMPLIFY', true);

//admin ticker page flags
define('TICKER_FILTERS_EXTENDED',false);
define("TICKER_FILTERS_EXTENDED_LABELS", serialize(array(array('new' => 'New', 'accepted' => 'Accepted'))));
define("TICKER_FILTERS_EXTENDED_SUPADMIN_LABELS", serialize(array('denied' => 'Denied')));
define('ADMIN_TICKER_ENTITY',true);

//admin image page flags
define('IMAGE_FILTERS_EXTENDED',false);
define("IMAGE_FILTERS_EXTENDED_LABELS", serialize(array(array('new' => 'New', 'accepted' => 'Accepted'))));
define("IMAGE_FILTERS_EXTENDED_SUPADMIN_LABELS", serialize(array('denied' => 'Denied', 'all' => 'All')));

//custom error message constants.. more to add..
define('SUCCESS_LOGIN','Welcome back',true);
define('ERROR_LOGIN','Username and password invalid', true);
define('PROFILE_UPDATE_SUCCESS','User profile updated.',true);
define('AVATAR_SUCCESS', 'Avatar updated successfully.', true);
define('AVATAR_ERROR','Unable to update Avatar',true);
define('REGISTER_SUCCESS', 'You have successfully registered. Check your email for confirmation', true);
define('ERROR_TICKER_NOT_ADDED','Unable to save ticker!',true);
define('ERROR_TICKER_ADDED','Ticker added!', true);
define('ERROR_TICKER_SAVED','Ticker saved!', true);
define('ERROR_TICKER_NOT_SAVED','Unable to save ticker!', true);
define('ERROR_RESET_EMAIL_SENT','<h2>Thank you for submitting your request</h2>An email will be sent shortly with instructions on how to reset your password.', true);
define('ERROR_RESET_EMAIL_NOT_SENT','Unable to send a reset password email',true);
define('PHOTO_UPLOAD_SUCCESS','Image uploaded successfully.', true);
define('VIDEO_UPLOAD_SUCCESS','Video uploaded successfully',true);
define('ERROR_TICKER_NOT_ACTIVE','Ticker is not active',true);

define('ERROR_INVALID_FILETYPE','Invalid file type',true);

//Client feture toggle DO NOT DELETE ONLY COMMENT OUT PLEASE
define("CLIENT_FEATURES", serialize(array(
                                            "HAS_BANNER",
                                            "HAS_VIDEO",
                                            "HAS_IMAGE",
                                            "HAS_USER",
                                            "HAS_AUDIT",
                                            "HAS_DAILY_REPORT",
                                            "HAS_QUESTION_REPORT",
                                            "HAS_REPORT",
                                            "HAS_LANGUAGE",
                                            "HAS_SOCIALSEARCH",
                                            "HAS_SOCIALSTREAM",
                                            "HAS_QUESTION_VIDEO",
                                            "HAS_QUESTION_TICKER",
                                            "HAS_VOTING",
                                            "HAS_TICKER",
                                            "HAS_ENTITY",
                                            "HAS_CONTACT",
                                            "HAS_TRAINING")));

define("CLIENT_DEFAULT_PAGINATION_COUNT", 50);

// auto ftp video
define('VIDEO_AUTO_FTP_BASED_ON_STATUS', false);
// auto ftp video / status to search for
define('VIDEO_AUTO_FTP_STATUS_FLAG', 'accepted');

define('CONTACT_SHOW_EMAIL_ASSISTANCE_LINK', false);

define("USER_PERMISSIONS_EXTENDED", serialize(array("new" => "Producer Web",
    "newtv" => "Producer TV")));

define('ADMIN_USER_MANUAL', true);
define('TICKER_ICON', 'images/icons/shareImage.png');
define('ADMIN_IMAGE_REPORT_TOGGLE', false);


//Status Values Bit
define('STATUS_NEW_I', 128);
define('STATUS_ACCEPTED_I', 64);
define('STATUS_DENIED_I', 32);

define('STATUS_NEW_TV_I', 16);
define('STATUS_ACCEPTED_TV_I', 8);
define('STATUS_DENIED_TV_I', 4);

define('STATUS_ACCEPTED_SUP1_I', 2);
define('STATUS_ACCEPTED_SUP2_I', 1);