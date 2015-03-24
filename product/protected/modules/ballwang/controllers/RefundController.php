<?php

class RefundController extends BallController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        Yii::app()->clientScript->registerScriptFile('/js/highcharts.js');
        Yii::app()->clientScript->registerScriptFile('/js/exporting.js');
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array(
                'allow',
                'actions' => array('Delete', 'doRefund'),
                'roles' => array('chat'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'create', 'update', 'Delete', 'doRefund', 'ChartRefund'),
                'roles' => array('personInCharge'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Refund;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Refund'])) {
            $model->attributes = $_POST['Refund'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->refund_id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Refund'])) {
            $model->attributes = $_POST['Refund'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->refund_id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Refund');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Refund('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Refund']))
            $model->attributes = $_GET['Refund'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Refund::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'refund-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDoRefund() {
        if (isset($_POST['yt0']) && isset($_FILES['uploadFile'])) {
            $file = CUploadedFile::getInstanceByName('uploadFile');
            if ($file->extensionName == 'xls') {
                $filename = 'media/shipping/refund_' . date('Y-m-d-H-i-s') . '.' . $file->extensionName;
                $file->saveAs($filename);
                Yii::import('application.vendors.*');
                require_once 'PHPExcel/PHPExcel.php';
                require_once 'PHPExcel/PHPExcel/IOFactory.php';
                $reader = PHPExcel_IOFactory::createReader('Excel5'); // 读取 excel 文件
                $reader->setReadDataOnly(true);
                $reader = $reader->load($filename);
                if ($reader) {
                    $message = '';
                    $data = $reader->getSheet(0)->toArray();
                    $usdToCnyRate = Currency::returnUSDToAnyCurrencyRate();
                    $currencyArray = Currency::returnAnyCurrencyToUSDArray();
                    foreach ($data as $row => $item) {
                        if (!empty($item) && $row > 1) {
                            $refundData = explode('+', $item[0]);
                            $order = trim($item[1]);
                            $count = strpos($order, ')');
                            $orerId = substr($order, $count + 1);
                            $order = Order::model()->findByAttributes(array('invoice_id' => $orerId));
                            if ($order) {
                                if (count($refundData) == 7) {
                                    $refund = Refund::model()->findByAttributes(array('refund_order_num' => $orerId));
                                    if (!$refund || $item[3] == '1') {
                                        $refund = new Refund();
                                    }
                                    $refund->refund_order_num = $orerId;
                                    $refund->refund_order_id = $order->order_id;
                                    $date = Statistic::returnStatisticByTime($order->order_create_at);
                                    $refund->statistic_time_year = $date['Y'];
                                    $refund->statistic_time_month = $date['m'];
                                    $refund->statistic_time_day = $date['d'];
                                    $refund->statistic_time = $date['time'];
                                    $refund->refund_currency = $order->order_currency_id;
                                    $refund->refund_account = trim($refundData[5]);
                                    $refund->refund_account_cny = $usdToCnyRate * $currencyArray[$order->order_currency_id] * $refund->refund_account;
                                    $refund->refund_paymethod = $order->order_payment_id;
                                    $refund->refund_site = $order->order_site_id;
                                    $refund->refund_content_category_id = $this->getCategoryIdByName($item[2]);
                                    $refund->refund_category = Domain::getSupportIdBySiteId($order->order_site_id);
                                    $refund->refund_content = $refundData[1];
                                    $refund->refund_country = $order->address->address_country;
                                    $refund->refund_order_time = $order->order_create_at;
                                    $orderStatus=$order->order_status;
                                    if ($refund->save()) {
                                        $refundDataPaymentStatus = trim($refundData[6]);
                                        $refundCount = trim($refundData[5]);
                                        if ($refundDataPaymentStatus == '全部退款' || $refundDataPaymentStatus == '拒付') {
                                            $orderStatus = Order::Refund;
                                            $refund->refund_status = 1;
                                        } else if ($refundDataPaymentStatus == '部分退款') {
                                            if ($order->currency->currency_code == trim($refundData[4])) {
                                                if ($item[3] == '1') {
                                                    if ($refundCount < $order->order_grandtotal) {
                                                        $order->order_grandtotal -= $refundCount;
                                                        $order->order_refund +=$refundCount;
                                                        $this->message['success'] .=$item[1] . '<span style="color:#1FC4C4;"> 再次退款成功!</span><br/>';
                                                    } else {
                                                        $this->message['success'] .=$item[1] . '<span style="color:red;"> 再次退款金额不足!</span><br/>';
                                                        $refund->delete();
                                                        continue;
                                                    }
                                                } else if ($refundCount < $order->order_grandtotal) {
                                                    if ($order->order_refund == '0.0') {
                                                        $order->order_grandtotal -= $refundCount;
                                                        $order->order_refund = $refundCount;
                                                        $refund->refund_status = 2;
                                                    } else {
                                                        $this->message['success'] .=$item[1] . '<span style="color:#1FC4C4;"> 该项已经退款!</span><br/>';
                                                        continue;
                                                    }
                                                } else {
                                                    if ($order->order_refund == '0.0') {
                                                        $this->message['success'] .=$item[1] . '<span style="color:red;"> 退款金额超限!</span><br/>';
                                                    } else {
                                                        $this->message['success'] .=$item[1] . '<span style="color:#1FC4C4;"> 该项已经退款!</span><br/>';
                                                    }
                                                    if ($refund->refund_status != 1 && $refund->refund_status != 2) {
                                                        $refund->delete();
                                                    }
                                                    continue;
                                                }
                                                
                                            } else {
                                                $this->message['success'] .=$item[1] . '<span style="color:red;"> 退款币种错误!</span><br/>';
                                                if ($refund->refund_status != 1) {
                                                    $refund->delete();
                                                }
                                                continue;
                                            }
                                        } else {
                                            $this->message['success'] .=$item[1] . '<span style="color:red;"> 退款状态错误!</span><br/>';
                                            if ($refund->refund_status != 1) {
                                                $refund->delete();
                                            }
                                            continue;
                                        }
                                        $showNew=true;
                                        if($order->order_status == $orderStatus){
                                            $this->message['success'] .=$item[1] . '<span style="color:#1FC4C4;"> 该项已经退款!</span><br/>';
                                            $showNew=false;
                                        }
                                        $order->order_status = $orderStatus;
                                        $order->order_site_option = 1;
                                        $order->order_shipping_syn = 1;
                                        $refund->update();
                                        $order->update();
                                        if ($showNew) {
                                            $this->message['success'] .=$item[1] . ' 退款记录录入成功!<br/>';
                                        }
                                    }
                                } else {
                                    $this->message['success'] .=$item[1] . '<span style="color:red;"> 退款格式错误!</span><br/>';
                                }
                            } else {
                                $this->message['success'] .=$orerId . '<span style="color:red;"> 订单号没有找到</span><br/>';
                            }
                        }
                    }
                }
            } else {
                $this->message['error'] = '文件格式只能为xls';
            }
        }
        $refund = new Refund('search');
        $refund->unsetAttributes();
        if (isset($_GET['Refund'])) {
            $refund->attributes = $_GET['Refund'];
            $refund->refund_status = $_GET['Refund']['refund_status'];
        }
        $this->render('doRefund', array('model' => $refund));
    }

    public function actionChartRefund() {
        $refund = new Refund('search');
        $refund->unsetAttributes();
        if (isset($_GET['Refund'])) {
            $refund->attributes = $_GET['Refund'];
            $refund->refund_status = $_GET['Refund']['refund_status'];
        }
        $timeCategory = Time::getTime(Time::getTimeByState(), 'month');
        $data = Statistic::getCalculateSex('', 'refund');
        $this->render('chartRefund', array('model' => $refund, 'timeCategory' => $timeCategory, 'data' => $data));
    }

    public function getCategoryIdByName($name) {
        $name = trim($name);
        $refundCategory = RefundCategory::model()->findByAttributes(array('refund_category_name' => $name));
        if (!$refundCategory) {
            $refundCategory = new RefundCategory();
            $refundCategory->refund_category_name = $name;
            $refundCategory->refund_category_root = 1;
            $refundCategory->save();
        }
        return $refundCategory->refund_category_id;
    }

}
