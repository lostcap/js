<?php

/**
 * This is the model class for table "{{refund}}".
 *
 * The followings are the available columns in table '{{refund}}':
 * @property integer $refund_id
 * @property string $refund_order_num
 * @property integer $refund_currency
 * @property double $refund_account
 * @property double $refund_account_cny
 * @property integer $refund_paymethod
 * @property integer $refund_site
 * @property integer $refund_category
 * @property integer $refund_country
 * @property string $refund_order_time
 * @property string $refund_time
 */
class Refund extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Refund the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{refund}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('refund_order_num, refund_currency, refund_account, refund_account_cny, refund_paymethod, refund_site, refund_category, refund_country, refund_order_time', 'required'),
            array('refund_currency, refund_paymethod, refund_site, refund_category, refund_country', 'numerical', 'integerOnly' => true),
            array('refund_account, refund_account_cny', 'numerical'),
            array('refund_order_num', 'length', 'max' => 100),
            array('refund_time', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('refund_id, refund_order_num, refund_currency, refund_account, refund_account_cny, refund_paymethod, refund_site, refund_category, refund_country, refund_order_time, refund_time', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'site' => array(self::BELONGS_TO, 'Domain', 'refund_site'),
            'currency' => array(self::BELONGS_TO, 'Currency', 'refund_currency'),
            'payment' => array(self::BELONGS_TO, 'Payment', 'refund_paymethod'),
            'country' => array(self::BELONGS_TO, 'Country', 'refund_country'),
            'order' => array(self::BELONGS_TO, 'Order', 'refund_order_id'),
            'refundCategory' => array(self::BELONGS_TO, 'RefundCategory', 'refund_content_category_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'refund_id' => 'Refund',
            'refund_order_num' => 'Refund Order Num',
            'refund_currency' => 'Refund Currency',
            'refund_account' => 'Refund Account',
            'refund_account_cny' => 'Refund Account Cny',
            'refund_paymethod' => 'Refund Paymethod',
            'refund_site' => 'Refund Site',
            'refund_category' => 'Refund Category',
            'refund_country' => 'Refund Country',
            'refund_order_time' => 'Refund Order Time',
            'refund_time' => 'Refund Time',
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

        $criteria->compare('refund_id', $this->refund_id);
        $criteria->compare('refund_order_num', $this->refund_order_num, true);
        $criteria->compare('refund_currency', $this->refund_currency);
        $criteria->compare('refund_account', $this->refund_account);
        $criteria->compare('refund_account_cny', $this->refund_account_cny);
        $criteria->compare('refund_paymethod', $this->refund_paymethod);
        $criteria->compare('refund_site', $this->refund_site);
        $criteria->compare('refund_category', $this->refund_category);
        $criteria->compare('refund_country', $this->refund_country);
        $criteria->compare('refund_status', $this->refund_status, true);
        $criteria->compare('refund_order_time', $this->refund_order_time, true);
        $criteria->compare('refund_time', $this->refund_time, true);
        //     $criteria->order='refund_order_time DESC';


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
    }

    public function getInvoice() {
        $prefix = $this->site->domain_prefix;
        return '(' . $prefix . ')' . $this->refund_order_num;
    }

    public function getRefundSite() {
        $site = $this->site->domain_name;
        return $site;
    }

    protected function afterDelete() {
        $order=$this->order;
        $refundAccount=$this->refund_account;
        if($order->order_refund>0.0){
            $order->order_refund -=$refundAccount ;
            $order->order_grandtotal +=$refundAccount ;
            $order->update();

        }

    }

}