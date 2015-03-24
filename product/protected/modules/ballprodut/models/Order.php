<?php

/**
 * This is the model class for table "{{Order}}".
 *
 * The followings are the available columns in table '{{Order}}':
 * @property integer $order_id
 * @property integer $invoice_id
 * @property integer $customer_id
 * @property string $order_subtotal
 * @property string $order_trackingtotal
 * @property string $order_grandtotal
 * @property integer $order_currency_id
 * @property integer $order_payment_id
 * @property integer $order_carrier_id
 * @property integer $order_address_id
 * @property integer $order_ship_id
 * @property integer $order_discount_id
 * @property integer $order_status
 * @property integer $order_export
 * @property integer $order_valid
 * @property integer $order_qty
 * @property string $order_ip
 * @property string $order_salt
 * @property string $order_comment
 * @property string $order_create_at
 * @property string $order_payment_at
 */
class Order extends CActiveRecord {
    const AwaitingPayment = 1;
    const PaymentAccepted = 2;
    const Shipped = 3;
    const Delived = 4;
    const Refund = 5;
    const PaymentError = 6;
    const Canceled = 7;
    const Pending = 8;
    const PreparationProgress = 9;
    const Delete = 10;

    public $customer_name;
    public $customer_email;
    public $paypal_txnid;

