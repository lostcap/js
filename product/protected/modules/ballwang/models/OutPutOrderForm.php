<?php

class OutPutOrderForm extends CFormModel {

    public $site = 0;
    public $outStartTime;
    public $outEndTime;
    public $timeMiddel;
    public $order;
    Public $page;
    public $siteArray = array();
    public $paymentStatue;
    public $paymentStatueArray = array();
    public $returnString='';

    public function __construct($scenario = '') {
        parent::__construct($scenario);
        $siteArray = Domain::model()->findAllByAttributes(array('domain_active' => 1));
        $this->siteArray[0] = '所有站点';
        if ($siteArray) {
            foreach ($siteArray as $key => $value) {
                if($value->domain_prefix){
                    $this->siteArray[$value->domain_id] = $value->domain_prefix;
                }
            }
        }
        $this->paymentStatueArray[Order::PaymentAccepted] = '支付成功未发货';
        $this->paymentStatueArray[Order::AwaitingPayment] = '未支付成功';
        $this->paymentStatueArray[Order::Shipped] = '已发货';
        $this->paymentStatueArray[Order::Canceled] = '订单取消取消';
        $this->paymentStatueArray[Order::Refund] = '订单退款';
        $this->paymentStatueArray[0] = '所有状态';
        $this->outEndTime = date('Y-m-d');
        $this->outStartTime = date('Y-m-d', strtotime("$this->outEndTime- 1day"));
    }

    public function attributeLabels() {
        return array(
            'site' => '选择导出网站',
            'outStartTime' => '开始时间',
            'outEndTime' => '结束时间',
            'paymentStatue' => '选择订单状态',
        );
    }

    protected function _changeTime() {
        if (strtotime($this->outStartTime) > strtotime($this->outEndTime)) {
            $this->timeMiddel = $this->outStartTime;
            $this->outStartTime = $this->outEndTime;
            $this->outEndTime = $this->timeMiddel;
        }
    }


    public function getOrder() {
        $this->_changeTime();
        $criteria = new CDbCriteria();
        if ($this->site != 0) {
            $criteria->addCondition('order_site_id=:siteId');
            $criteria->params[':siteId'] = $this->site;
        }
        if ($this->paymentStatue) {
            $criteria->addCondition('order_status=:siteStatue');
            $criteria->params[':siteStatue'] = $this->paymentStatue;
        }
        $criteria->addBetweenCondition('order_create_at', $this->outStartTime, $this->outEndTime);
        $this->order = Order::model()->findAll($criteria);
    }

}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
