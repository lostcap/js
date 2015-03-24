<?php

/**
 * This is the model class for table "{{site}}".
 *
 * The followings are the available columns in table '{{site}}':
 * @property integer $site_id
 * @property string $site_name
 * @property string $site_prefix
 * @property string $site_db_host
 * @property string $site_db_name
 * @property string $site_db_password
 * @property integer $site_attribute_id
 */
class Site extends CActiveRecord {
    const dbConnectError=1;
    const dbExcuteSuccess=2;
    const dbExcuteFailed=3;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Site the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{site}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('site_name, site_prefix, site_db_host, site_db_name, site_db_password', 'required', 'message' => '{attribute}内容不能为空！'),
            array('site_attribute_id', 'numerical', 'integerOnly' => true),
            array('site_name, site_prefix', 'unique', 'message' => '{attribute}必须唯一！'),
            array('site_name, site_prefix, site_db_host, site_db_name, site_db_password', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('site_id, site_name, site_prefix, site_db_host, site_db_name, site_db_password, site_attribute_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'site_id' => '网站ID',
            'site_name' => '站点名称',
            'site_prefix' => '网站代码',
            'site_db_host' => '数据库地址',
            'site_db_name' => '数据库帐号',
            'site_db_password' => '数据库密码',
            'site_attribute_id' => '网站类型',
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

        $criteria->compare('site_id', $this->site_id);
        $criteria->compare('site_name', $this->site_name, true);
        $criteria->compare('site_prefix', $this->site_prefix, true);
        $criteria->compare('site_db_host', $this->site_db_host, true);
        $criteria->compare('site_db_name', $this->site_db_name, true);
        $criteria->compare('site_db_password', $this->site_db_password, true);
        $criteria->compare('site_attribute_id', $this->site_attribute_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function bootstrap($message) {
        if ($message['success']) {
            Yii::app()->user->setFlash('success', $message['success']);
        } else if ($message['info']) {
            Yii::app()->user->setFlash('info', $message['info']);
        } else if ($message['warning']) {
            Yii::app()->user->setFlash('warning', $message['warning']);
        } else if ($message['error']) {
            Yii::app()->user->setFlash('error', $message['error']);
        }
        $this->widget('bootstrap.widgets.BootAlert');
    }

    public function executeSql($siteName, $sql) {
        if ($siteName && $sql) {
            $domainSql = 'select t1.domain_data_name,t1.domain_data_password,t1.domain_data ,t2.space_data_address from syo_domain as t1 
           LEFT JOIN syo_domain_space as t2 ON t1.domain_space_id==t2.space_id 
           where t1.domain_name =' . $siteName;
            $domain = Yii::app()->db->createCommand($domainSql)->query();
            
            echo $domain['domain_data_name'];
            exit;
            if ($domain) {
                $dbConnect = @mysql_connect($domain['space_data_address'], $domain['domain_data_name'], $domain['domain_data_password']);
                if (!$dbConnect) {
                    $dbConnectString = Site::dbConnectError;
                } else {
                    mysql_select_db($domain['domain_data'], $dbConnect) or die('Query interrupted' . mysql_error());
                    $query = mysql_query($sql);
                    if ($query) {
                        $dbConnectString = Site::dbExcuteSuccess;
                    } else {
                        $dbConnectString = Site::dbExcuteFailed;
                    }
                }
            }
        }
    }

}