    /**
     * Returns the static model of the specified AR class.
     * @return Order the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{order}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('customer_id, order_subtotal, order_trackingtotal, order_grandtotal, order_currency_id, order_payment_id, order_carrier_id, order_address_id, order_ship_id, order_discount_id, order_status, order_valid,order_qty, order_ip', 'required'),
            array('invoice_id, customer_id, order_currency_id, order_payment_id, order_carrier_id, order_address_id, order_ship_id, order_discount_id, order_status,order_valid, order_qty', 'numerical', 'integerOnly' => true),
            array('order_subtotal, order_trackingtotal, order_grandtotal', 'length', 'max' => 6),
            array('order_ip', 'length', 'max' => 15),
            array('order_salt', 'length', 'max' => 32),
            array('order_comment', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('customer_email,paypal_txnid,customer_name,order_id, invoice_id, customer_id, order_subtotal, order_trackingtotal,order_grandtotal, order_currency_id, order_payment_id, order_carrier_id, order_address_id, order_ship_id, order_discount_id, order_status, order_valid,order_export,order_qty, order_ip, order_salt, order_comment, order_create_at,order_payment_at', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'payment' => array(self::BELONGS_TO, 'Payment', 'order_payment_id'),
            'currency' => array(self::BELONGS_TO, 'Currency', 'order_currency_id'),
            'items' => array(self::HAS_MANY, 'OrderItem', 'order_id'),
            'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
            'carrier' => array(self::BELONGS_TO, 'Carrier', 'order_carrier_id'),
            'address' => array(self::BELONGS_TO, 'CustomerAddress', 'order_address_id'),
            'paypal' => array(self::HAS_ONE, 'PaypalResponse', 'order_id'),
            'ship' => array(self::HAS_ONE, 'OrderShip', 'ship_order_id'),
            'site' => array(self::BELONGS_TO, 'Domain', 'order_site_id'),
            'refund' => array(self::HAS_MANY, 'Refund', 'refund_order_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'order_id' => '订单ID',
            'invoice_id' => '订单号',
            'order_site_id' => '网站代码',
            'customer_id' => '客户邮箱',
            'order_subtotal' => '订单小计',
            'order_trackingtotal' => 'Order TrackingTotal',
            'order_grandtotal' => '订单总计',
            'order_currency_id' => '货币',
            'order_payment_id' => '支付方式',
            'order_carrier_id' => '货运方式',
            'order_address_id' => '货运地址',
            'order_ship_id' => 'Order Ship',
            'order_discount_id' => 'Order Discount',
            'order_status' => '订单状态',
            'order_qty' => '订单数量',
            'order_ip' => 'Order Ip',
            'order_salt' => 'Order Salt',
            'order_comment' => '客户留言',
            'order_create_at' => '下单时间',
            'order_payment_at' => '支付时间'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria(array(
                    'with' => array('address', 'paypal', 'customer'),
                        //   'order' => 't.order_id DESC',
                ));

        $criteria->compare('address.customer_name', $this->customer_name, true);

        $criteria->compare('response_txn_id', $this->paypal_txnid, true);

        $criteria->compare('customer_email', $this->customer_email, true);

        $criteria->compare('order_id', $this->order_id);

        $criteria->compare('invoice_id', $this->invoice_id);

        $criteria->compare('t.customer_id', $this->customer_id);   //order.customer_id and customer_address.customer_id in where clause is ambiguous,so add the prefix t

        $criteria->compare('order_subtotal', $this->order_subtotal, true);

        $criteria->compare('order_trackingtotal', $this->order_trackingtotal, true);

        $criteria->compare('order_grandtotal', $this->order_grandtotal, true);

        $criteria->compare('order_currency_id', $this->order_currency_id);

        $criteria->compare('order_payment_id', $this->order_payment_id);

        $criteria->compare('order_carrier_id', $this->order_carrier_id);

        $criteria->compare('order_address_id', $this->order_address_id);

        $criteria->compare('order_ship_id', $this->order_ship_id);

        $criteria->compare('order_discount_id', $this->order_discount_id);

        $criteria->compare('order_status', $this->order_status);

        $criteria->compare('order_valid', $this->order_valid);

        $criteria->compare('order_export', $this->order_export);

        $criteria->compare('order_qty', $this->order_qty);

        $criteria->compare('order_ip', $this->order_ip, true);

        $criteria->compare('order_salt', $this->order_salt, true);

        $criteria->compare('order_comment', $this->order_comment, true);

        $criteria->compare('order_create_at', $this->order_create_at, true);

        $criteria->compare('order_payment_at', $this->order_create_at, true);

        $criteria->addCondition('order_status!=' . self::AwaitingPayment);

        $criteria->order = 'order_create_at DESC';
//        $criteria->order='order_status ASC';

        return new CActiveDataProvider('Order', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 30,
            ),
        ));
    }

    public function searchOutputSite() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria(array(
            'with' => array('address', 'paypal', 'customer'),
            //   'order' => 't.order_id DESC',
        ));

        $criteria->compare('address.customer_name', $this->customer_name, true);

        $criteria->compare('response_txn_id', $this->paypal_txnid, true);

        $criteria->compare('customer_email', $this->customer_email, true);

        $criteria->compare('order_id', $this->order_id);

        $criteria->compare('invoice_id', $this->invoice_id);

        $criteria->compare('t.customer_id', $this->customer_id);   //order.customer_id and customer_address.customer_id in where clause is ambiguous,so add the prefix t

        $criteria->compare('order_subtotal', $this->order_subtotal, true);

        $criteria->compare('order_trackingtotal', $this->order_trackingtotal, true);

        $criteria->compare('order_grandtotal', $this->order_grandtotal, true);

        $criteria->compare('order_currency_id', $this->order_currency_id);

        $criteria->compare('order_payment_id', $this->order_payment_id);

        $criteria->compare('order_carrier_id', $this->order_carrier_id);

        $criteria->compare('order_address_id', $this->order_address_id);

        $criteria->compare('order_ship_id', $this->order_ship_id);

        $criteria->compare('order_discount_id', $this->order_discount_id);

        $criteria->compare('order_status', $this->order_status);

        $criteria->compare('order_valid', $this->order_valid);

        $criteria->compare('order_export', $this->order_export);

        $criteria->compare('order_qty', $this->order_qty);

        $criteria->compare('order_ip', $this->order_ip, true);

        $criteria->compare('order_salt', $this->order_salt, true);

        $criteria->compare('order_comment', $this->order_comment, true);

        $criteria->compare('order_create_at', $this->order_create_at, true);

        $criteria->compare('order_payment_at', $this->order_create_at, true);

        $criteria->addCondition('order_status=' . self::PreparationProgress);

        $criteria->addCondition('order_export=1');

        $criteria->order = 'order_create_at DESC';
//        $criteria->order='order_status ASC';

        return new CActiveDataProvider('Order', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 30,
            ),
        ));
    }

    public function searchEmailQueue() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria(array(
            'with' => array('address', 'paypal', 'customer'),
            //   'order' => 't.order_id DESC',
        ));

        $criteria->compare('address.customer_name', $this->customer_name, true);

        $criteria->compare('response_txn_id', $this->paypal_txnid, true);

        $criteria->compare('customer_email', $this->customer_email, true);

        $criteria->compare('order_id', $this->order_id);

        $criteria->compare('invoice_id', $this->invoice_id);

        $criteria->compare('t.customer_id', $this->customer_id);   //order.customer_id and customer_address.customer_id in where clause is ambiguous,so add the prefix t

        $criteria->compare('order_subtotal', $this->order_subtotal, true);

        $criteria->compare('order_trackingtotal', $this->order_trackingtotal, true);

        $criteria->compare('order_grandtotal', $this->order_grandtotal, true);

        $criteria->compare('order_currency_id', $this->order_currency_id);

        $criteria->compare('order_payment_id', $this->order_payment_id);

        $criteria->compare('order_carrier_id', $this->order_carrier_id);

        $criteria->compare('order_address_id', $this->order_address_id);

        $criteria->compare('order_ship_id', $this->order_ship_id);

        $criteria->compare('order_discount_id', $this->order_discount_id);

        $criteria->compare('order_status', $this->order_status);

        $criteria->compare('order_valid', $this->order_valid);

        $criteria->compare('order_export', $this->order_export);

        $criteria->compare('order_qty', $this->order_qty);

        $criteria->compare('order_ip', $this->order_ip, true);

        $criteria->compare('order_salt', $this->order_salt, true);

        $criteria->compare('order_comment', $this->order_comment, true);

        $criteria->compare('order_create_at', $this->order_create_at, true);

        $criteria->compare('order_payment_at', $this->order_create_at, true);

        $criteria->addCondition('order_email_queue=3');

        $criteria->order = 'order_create_at DESC';
//        $criteria->order='order_status ASC';

        return new CActiveDataProvider('Order', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 30,
            ),
        ));
    }

    public function noShippedSearch() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria(array(
                    'with' => array('address', 'paypal', 'customer'),
                        //   'order' => 't.order_id DESC',
                ));

        $criteria->compare('address.customer_name', $this->customer_name, true);

        $criteria->compare('response_txn_id', $this->paypal_txnid, true);

        $criteria->compare('customer_email', $this->customer_email, true);

        $criteria->compare('order_id', $this->order_id);

        $criteria->compare('invoice_id', $this->invoice_id);

        $criteria->compare('t.customer_id', $this->customer_id);   //order.customer_id and customer_address.customer_id in where clause is ambiguous,so add the prefix t

        $criteria->compare('order_subtotal', $this->order_subtotal, true);

        $criteria->compare('order_trackingtotal', $this->order_trackingtotal, true);

        $criteria->compare('order_grandtotal', $this->order_grandtotal, true);

        $criteria->compare('order_currency_id', $this->order_currency_id);

        $criteria->compare('order_payment_id', $this->order_payment_id);

        $criteria->compare('order_carrier_id', $this->order_carrier_id);

        $criteria->compare('order_address_id', $this->order_address_id);

        $criteria->compare('order_ship_id', $this->order_ship_id);

        $criteria->compare('order_discount_id', $this->order_discount_id);

        $criteria->compare('order_status', $this->order_status);

        $criteria->compare('order_valid', $this->order_valid);

        $criteria->compare('order_export', $this->order_export);

        $criteria->compare('order_qty', $this->order_qty);

        $criteria->compare('order_ip', $this->order_ip, true);

        $criteria->compare('order_salt', $this->order_salt, true);

        $criteria->compare('order_comment', $this->order_comment, true);

        $criteria->compare('order_create_at', $this->order_create_at, true);

        $criteria->compare('order_payment_at', $this->order_create_at, true);

        $criteria->addCondition('order_status=' . self::PaymentAccepted);

//        $criteria->order='order_status ASC';

        return new CActiveDataProvider('Order', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 30,
            ),
        ));
    }

    public function waitingSearch() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria(array(
                    'with' => array('address', 'paypal', 'customer'),
                        //   'order' => 't.order_id DESC',
                ));

        $criteria->compare('address.customer_name', $this->customer_name, true);

        $criteria->compare('response_txn_id', $this->paypal_txnid, true);

        $criteria->compare('customer_email', $this->customer_email, true);

        $criteria->compare('order_id', $this->order_id, true);

        $criteria->compare('invoice_id', $this->invoice_id, true);

        $criteria->compare('t.customer_id', $this->customer_id, true);   //order.customer_id and customer_address.customer_id in where clause is ambiguous,so add the prefix t

        $criteria->compare('order_subtotal', $this->order_subtotal, true);

        $criteria->compare('order_trackingtotal', $this->order_trackingtotal, true);

        $criteria->compare('order_grandtotal', $this->order_grandtotal, true);

        $criteria->compare('order_currency_id', $this->order_currency_id, true);

        $criteria->compare('order_payment_id', $this->order_payment_id);

        $criteria->compare('order_carrier_id', $this->order_carrier_id, true);

        $criteria->compare('order_address_id', $this->order_address_id, true);

        $criteria->compare('order_ship_id', $this->order_ship_id, true);

        $criteria->compare('order_discount_id', $this->order_discount_id, true);

        $criteria->compare('order_status', $this->order_status, true);

        $criteria->compare('order_valid', $this->order_valid);

        $criteria->compare('order_export', $this->order_export);

        $criteria->compare('order_qty', $this->order_qty);

        $criteria->compare('order_ip', $this->order_ip, true);

        $criteria->compare('order_salt', $this->order_salt, true);

        $criteria->compare('order_comment', $this->order_comment, true);

        $criteria->compare('order_create_at', $this->order_create_at, true);

        $criteria->compare('order_payment_at', $this->order_create_at, true);

        $criteria->addCondition('order_status=' . self::AwaitingPayment);

//        $criteria->order='order_status ASC';

        return new CActiveDataProvider('Order', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 30,
            ),
        ));
    }

    public function orderSearch($invoice) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria(array(
                    'with' => array('address', 'paypal', 'customer'),
                        //   'order' => 't.order_id DESC',
                ));

        $criteria->compare('address.customer_name', $this->customer_name, true);

        $criteria->compare('response_txn_id', $this->paypal_txnid, true);

        $criteria->compare('customer_email', $this->customer_email, true);

        $criteria->compare('order_id', $this->order_id);

        $criteria->compare('invoice_id', $this->invoice_id);

        $criteria->compare('t.customer_id', $this->customer_id);   //order.customer_id and customer_address.customer_id in where clause is ambiguous,so add the prefix t

        $criteria->compare('order_subtotal', $this->order_subtotal, true);

        $criteria->compare('order_trackingtotal', $this->order_trackingtotal, true);

        $criteria->compare('order_grandtotal', $this->order_grandtotal, true);

        $criteria->compare('order_currency_id', $this->order_currency_id);

        $criteria->compare('order_payment_id', $this->order_payment_id);

        $criteria->compare('order_carrier_id', $this->order_carrier_id);

        $criteria->compare('order_address_id', $this->order_address_id);

        $criteria->compare('order_ship_id', $this->order_ship_id);

        $criteria->compare('order_discount_id', $this->order_discount_id);

        $criteria->compare('order_status', $this->order_status);

        $criteria->compare('order_valid', $this->order_valid);

        $criteria->compare('order_export', $this->order_export);

        $criteria->compare('order_qty', $this->order_qty);

        $criteria->compare('order_ip', $this->order_ip, true);

        $criteria->compare('order_salt', $this->order_salt, true);

        $criteria->compare('order_comment', $this->order_comment, true);

        $criteria->compare('order_create_at', $this->order_create_at, true);

        $criteria->compare('order_payment_at', $this->order_create_at, true);


        $criteria->addCondition('invoice_id="' . $invoice . '"');



//        $criteria->order='order_status ASC';

        return new CActiveDataProvider('Order', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 30,
            ),
        ));
    }

    public function newOrder() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria(array(
                    'with' => array('address', 'paypal', 'customer'),
                        //   'order' => 't.order_id DESC',
                ));

        $criteria->compare('address.customer_name', $this->customer_name, true);

        $criteria->addCondition('TIMESTAMPDIFF(DAY,order_create_at,now())<20');

        $criteria->order = 'order_create_at DESC';

        $criteria->addCondition('order_status='.Order::PaymentAccepted);

       $criteria->addCondition('order_status='.Order::PreparationProgress,'OR');

//        $criteria->order='order_status ASC';

        return new CActiveDataProvider('Order', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 30,
            ),
        ));
    }

    public function orderSearchByCustomer($email) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria(array(
                    'with' => array('address', 'paypal', 'customer'),
                        //   'order' => 't.order_id DESC',
                ));

        $criteria->compare('address.customer_name', $this->customer_name, true);

        $criteria->compare('response_txn_id', $this->paypal_txnid, true);

        //$criteria->compare('customer_email', $this->customer_email, true);

        $criteria->compare('order_id', $this->order_id);

        $criteria->compare('invoice_id', $this->invoice_id);

        $criteria->compare('t.customer_id', $this->customer_id);   //order.customer_id and customer_address.customer_id in where clause is ambiguous,so add the prefix t

        $criteria->compare('order_subtotal', $this->order_subtotal, true);

        $criteria->compare('order_trackingtotal', $this->order_trackingtotal, true);

        $criteria->compare('order_grandtotal', $this->order_grandtotal, true);

        $criteria->compare('order_currency_id', $this->order_currency_id);

        $criteria->compare('order_payment_id', $this->order_payment_id);

        $criteria->compare('order_carrier_id', $this->order_carrier_id);

        $criteria->compare('order_address_id', $this->order_address_id);

        $criteria->compare('order_ship_id', $this->order_ship_id);

        $criteria->compare('order_discount_id', $this->order_discount_id);

        $criteria->compare('order_status', $this->order_status);

        $criteria->compare('order_valid', $this->order_valid);

        $criteria->compare('order_export', $this->order_export);

        $criteria->compare('order_qty', $this->order_qty);

        $criteria->compare('order_ip', $this->order_ip, true);

        $criteria->compare('order_salt', $this->order_salt, true);

        $criteria->compare('order_comment', $this->order_comment, true);

        $criteria->compare('order_create_at', $this->order_create_at, true);

        $criteria->compare('order_payment_at', $this->order_create_at, true);


        $criteria->addCondition('customer_email="' . $email . '"');



//        $criteria->order='order_status ASC';

        return new CActiveDataProvider('Order', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 30,
            ),
        ));
    }

    public function orderSearchByCustomerName($customerName) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria(array(
            'with' => array('address', 'paypal'),
            //   'order' => 't.order_id DESC',
        ));

        $criteria->compare('address.customer_name', $this->customer_name, true);

        $criteria->compare('response_txn_id', $this->paypal_txnid, true);

        //$criteria->compare('customer_email', $this->customer_email, true);

        $criteria->compare('order_id', $this->order_id);

        $criteria->compare('invoice_id', $this->invoice_id);

        $criteria->compare('t.customer_id', $this->customer_id);   //order.customer_id and customer_address.customer_id in where clause is ambiguous,so add the prefix t

        $criteria->compare('order_subtotal', $this->order_subtotal, true);

        $criteria->compare('order_trackingtotal', $this->order_trackingtotal, true);

        $criteria->compare('order_grandtotal', $this->order_grandtotal, true);

        $criteria->compare('order_currency_id', $this->order_currency_id);

        $criteria->compare('order_payment_id', $this->order_payment_id);

        $criteria->compare('order_carrier_id', $this->order_carrier_id);

        $criteria->compare('order_address_id', $this->order_address_id);

        $criteria->compare('order_ship_id', $this->order_ship_id);

        $criteria->compare('order_discount_id', $this->order_discount_id);

        $criteria->compare('order_status', $this->order_status);

        $criteria->compare('order_valid', $this->order_valid);

        $criteria->compare('order_export', $this->order_export);

        $criteria->compare('order_qty', $this->order_qty);

        $criteria->compare('order_ip', $this->order_ip, true);

        $criteria->compare('order_salt', $this->order_salt, true);

        $criteria->compare('order_comment', $this->order_comment, true);

        $criteria->compare('order_create_at', $this->order_create_at, true);

        $criteria->compare('order_payment_at', $this->order_create_at, true);


        $criteria->addCondition('customer_name="' . $customerName . '"');



//        $criteria->order='order_status ASC';

        return new CActiveDataProvider('Order', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 30,
            ),
        ));
    }


    public function orderShippedProduct() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria(array(
                    'with' => array('address', 'paypal', 'customer'),
                        //   'order' => 't.order_id DESC',
                ));

        $criteria->compare('address.customer_name', $this->customer_name, true);

        $criteria->compare('response_txn_id', $this->paypal_txnid, true);

        $criteria->compare('customer_email', $this->customer_email, true);

        $criteria->compare('order_id', $this->order_id);

        $criteria->compare('invoice_id', $this->invoice_id);

        $criteria->compare('t.customer_id', $this->customer_id);   //order.customer_id and customer_address.customer_id in where clause is ambiguous,so add the prefix t

        $criteria->compare('order_subtotal', $this->order_subtotal, true);

        $criteria->compare('order_trackingtotal', $this->order_trackingtotal, true);

        $criteria->compare('order_grandtotal', $this->order_grandtotal, true);

        $criteria->compare('order_currency_id', $this->order_currency_id);

        $criteria->compare('order_payment_id', $this->order_payment_id);

        $criteria->compare('order_carrier_id', $this->order_carrier_id);

        $criteria->compare('order_address_id', $this->order_address_id);

        $criteria->compare('order_ship_id', $this->order_ship_id);

        $criteria->compare('order_discount_id', $this->order_discount_id);

        $criteria->compare('order_status', $this->order_status);

        $criteria->compare('order_valid', $this->order_valid);

        $criteria->compare('order_export', $this->order_export);

        $criteria->compare('order_qty', $this->order_qty);

        $criteria->compare('order_ip', $this->order_ip, true);

        $criteria->compare('order_salt', $this->order_salt, true);

        $criteria->compare('order_comment', $this->order_comment, true);

        $criteria->compare('order_create_at', $this->order_create_at, true);

        $criteria->compare('order_payment_at', $this->order_create_at, true);

        $criteria->addCondition('order_payment_at <=' . date("Y-m-d H:i:s", mktime(date('s'), date('i'), date('s'), date('m'), date('d') - 4, date('Y'))));





//        $criteria->order='order_status ASC';

        return new CActiveDataProvider('Order', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 30,
            ),
        ));
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->order_export = 0;
        }

        if ($this->order_status == self::PaymentAccepted
                || $this->order_status == self::Shipped
                || $this->order_status == self::Delived
                || $this->order_status == self::PreparationProgress) {
            $this->order_valid = 1;
        } else {
            $this->order_valid = 0;
        }
        return true;
    }

    public function paymentSuccess() {
        if ($this->order_status == self::PaymentAccepted) {
            /* 删除购物车商品 */
            foreach ($this->items as $item) {
                Cart::model()->deleteAllByAttributes(array(
                    'product_id' => $item->item_product_id,
                    'customer_id' => $this->customer_id,
                    'attribute_id' => $item->item_attribute_id,
                ));
                $model = Product::model()->findByPk($item->item_product_id);
                $model->product_stock_qty-=$item->item_qty;
                $model->save(true, array('product_stock_qty'));
                ProductStatistic::Statistic($item->item_product_id, array('buyed' => $item->item_qty));
            }

