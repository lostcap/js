<?php

/**
 * This is the model class for table "{{online_domain}}".
 *
 * The followings are the available columns in table '{{online_domain}}':
 * @property integer $domain_id
 * @property string $domain_name
 * @property string $domain_pay_time
 * @property string $domain_statue
 * @property integer $domain_used
 */
class OnlineDomain extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return OnlineDomain the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{online_domain}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('domain_name, domain_pay_time, domain_statue', 'required'),
            array('domain_used', 'numerical', 'integerOnly' => true),
            array('domain_name, domain_pay_time, domain_statue', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('domain_id, domain_name, domain_pay_time, domain_statue, domain_used', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'lookUp' => array(self::BELONGS_TO, 'LookUp', 'domain_used'),
            'buyAccount' => array(self::BELONGS_TO, 'BuyAccount', 'domain_buy'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'domain_id' => '域名 ID ',
            'domain_name' => '域名名称',
            'domain_pay_time' => '到期时间',
            'domain_statue' => '域名状态',
            'domain_used' => '使用情况',
            'domain_buy' => '购买账号',
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

        $criteria->compare('domain_name', $this->domain_name, true);

        $criteria->compare('domain_pay_time', $this->domain_pay_time, true);

        $criteria->compare('domain_statue', $this->domain_statue, true);

        $criteria->compare('domain_used', $this->domain_used);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

}