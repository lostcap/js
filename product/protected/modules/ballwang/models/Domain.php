<?php

/**
 * This is the model class for table "seo.{{domain}}".
 *
 * The followings are the available columns in table 'seo.{{domain}}':
 * @property integer $domain_id
 * @property integer $domain_buy_via
 * @property string $domain_name
 * @property string $domain_ftp
 * @property string $domain_ftp_user
 * @property string $domain_ftp_password
 * @property string $domain_data_name
 * @property string $domain_data_password
 * @property string $domain_data
 * @property string $domain_data_address
 * @property integer $domain_space_id
 * @property integer $domain_attribute
 * @property integer $domain_user
 * @property string $domain_keyword
 * @property integer $domain_site_support
 * @property string $domain_online_time
 */
class Domain extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return Domain the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{domain}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('domain_buy_via, domain_name, domain_ftp, domain_ftp_user, domain_ftp_password, domain_data_name, domain_data_password, domain_data, domain_data_address, domain_space_id, domain_user, domain_site_support ', 'required'),
            array('domain_buy_via, domain_space_id, domain_attribute, domain_user, domain_site_support', 'numerical', 'integerOnly' => true),
            array('domain_name, domain_ftp, domain_ftp_user, domain_ftp_password, domain_data_name, domain_data_password, domain_data, domain_data_address', 'length', 'max' => 255),
            array('domain_keyword', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('domain_id, domain_buy_via, domain_name, domain_ftp, domain_ftp_user, domain_ftp_password, domain_data_name, domain_data_password, domain_data, domain_data_address, domain_space_id, domain_attribute, domain_user, domain_keyword, domain_site_support, domain_online_time', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'owner' => array(self::BELONGS_TO, 'DomainUser', 'domain_user'),
            'via' => array(self::BELONGS_TO, 'BuyAccount', 'domain_buy_via'),
            'space' => array(self::BELONGS_TO, 'DomainSpace', 'domain_space_id'),
            'attribute' => array(self::BELONGS_TO, 'DomainAttribute', 'domain_attribute'),
            'support' => array(self::BELONGS_TO, 'PrimarySite', 'domain_site_support'),
            'dataAddress' => array(self::BELONGS_TO, 'DomainSpace', 'domain_data_address'),
            'domainUser'=>array(self::BELONGS_TO,'DomainUser','domain_user'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'domain_id' => '域名 ID',
            'domain_buy_via' => '购买账户',
            'domain_name' => '域名名称',
            'domain_user' => '负责人',
            'domain_space_id' => '空间 ID',
            'domain_attribute' => '域名属性',
            'domain_keyword' => '主关键字',
            'domain_site_support' => '支持主站 ',
            'domain_ftp' => 'FTP 地址',
            'domain_ftp_user' => 'FTP 账号',
            'domain_ftp_password' => 'FTP 密码 ',
            'domain_data_name' => '数据库账号',
            'domain_data_password' => '数据库密码 ',
            'domain_data' => '数据库名称',
            'domain_data_address' => '数据库地址',
            'domain_online_time' => '上线时间 ',
            'domain_seo_keywords'=>'关键词',
            'domain_note'=>'技术备注',
            'domain_note_seo'=>'推广备注',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('domain_id', $this->domain_id);

        $criteria->compare('domain_buy_via', $this->domain_buy_via);

        $criteria->compare('domain_name', $this->domain_name, true);

        $criteria->compare('domain_user', $this->domain_user);

        $criteria->compare('domain_space_id', $this->domain_space_id);

        $criteria->compare('domain_attribute', $this->domain_attribute);

        $criteria->compare('domain_keyword', $this->domain_keyword, true);

        $criteria->compare('domain_site_support', $this->domain_site_support);

        $criteria->compare('domain_ftp', $this->domain_ftp, true);

        $criteria->compare('domain_ftp_user', $this->domain_ftp_user, true);

        $criteria->compare('domain_ftp_password', $this->domain_ftp_password, true);

        $criteria->compare('domain_data_name', $this->domain_data_name, true);

        $criteria->compare('domain_data_password', $this->domain_data_password, true);

        $criteria->compare('domain_data', $this->domain_data, true);

        $criteria->compare('domain_data_address', $this->domain_data_address, true);

        $criteria->compare('domain_online_time', $this->domain_online_time, true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }


    public function orderSearch() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('domain_id', $this->domain_id);

        $criteria->compare('domain_buy_via', $this->domain_buy_via);

        $criteria->compare('domain_name', $this->domain_name, true);

        $criteria->compare('domain_user', $this->domain_user);

        $criteria->compare('domain_space_id', $this->domain_space_id);

        $criteria->compare('domain_attribute', $this->domain_attribute);

        $criteria->compare('domain_keyword', $this->domain_keyword, true);

        $criteria->compare('domain_site_support', $this->domain_site_support);

        $criteria->compare('domain_ftp', $this->domain_ftp, true);

        $criteria->compare('domain_ftp_user', $this->domain_ftp_user, true);

        $criteria->compare('domain_ftp_password', $this->domain_ftp_password, true);

        $criteria->compare('domain_data_name', $this->domain_data_name, true);

        $criteria->compare('domain_data_password', $this->domain_data_password, true);

        $criteria->compare('domain_data', $this->domain_data, true);

        $criteria->compare('domain_data_address', $this->domain_data_address, true);

        $criteria->compare('domain_online_time', $this->domain_online_time, true);

        $criteria->addCondition('domain_active=1');
        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),

        ));
    }




    public function vpsSiteCriteria() {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 'domain_attribute=3 AND domain_active=1',
        ));
        return $this;
    }

    public function vpsSingleSiteCriteria($siteId=0) {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 'domain_attribute=2 AND domain_id=:siteID AND domain_active=1',
            'params' => array(':siteID' => $siteId),
        ));
        return $this;
    }

    public static function getArraySiteIdBySupportSite($supportSiteId) {
        $siteId = array();
        $siteArray = Domain::model()->findAllByAttributes(array('domain_site_support' => $supportSiteId));
        if ($siteArray) {
            foreach ($siteArray as $key => $value) {
                $siteId[] = $value->domain_id;
            }
        }
        return $siteId;
    }

    public static function getSupportIdBySiteId($siteId) {
        $sql = 'select domain_site_support from syo_domain where domain_id ="' . $siteId . '"';
        $currencyResult = Yii::app()->db->createCommand($sql)->queryRow();
        return $currencyResult['domain_site_support'];
    }

    public static function getPrimarySite(){
        $siteArray=array();
        $site=PrimarySite::model()->findAllByAttributes(array('primary_site_used'=>1));
        if($site){
           foreach($site as $key=>$value){
               $siteArray[$value->primary_site_id]=$value->primary_site_name;
           }
        }
        return $siteArray;
    }

    public static function getDomainUser(){
        $userArray=array();
        $user=DomainUser::model()->findAllByAttributes(array('user_show'=>1));
        if($user){

            foreach($user as $key=> $value){
                $userArray[$value->user_id]=$value->user_name;
            }
        }
        return $userArray;
    }

    public static function getDomainUserNameToValue(){
        $userArray=array();
        $user=DomainUser::model()->findAllByAttributes(array('user_show'=>1));
        if($user){

            foreach($user as $key=> $value){
                $userArray[$value->user_name]=$value->user_id;
            }
        }
        return $userArray;
    }

//    public static function getSale(){
//        $this->domain_id;
//
//    }



}