            $customer = Customer::model()->findByPk($this->customer_id);
            if ($customer->customer_default_address == 0) {
                $customer->customer_default_address = $this->order_address_id;
                $customer->saveAttributes(array('customer_default_address'));
            }

            /* email */
            $mail = new SyoSendEmail();
            $data = array(
                'hostUrl' => Yii::app()->request->hostInfo,
                'hostName' => Yii::app()->request->serverName,
                'name' => $customer->customer_name,
                'email' => $customer->customer_email,
                'view' => 'order',
                'subject' => 'Thank you for your order',
                'order' => $this,
                'address' => $this->address,
                'items' => $this->items,
            );
            $mail->sendByOrder($data);
        }
    }

    public function getInvoice() {
        $prefix = $this->site->domain_prefix;
        if ($this->customer->group->group_name == 'Warning') {
            $prefix = '(警告)';
        }
        return '(' . $prefix . ')' . $this->invoice_id;
    }

    public function getPrefix() {
        return '(' . Config::item('system', 'order_export_prefix') . ')';
    }

    public function getWeightTotal() {
        $req = Yii::app()->db->createCommand(
                        'SELECT sum(m1.item_qty*m1.item_weight) FROM {{order_item}} as m1 '
                        . " WHERE m1.order_id={$this->order_id}"
        );
        return $req->queryScalar();
    }

    public static function getCustomerValidOrders($customerID = 0) {
        $condition = '';
        if ($customerID) {
            $condition = "t1.customer_id={$customerID} AND ";
        }
        $sql = "SELECT  count(t1.order_id) FROM {{order}} AS t1
                     WHERE $condition t1.order_valid=1";

        $res = Yii::app()->db->createCommand($sql)->queryScalar();

        return $res;
    }

    public static function getCustomerTotalAmount($customerID = 0) {
        $condition = '';
        if ($customerID) {
            $condition = "AND t1.customer_id={$customerID}";
        }
        $sql = "SELECT SUM(t1.order_grandtotal/t2.currency_rate) AS total FROM {{order}} AS t1,{{currency}} AS t2
                    WHERE t1.order_currency_id=t2.currency_id $condition AND t1.order_valid=1";

        $res = Yii::app()->db->createCommand($sql)->queryScalar();

        return round(floatval($res), 1);
    }

    public static function getLifeTimeTotal() {
        $sql = "SELECT SUM(t1.order_grandtotal/t2.currency_rate) AS total FROM {{order}} AS t1,{{currency}} AS t2
                    WHERE t1.order_currency_id=t2.currency_id AND t1.order_valid=1";

        $res = Yii::app()->db->createCommand($sql)->queryScalar();

        return round(floatval($res), 1);
    }

    public static function getOrderAvg() {
        $sql = "SELECT AVG(t1.order_grandtotal/t2.currency_rate) AS total FROM {{order}} AS t1,{{currency}} AS t2
                    WHERE t1.order_currency_id=t2.currency_id AND t1.order_valid=1";

        $res = Yii::app()->db->createCommand($sql)->queryScalar();

        return round(floatval($res), 1);
    }


    /**
     * 货运导入使用，用于计算导入的字符串数值
     * @param $priceString
     * @return int
     */
    public static function getPriceByStringForShipping($priceString){
        $array=explode('+',$priceString);
        $price=0;
		
        if(count($array)>1){
           foreach($array as $key=>$value){
               $price +=(int)trim($value);
           }
        }else{
            $price = trim($priceString);
        }
        return $price;
    }

    public static function getStatisticSale($saleID) {
        $sql = "SELECT SUM(t1.order_grandtotal/t2.currency_rate) AS total FROM {{order}} AS t1,{{currency}} AS t2
                    WHERE t1.order_currency_id=t2.currency_id AND t1.order_valid=1";

        if ($saleID == 1) {
            $sql .= " AND TIMESTAMPDIFF(HOUR,order_payment_at,NOW())<=24";
        } else if ($saleID == 2) {
            $sql .= " AND TIMESTAMPDIFF(DAY,order_payment_at,NOW())<=7";
        } else if ($saleID == 3) {
            $sql .= " AND TIMESTAMPDIFF(MONTH,order_payment_at,NOW())<=1";
        } else if ($saleID == 4) {
            $sql .= " AND TIMESTAMPDIFF(MONTH,order_payment_at,NOW())<=3";
        } else if ($saleID == 5) {
            $sql .= " AND TIMESTAMPDIFF(MONTH,order_payment_at,NOW())<=6";
        }
        $res = Yii::app()->db->createCommand($sql)->queryScalar();
        return round(floatval($res), 1);
    }

    public function getOrderStatue($statue) {
        $statueString = '';
        switch ($statue) {
            case 1:
                $statueString = '待支付';
                break;
            case 2:
                $statueString = '尚未发货';
                break;
            case 3:
                $statueString = '已发货';
                break;
            case 5:
                $statueString = '退款';
                break;
            case 6:
                $statueString = '支付失败';
                break;
            case 7:
                $statueString = '付款取消';
                break;
            case 8:
                $statueString = '支付成功未收款';
                break;
            case 9:
                $statueString = '正在处理';
                break;
            case 10:
                $statueString = '删除';
                break;
            default :
                $statueString = '支付失败';
                break;
        }
        return $statueString;
    }

    public function getOrderInvoice($order) {
        $count = strrpos($order, ")");
        if ($count !== false) {
            $string = substr($order, $count + 1);
        } else {
            $string = $order;
        }
        return $string;
    }

    public function getAllOrderIdBySiteId($siteId) {
        $siteArray = array();
        $sql = 'select order_id from syn_order where order_site_id = ' . $siteId;
        $siteResult = Yii::app()->db->createCommand($sql)->queryAll();
        if ($siteResult) {
            foreach ($siteResult as $key => $value) {
                $siteArray[] = $value['order_id'];
            }
        }
        return $siteArray;
    }

    public function getPriceByRefund($isRate=false){
        $price=array();
        $currencyRateToCNY=Currency::returnAnyCurrencyToUSD($this->order_currency_id)*Currency::returnUSDToAnyCurrencyRate();
        $currencyRateToCNY=number_format($currencyRateToCNY,2,'.','');
        $price['rateToCny']=$currencyRateToCNY;
        if($this->order_status==Order::Refund){
            if($this->order_refund==0.0){
                $price['order_refund_CNY']=number_format($this->order_grandtotal*$currencyRateToCNY,2,'.','');
                $price['order_grandtotal_CNY']=number_format($this->order_grandtotal*$currencyRateToCNY,2,'.','');
                $price['order_refund']=number_format($this->order_grandtotal,2,'.','');
                $price['order_grandtotal']=number_format($this->order_grandtotal,2,'.','');
            }else{
                $price['order_refund_CNY']=number_format($this->order_refund*$currencyRateToCNY,2,'.','');
                $price['order_grandtotal_CNY']=number_format($this->order_grandtotal*$currencyRateToCNY+$this->order_refund*$currencyRateToCNY,2,'.','');
                $price['order_refund']=number_format($this->order_refund,2,'.','');
                $price['order_grandtotal']=number_format($this->order_grandtotal+$this->order_refund,2,'.','');
            }
        }else{
            $price['order_refund_CNY']=number_format($this->order_refund*$currencyRateToCNY,2,'.','');
            $price['order_grandtotal_CNY']=number_format($this->order_grandtotal*$currencyRateToCNY+$this->order_refund*$currencyRateToCNY,2,'.','');
            $price['order_refund']=number_format($this->order_refund,2,'.','');
            $price['order_grandtotal']=number_format($this->order_grandtotal+$this->order_refund,2,'.','');

        }
        return $price;

    }

    public static function getCalculate($stepChartName='阶梯图', $type='order', $xName=' ', $yName='Number', $cityId=0, $width=1000, $height=300, $teamId=0, $year=0) {
        $data['stepChartName'] = $stepChartName;
        $data['type'] = $type;
        $data['xName'] = $xName;
        $data['yName'] = $yName;
        $data['width'] = $width;
        $data['height'] = $height;
        $data['data'] = array();
        $data['total'] = 0;
        $isAll = 1;
        switch ($type) {
            //性别统计
            case 'order':
                if ($isAll) {
                    $sql = 'select user_sex, count(*) from vol_user group by user_sex ';
                }
                $team = Yii::app()->db->createCommand($sql)->queryAll();
                $data['total'] = count($team);
                if ($team) {
//                    foreach ($team as $key => $value) {
//                        $data['data'][$value['user_sex']] = (int) $value['count(*)'];
//                    }


                    $data['data']['pandora'] = 20;
                    $data['data']['prada'] = 11;
                    $data['data']['lv'] = 19;
                    $data['data']['AF&HCO'] = 19;
                }
//                $max = $data['data']['女'] > $data['data']['男'] ? $data['data']['女'] : $data['data']['男'];
//                if ($data['data']['男'] == NULL) {
//                    $data['data']['男'] = 0;
//                }
//                if ($data['data']['女'] == NULL) {
//                    $data['data']['女'] = 0;
//                }
                $max +=20000;
                $data['max'] = $max;
                $data['minCell'] = $max / 10;
                break;
            //年龄统计
            case 'age':
                //不愿透露
                $sql = 'select user_id from vol_user where TIMESTAMPDIFF(YEAR,user_birthdate_serach,now())<=6 || user_birthdate_serach=\' \';';
                $userBirthdate = Yii::app()->db->createCommand($sql)->queryAll();
                $data['data']['不愿透露'] = count($userBirthdate);

                //6-10
                $sql = 'select user_id from vol_user where TIMESTAMPDIFF(YEAR,user_birthdate_serach,now())>6 AND TIMESTAMPDIFF(YEAR,user_birthdate_serach,now())<=10;';
                $userBirthdate = Yii::app()->db->createCommand($sql)->queryAll();
                $data['data']['6-10'] = count($userBirthdate);
                $max = $data['data']['6-10'] > $data['data']['不愿透露'] ? $data['data']['6-10'] : $data['data']['不愿透露'];
                //10-20
                $sql = 'select user_id from vol_user where TIMESTAMPDIFF(YEAR,user_birthdate_serach,now())>10 AND TIMESTAMPDIFF(YEAR,user_birthdate_serach,now())<=20;';
                $userBirthdate = Yii::app()->db->createCommand($sql)->queryAll();
                $data['data']['10-20'] = count($userBirthdate);
                $max = $max > $data['data']['10-20'] ? $max : $data['data']['10-20'];
                //20-30
                $sql = 'select user_id from vol_user where TIMESTAMPDIFF(YEAR,user_birthdate_serach,now())>20 AND TIMESTAMPDIFF(YEAR,user_birthdate_serach,now())<=30;';
                $userBirthdate = Yii::app()->db->createCommand($sql)->queryAll();
                $data['data']['20-30'] = count($userBirthdate);
                $max = $max > $data['data']['20-30'] ? $max : $data['data']['20-30'];

                //30-40
                $sql = 'select user_id from vol_user where TIMESTAMPDIFF(YEAR,user_birthdate_serach,now())>30 AND TIMESTAMPDIFF(YEAR,user_birthdate_serach,now())<=40;';
                $userBirthdate = Yii::app()->db->createCommand($sql)->queryAll();
                $data['data']['30-40'] = count($userBirthdate);
                $max = $max > $data['data']['30-40'] ? $max : $data['data']['30-40'];

                //40-50
                $sql = 'select user_id from vol_user where TIMESTAMPDIFF(YEAR,user_birthdate_serach,now())>40 AND TIMESTAMPDIFF(YEAR,user_birthdate_serach,now())<=50;';
                $userBirthdate = Yii::app()->db->createCommand($sql)->queryAll();
                $data['data']['40-50'] = count($userBirthdate);
                $max = $max > $data['data']['40-50'] ? $max : $data['data']['40-50'];

                //50-60
                $sql = 'select user_id from vol_user where TIMESTAMPDIFF(YEAR,user_birthdate_serach,now())>50 AND TIMESTAMPDIFF(YEAR,user_birthdate_serach,now())<=60;';
                $userBirthdate = Yii::app()->db->createCommand($sql)->queryAll();
                $data['data']['50-60'] = count($userBirthdate);
                $max = $max > $data['data']['50-60'] ? $max : $data['data']['50-60'];

                //大于60
                $sql = 'select user_id from vol_user where TIMESTAMPDIFF(YEAR,user_birthdate_serach,now())>60 ';
                $userBirthdate = Yii::app()->db->createCommand($sql)->queryAll();
                $data['data']['大于60'] = count($userBirthdate);
                $max = $max > $data['data']['大于60'] ? $max : $data['data']['大于60'];

                $max +=20000;
                $data['max'] = $max;
                $data['minCell'] = $max / 10;
                break;
            //学历统计
            case 'educationBackground':
                $sql = 'select item_id ,item_content from vol_item_lookup where item_name="education"';
                $education = Yii::app()->db->createCommand($sql)->queryAll();
                $max = 0;
                if ($isAll) {
                    $sqlCondition = 'select user_id from vol_user where user_education_background=';
                } else if ($category['category_sub'] === '0') {
                    $data['stepChartName'] = $category['category_name'] . '学历统计';
                    $sqlCondition = 'select user_id from vol_user where user_category in(select category_id from vol_category where category_root_id = ' . $cityId . ') AND user_education_background=';
                } else if ($category['category_sub'] == 1 && $category['category_direct'] != 1 && $category['category_name']) {
                    $data['stepChartName'] = $category['category_name'] . '学历统计';
                    $sqlCondition = 'select user_id from vol_user where user_category in(select category_id from vol_category where category_parent_id = ' . $cityId . ' OR category_id = ' . $cityId . ') AND user_education_background=';
                } else if ($category['category_sub'] == 1 && $category['category_direct'] == 1) {
                    $data['stepChartName'] = $category['category_name'] . '学历统计';
                    $sqlCondition = 'select user_id from vol_user where ( user_category=' . $cityId . ' OR user_category=' . $category['category_parent_id'] . ' ) AND user_education_background=';
                } else if ($category['category_sub'] == 2) {
                    $data['stepChartName'] = $category['category_name'] . '学历统计';
                    $sqlCondition = 'select user_id from vol_user where user_category=' . $cityId . ' AND user_education_background=';
                }
                if ($education) {
//                    foreach ($education as $key => $value) {
//                        $sql = $sqlCondition . $value['item_id'];
//                        $user = Yii::app()->db->createCommand($sql)->queryAll();
//                        $data['data'][$value['item_content']] = count($user);
//                        $max = $max > $data['data'][$value['item_content']] ? $max : $data['data'][$value['item_content']];
//                    }
                    $data['data']['Pandora'] = 10.00;
                    $data['data']['AF&HCO'] = 36.84;
                    $data['data']['Prada'] = 45.45;
                    $data['data']['LV'] = 68.42;
                    $max +=150;
                    $data['max'] = $max;
                    $data['minCell'] = $max / 10;
                }
                break;
            default :
                break;
        }


        return $data;
    }


}