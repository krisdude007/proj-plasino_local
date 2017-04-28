<?php

class ClientUtility {

    // get user stats to display on each page
    public static function getUser() {
        return eUser::model()->with('images:isAvatar')->findByPK(Yii::app()->user->id);
    }

    public static function getNumVideos($user_id = null) {

        if (is_null($user_id)) {
            $user_id = Yii::app()->user->id;
        }

        return eVideo::model()->processed()->accepted()->countByAttributes(array('user_id' => $user_id));
    }

    public static function getNumVotes($user_id = null) {

        if (is_null($user_id)) {
            $user_id = Yii::app()->user->id;
        }

        return ePollResponse::model()->countByAttributes(array('user_id' => $user_id));
    }

    public static function getNumTexts($user_id = null) {

        if (is_null($user_id)) {
            $user_id = Yii::app()->user->id;
        }

        return eTicker::model()->accepted()->countByAttributes(array('user_id' => $user_id));
    }

    public static function checkifTwitterConnected($user_id = null) {

        if (is_null($user_id)) {
            $user_id = Yii::app()->user->id;
            $tw_user = eUserTwitter::model()->findByAttributes(array('user_id' => $user_id));
            if (!empty($tw_user)) {
                return true;
            }
        }

        return false;
    }

    public static function getTotalUserBalanceCredits()
        {
            $arr = array('credits_spent' => 0, 'credits_earned' => 0, 'credits_total' => 0);
            $balance = eCreditBalance::model()->findByAttributes(array('user_id' => Yii::app()->user->getId()));

            if(!is_null($balance)) {
                $arr['credits_spent'] = $balance->spent;
                $arr['credits_earned'] = $balance->earned;
                $arr['credits_total'] = $balance->credits;
            }
            return isset($arr['credits_total']) ? $arr['credits_total'] : 0;
        }

//    public static function getClientIpAddress() {
//        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
//            if (array_key_exists($key, $_SERVER) === true) {
//                foreach (explode(',', $_SERVER[$key]) as $ip) {
//                    if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
//                        return $ip;
//                    }
//                }
//            }
//        }
//    }

    public static function getClientIpAddress() {
       return $_SERVER['REMOTE_ADDR'];
    }

    public static function getIPInfo($ip) {

        $url = 'http://www.telize.com/geoip/' . $ip;


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        $json = json_decode($response);
        curl_close($ch);
        return $json;
    }

    public static function getPLMNumbers($country = NULL, $operator = NULL) {

        $plmns['egypt']['etisalat'] = 60203;
        $plmns['egypt']['vodafone'] = 60202;
        $plmns['egypt']['mobinil'] = 60201;
        $plmns['uae']['etisalat'] = 42402;
        $plmns['uae']['du'] = 42403;
        $plmns['iraq']['asiacell'] = 41805;
        $plmns['iraq']['zainiq'] = 41820;
        $plmns['bahrain']['batelco'] = 42601;
        $plmns['bahrain']['zain'] = 42602;
        $plmns['bahrain']['viva'] = 42604;
        $plmns['jordan']['umniah'] = 41603;
        $plmns['oman']['nawras'] = 42203;
        $plmns['oman']['omanmobile'] = 42202;
        $plmns['qatar']['qtel'] = 42701;
        $plmns['ksa']['zain'] = 42004;
        $plmns['ksa']['mobily'] = 42003;

        if (!is_null($operator) && !is_null($country)) {
            return $plmns[$country][$operator];
        }
        return false;
    }

    public static function getShortCodes($country = NULL, $operator = NULL) {

        $originator['egypt']['etisalat'] = 6832;
        $originator['egypt']['vodafone'] = 95215;
        $originator['egypt']['mobinil'] = 95215;
        $originator['uae']['etisalat'] = 2259;
        $originator['uae']['du'] = 2420;
        $originator['bahrain']['zain'] = 94005;
        $originator['bahrain']['viva'] = 98632;
        $originator['bahrain']['batelco'] = 95888;
        $originator['iraq']['asiacell'] = 2398;
        $originator['iraq']['zainiq'] = 3513;
        $originator['jordan']['umniah'] = 99893;
        $originator['oman']['nawras'] = 91988;
        $originator['oman']['omantel'] = 91211;
        $originator['ksa']['zain'] = 752001;
        $originator['ksa']['mobily'] = 630531;
        $originator['qatar']['qtel'] = 92202;

        if (!is_null($operator) && !is_null($country)) {
            return $originator[$country][$operator];
        }
        return false;
    }

    public static function getUSStates($states = NULL) {
        $states = array(
            '' => Yii::t('youtoo','Select State'),
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
//            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'DC' => 'District of Columbia',
            'FL' => 'Florida',
//            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
//            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MD' => 'Maryland',
//            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
//            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
//            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VA' => 'Virginia',
            'WA' => 'Washington',
            'WV' => 'West Virginia',
            'WI' => 'Wisconsin',
            'WY' => 'Wyoming',
        );

        return $states;
    }

    public static function getShortUsername($username) {
        // grabs last 4 digits of phone number
        return substr($username, -4);
    }

    public static function getGameDescription($id = NULL) {
        if ($id == NULL) {
            $game = eGameChoice::model()->multiple()->isActive()->with('gameChoiceAnswers')->find();
        } else {
            $game = eGameChoice::model()->multiple()->with('gameChoiceAnswers')->findByPk((int) $id);
        }
        return $game->description;

    }

}

?>
