<?php

/**
 * This is the model class for table "seo.{{domain_space}}".
 *
 * The followings are the available columns in table 'seo.{{domain_space}}':
 * @property integer $space_id
 * @property integer $space_name_id
 * @property string $space_user
 * @property string $space_password
 * @property string $space_ftp_address
 * @property string $space_ftp_user
 * @property string $space_ftp_password
 * @property string $space_data_user
 * @property string $space_data_password
 * @property string $DNS1
 * @property string $DNS2
 */
class DomainSpace extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return DomainSpace the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{domain_space}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('space_name_id, space_user, space_password,space_prefix,space_data_address', 'required'),
            array('space_name_id', 'numerical', 'integerOnly' => true),
            array('space_user, space_password, space_ftp_address, space_ftp_user, space_ftp_password, space_data_user, space_data_password, DNS1, DNS2,space_prefix,space_data_address,space_email_address,space_email_password', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('space_id, space_name_id, space_user, space_password, space_ftp_address, space_ftp_user, space_ftp_password, space_data_user, space_data_password, DNS1, DNS2 ,space_prefix,space_data_address,space_email_address,space_email_password', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'spaceName' => array(self::BELONGS_TO, 'SpaceAttribute', 'space_name_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'space_id' => '空间编号',
            'space_name_id' => '空间类型',
            'space_user' => '用户名 ',
            'space_password' => '密码',
            'space_ftp_address' => 'FTP地址',
            'space_ftp_user' => 'FTP用户名',
            'space_ftp_password' => 'FTP 密码',
            'space_data_user' => '数据库用户名',
            'space_data_password' => '数据库密码',
            'DNS1' => 'DNS1',
            'DNS2' => 'DNS2',
            'space_prefix'=>'空间前缀',
            'space_data_address'=>'空间数据库地址',
            'space_email_address'=>'Email 地址',
            'space_email_password'=>'Email 密码',
            'space_url'=>'空间地址',
            'space_vps_address'=>'VPS控制台',
            'space_vps_user'=>'VPS账号',
            'space_vps_password'=>'VPS密码',
            'space_text'=>'备注',
        );
    }

    public function getSpace() {
        $space = array();
        if ($model = DomainSpace::model()->findAll()){
            foreach ($model as $key) {
                $space[$key->space_id] = $key->space_user;
            }
            return $space ;
        }
        return array(0=>'思亿欧');
    }
    public function getSpaceAddress(){
        $address=array();
        if($model = DomainSpace::model()->findAll()){
            foreach ($model as $key){
                $address[$key->space_id] = $key->space_data_address;
            }
            return $address;
        }
        return array( 0 =>'思亿欧');
    }
    public function getSpacePrefix(){
        $all=array();
        if ($model = DomainSpace::model()->findAll()){
            foreach ($model as $key) {
                $space[$key->space_id] = $key->space_prefix;
            }
            return $space ;
        }
        return array(0=>'思亿欧');
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('space_id', $this->space_id);

        $criteria->compare('space_name_id', $this->space_name_id);

        $criteria->compare('space_user', $this->space_user, true);

        $criteria->compare('space_password', $this->space_password, true);

        $criteria->compare('space_ftp_address', $this->space_ftp_address, true);

        $criteria->compare('space_ftp_user', $this->space_ftp_user, true);

        $criteria->compare('space_ftp_password', $this->space_ftp_password, true);

        $criteria->compare('space_data_user', $this->space_data_user, true);

        $criteria->compare('space_data_password', $this->space_data_password, true);

        $criteria->compare('DNS1', $this->DNS1, true);

        $criteria->compare('DNS2', $this->DNS2, true);
        
        $criteria->compare('space_prefix',$this->space_prefix,true);
        
        $criteria->compare('space_data_address',$this->space_data_address,true);
        
        $criteria->compare('space_email_address',$this->space_email_address,true);

        $criteria->compare('space_email_password',$this->space_email_password,true);
        
        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

}