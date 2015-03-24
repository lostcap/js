<?php

class DefaultController extends BallController {

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function actionIndex() {
        $this->layout = 'column3';
        $login = new LoginForm();
        if (isset($_POST['LoginForm']) && isset($_POST['yt0'])) {
            $login->attributes = $_POST['LoginForm'];
            if ($login->validate() && $login->login()) {
                $this->redirect(array('order'));
            } else {
                if ($login->errors) {
                    foreach ($login->errors as $key => $value) {
                        $this->message['error'] .=$value[0] . '<br>';
                    }
                }
            }
        }
        if (Yii::app()->user->id) {
            $this->redirect(array('order'));
        }
        $this->render('index', array('model' => $login));
    }

    public function accessRules() {
        parent::accessRules();
    }

    public function actionOrder() {
        $model = new Order('search');
        $model->unsetAttributes();  // clear any default values

        $price = array('total' => 0);
        $currencyString = '';

        $outPutOrderForm=new OutPutOrderForm();

        $return = $this->_getPrice();
        $return2 = $this->_getPrice(2);
        $return7 = $this->_getPrice(7);
        $return30 = $this->_getPrice(30);

        $price = $return['price'];
        $currencyString = $return['currencyString'];


        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];

        $orderByTime=$this->getOrderTime();
        $this->render('order', array(
            'model' => $model,
            'price' => $price,
            'return2' => $return2,
            'return7' => $return7,
            'return30' => $return30,
            'currencyString' => $currencyString,
            'outPutOrderForm' => $outPutOrderForm,
            'orderByTime' => $orderByTime,
        ));
    }

    private function _getPrice($days=0, $timeStart='', $timeEnd='') {
        $sql = 'select order_grandtotal,order_currency_id,order_create_at from syo_order where order_status=2 OR order_status=3;';
        $criteria = new CDbCriteria();
        $criteria->select = 'order_grandtotal,order_currency_id';
        $criteria->addCondition('order_status=:Accepted', 'OR');
        $criteria->addCondition('order_status=:Shipped', 'OR');
        $criteria->addCondition('order_status=:PreparationProgress', 'OR');
        $criteria->params[':Accepted'] = Order::PaymentAccepted;
        $criteria->params[':Shipped'] = Order::Shipped;
        $criteria->params[':PreparationProgress'] = Order::PreparationProgress;
       // $criteria->addCondition('order_status=:Accepted OR order_status=:Shipped OR order_status=:PreparationProgress');
        $criteria->params[':Accepted'] = Order::PaymentAccepted;
        $criteria->params[':Shipped'] = Order::Shipped;
        $criteria->params[':PreparationProgress'] = Order::PreparationProgress;
        if ($days) {
            $criteria->addCondition('TIMESTAMPDIFF(DAY,order_create_at,now())<' . $days);
        }else{
            $middle=$timeStart;
            if(strtotime($timeStart) > strtotime($timeEnd)){
                $timeStart=$timeEnd;
                $timeEnd=$middle;
            }
            $criteria->addBetweenCondition('order_create_at' , $timeStart,$timeEnd);
        }
        $return = array();
        $order = Order::model()->findAll($criteria);
        if ($order) {
            foreach ($order as $key => $value) {
                $orderPrice[$value['order_currency_id']] += $value['order_grandtotal'];
            }
            foreach ($orderPrice as $key => $value) {
                $currency = Currency::model()->findByPk($key);
                $price[$currency->currency_title] += $value;
                $currencyString .='<p>' . $currency->currency_title . ': ' . $currency->currency_symbol . $value . ' 合人民币:￥' . number_format($currency->currency_rate_back * Currency::returnUSDToAnyCurrencyRate() * $value, 2);
                $price['total'] +=$value * $currency->currency_rate_back * Currency::returnUSDToAnyCurrencyRate();
            }
            $price['total'] = number_format($price['total'], 2);
        } else {
            $price['total'] = 0;
            $currencyString = '最近无单！';
        }
        $return['price'] = $price;
        $return['currencyString'] = $currencyString;
        $return['time'] = $timeStart.' 到 '.$timeEnd;
        return $return;
    }

    public function getOrderTime(){

        if(isset($_POST['OutPutOrderForm'])&&isset($_POST['yt0'])){

             $return =$this->_getPrice(0,$_POST['OutPutOrderForm']['outStartTime'],$_POST['OutPutOrderForm']['outEndTime']);
        }
        return $return;
    }
}

