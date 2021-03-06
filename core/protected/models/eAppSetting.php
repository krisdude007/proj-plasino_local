<?php

/**
 * This is the model class for table "app_setting".
 *
 * The followings are the available columns in table 'app_setting':
 * @property string $id
 * @property string $type
 * @property string $attribute
 * @property integer $value
 * @property string $description
 * @property string $created_on
 * @property string $updated_on
 */
class eAppSetting extends AppSetting
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'app_setting';
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AppSetting the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function scopes() {
        $alias = $this->getTableAlias();
        return array(
            'active' => array('condition' => $alias.'.value = 1'),
            'report' => array('condition' => $alias.'.type = "report"'),
            'dashboard' => array('condition' => $alias.'.type = "dashboard"'),
            'demographic' => array('condition' => $alias.'.type = "demographic"'),
            'ticker' => array('condition' => $alias.'.type = "ticker"'),
        );
    }
}
