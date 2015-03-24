<?php

class OrderController extends BallController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'column2';
    public $dbMessage = '';
    public $actionMessage = '';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );/**/
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
		array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array( 'SynOrder', 'SynSiteBack'),
                'users' => array('*'),
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'OutPutOrder'),
                'users' => array('@'),
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('Domain','ViewDomain','UpdateDomain'),
                'users' => array('@'),
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('noShippedAdmin', 'OrderSerach', 'orderSerachByCustomer', 'WaitingPayment', 'OutPutBreakDownWaitingPayment', 'OutPutWaitingPayment','Refund'),
                'roles' => array('chat'),
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('admin', 'noShippedAdmin', 'orderSerachByCustomer', 'productShippingShow', 'shippingImport', 'noshippedProduct', 'SynSite', 'OrderSerach', 'OutPutOrder','ShowOutputOrder'),
                'roles' => array('shipping'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'SynOrder'),
                'roles' => array('engineer'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('delete'),
                'roles' => array('engineerInCharge'),
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

        $model = $this->_load_model();
        if (!$ship = OrderShip::model()->findByAttributes(array('ship_order_id' => $model->order_id))) {
            $ship = new OrderShip();
        }

        if (isset($_POST['Order'])) {

            $model->order_status = $_POST['Order']['order_status'];
            if ($model->order_status == Order::Shipped) {
                $day = Config::item('ship', 'cycle');
                $ship->ship_order_id = $model->order_id;
                $ship->ship_start_at = date('Y-m-d H:i:s');
                $ship->ship_end_at = date('Y-m-d H:i:s', strtotime("+$day day"));
                $ship->ship_from = 'China';
                $ship->ship_to = $model->order_address_id;
                $ship->ship_code = str_replace(' ', '', $_POST['OrderShip']['ship_code']);
                if ($ship->save()) {
                    $model->order_ship_id = $ship->ship_id;
                    $model->order_site_option = 1;
                    $model->order_shipping_syn = 1;
                    $this->message['success'] = '货运号修改成功！<br>';
                } else {
                    $this->message['error'] = '货运号修改失败！';
                }
            }

            if ($model->order_status == Order::PaymentAccepted) {
                $model->order_export = 0;
            }
            $model->order_site_option = 1;
            $model->order_shipping_syn = 1;

            if ($model->save(false)) {
                $this->message['success'].='订单状态修改成功！';
            }

            if (!$history = OrderHistory::model()->findByAttributes(array('history_order_id' => $model->order_id))) {
                $history = new OrderHistory();
            }
            $history->history_employee_id = Yii::app()->user->id;
            $history->history_order_id = $model->order_id;
            $history->history_state = $model->order_status;
            $history->history_create = new CDbExpression("NOW()");
            $history->save();
            //   $history->informEmail($model->customer_id);
        }

        $order = new CActiveDataProvider('Order', array(
                    'criteria' => array(
                        'condition' => 'customer_id=' . $model->customer_id . ' AND order_status !=' . Order::Delete,
                    ),
                    'pagination' => array(
                        'pageSize' => 1000,
                    ),
                ));

        $address = new CActiveDataProvider('CustomerAddress', array(
                    'criteria' => array(
                        'condition' => 'customer_id=' . $model->customer_id,
                    )
                ));

        $script = "$('#order_status').change(function(){
                     if($(this).val()==3){
                         $('#ship_code').show();
                      }else{
                          $('#ship_code').hide();
                      }
                 });";
        //     Yii::app()->clientScript->registerScript('ship_code', $script, CClientScript::POS_READY);
        $this->render('view', array('model' => $model, 'ship' => $ship, 'order' => $order, 'address' => $address));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Order;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Order'])) {
            $model->attributes = $_POST['Order'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->order_id));
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

        if (isset($_POST['Order'])) {
            $model->attributes = $_POST['Order'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->order_id));
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
        $dataProvider = new CActiveDataProvider('Order');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Order('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionNoShippedAdmin() {
        $model = new Order('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];

        $this->render('noShippedAdmin', array(
            'model' => $model,
        ));
    }

    public function actionWaitingPayment() {
        $model = new Order('search');
        $model->unsetAttributes();  // clear any default values

        $message = '';
        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];

        if (isset($_FILES['uploadFile']) && !empty($_FILES['uploadFile']) && isset($_POST['yt0'])) {
            $file = CUploadedFile::getInstanceByName('uploadFile');
            if ($file->extensionName == 'xls') {
                $filename = 'media/live/live_' . date('Y-m-d-H-i-s') . '.' . $file->extensionName;
                $file->saveAs($filename);
                Yii::import('application.vendors.*');
                require_once 'PHPExcel/PHPExcel.php';
                require_once 'PHPExcel/PHPExcel/IOFactory.php';
                $reader = PHPExcel_IOFactory::createReader('Excel5'); // 读取 excel 文件
                $reader->setReadDataOnly(true);
                $reader = $reader->load($filename);
                if ($reader) {
                    $data = $reader->getSheet(0)->toArray();
                    foreach ($data as $row => $item) {
                        if (!empty($item) && $row > 1 && $item[0]) {
                            $order = Order::model()->findByAttributes(array('invoice_id' => Order::getOrderInvoice($item[0])));
                            if ($order) {
                                if ($order->order_status != Order::Delete) {
                                    $order->order_status = Order::Delete;
                                    $order->order_site_option = 1;
                                    $order->order_shipping_syn = 1;
                                    if ($order->save()) {
                                        $message .=$item[0] . ' 删除成功！<br>';
                                    }
                                } else {
                                    $message .=$item[0] . ' 已经删除<br>';
                                }
                            } else {
                                $message .=$item[0] . '<span style="color:red;"> 删除失败！</span>未找到订单！<br>';
                            }
                        }
                    }
                }
            } else {
                $message .='上传文件格式只能为.xls结尾<br>';
            }
            $this->message['info'] = $message;
        }
        $this->render('waitingPayment', array(
            'model' => $model,
        ));
    }
    
    
    public function actionRefund() {
        $model = new Order('search');
        $model->unsetAttributes();  // clear any default values

        $message = '';
        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];

        if (isset($_FILES['uploadFile']) && !empty($_FILES['uploadFile']) && isset($_POST['yt0'])) {
            $file = CUploadedFile::getInstanceByName('uploadFile');
            if ($file->extensionName == 'xls') {
                $filename = 'media/live/live_' . date('Y-m-d-H-i-s') . '.' . $file->extensionName;
                $file->saveAs($filename);
                Yii::import('application.vendors.*');
                require_once 'PHPExcel/PHPExcel.php';
                require_once 'PHPExcel/PHPExcel/IOFactory.php';
                $reader = PHPExcel_IOFactory::createReader('Excel5'); // 读取 excel 文件
                $reader->setReadDataOnly(true);
                $reader = $reader->load($filename);
                if ($reader) {
                    $data = $reader->getSheet(0)->toArray();
                    foreach ($data as $row => $item) {
                        if (!empty($item) && $row > 1 && $item[0]) {
                            $order = Order::model()->findByAttributes(array('invoice_id' => Order::getOrderInvoice($item[0])));
                            if ($order) {
                                if ($order->order_status != Order::Delete) {
                                    $order->order_status = Order::Delete;
                                    $order->order_site_option = 1;
                                    $order->order_shipping_syn = 1;
                                    if ($order->save()) {
                                        $message .=$item[0] . ' 删除成功！<br>';
                                    }
                                } else {
                                    $message .=$item[0] . ' 已经删除<br>';
                                }
                            } else {
                                $message .=$item[0] . '<span style="color:red;"> 删除失败！</span>未找到订单！<br>';
                            }
                        }
                    }
                }
            } else {
                $message .='上传文件格式只能为.xls结尾<br>';
            }
            $this->message['info'] = $message;
        }
        $this->render('refund', array(
            'model' => $model,
        ));
    }

    public function actionNoShippedProduct() {
        $model = new Order('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];

        $this->render('noShippedProduct', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionOrderSerach() {

        $model = new Order('search');
        $model->unsetAttributes();  // clear any default values
        $invoice = $_POST['invoice'];
        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];

        $this->render('serachInvoice', array(
            'model' => $model,
            'invoice' => $invoice,
        ));
    }

    public function actionOrderSerachByCustomer() {

        $model = new Order('search');
        $model->unsetAttributes();  // clear any default values
        $email = $_POST['email'];
        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];

        $this->render('serachInvoiceByCustomer', array(
            'model' => $model,
            'email' => $email,
        ));
    }

    /**
     * 
     */
    public function actionSynOrder() {
        $allDb = $this->getDbOrderConnection();
        if ($allDb['all']) {
            foreach ($allDb['all'] as $key => $value) {
                $this->getOrder($value);
            }
        }
        $this->redirect('admin');
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Order::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'order-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * 选择合适的站点同步订单，支持多站同步单点站同步。
     * @param type $all
     * @param type $siteId
     * @return type 返回站点信息对象
     */
    protected function getDbOrderConnection($all = true, $siteId = 0) {
        $dbconnect = array('all' => 0, 'single' => 0);
        if ($all) {
            $site = $this->getSite();
            $dbconnect['all'] = $site['all'];
        } else {
            if ($siteId) {
                $site = $this->getSite($siteId);
                $dbconnect['single'] = $site['single'];
            }
        }
        return $dbconnect;
    }

    protected function getSite($siteId=0) {
        $siteArray = array('all' => 0, 'single' => 0);
        if ($siteId == 0) {
            $site = Domain::model()->vpsSiteCriteria()->findAll();
            $siteArray['all'] = $site;
        } else {
            if (!$siteId) {
                $site = Domain::model()->vpsSingleSiteCriteria($siteId)->findAll();
                $siteArray['single'] = $site;
            }
        }
        return $siteArray;
    }

    protected function getOrder($db) {
        $dbConnectString = '';
        $row = '';
        $dbConnect = @mysql_connect($db->dataAddress->space_data_address, $db->domain_data_name, $db->domain_data_password);
        // $dbConnect = mysql_connect('localhost', 'root', '');
        if (!$dbConnect) {
            $this->dbMessage .= $db->domain_name . ' | ' . $db->domain_data . '<span style="color:red;"> 数据连接失败！</span><br>';
        } else {
            $db_selected = mysql_select_db($db->domain_data, $dbConnect);
            if ($db_selected) {

                // mysql_select_db('lv003', $dbConnect) or die('Query interrupted' . mysql_error());
//            $sql = "select t1.*,t2.*,t3.*,t4.carrier_name,t4.carrier_id,t5.response_txn_id,t6.*
//                from syo_order AS t1
//                LEFT JOIN  syo_customer_address  AS t2 ON t1.order_address_id=t2.address_id
//                LEFT JOIN syo_customer AS t3 ON t1.customer_id=t3.customer_id
//                LEFT JOIN syo_carrier AS t4 ON t1.order_carrier_id=t4.carrier_id
//                LEFT JOIN syo_paypal_response AS t5 ON t1.order_id=t5.order_id
//                LEFT JOIN syo_order_ship AS t6 ON t1.order_id=t6.ship_order_id
//                WHERE t1.order_valid=1 AND  (t1.order_status=" . Order::PaymentAccepted . " OR t1.order_status=" . Order::Shipped . " ) AND t1.order_export=0
//                ORDER BY order_payment_at ASC";

                $sql = "select t1.*,t2.*,t3.*,t4.carrier_name,t4.carrier_id,t5.response_txn_id,t6.*,t7.currency_code,t7.currency_rate,t7.currency_rate_back
                from syo_order AS t1
                LEFT JOIN  syo_customer_address  AS t2 ON t1.order_address_id=t2.address_id
                LEFT JOIN syo_customer AS t3 ON t1.customer_id=t3.customer_id
                LEFT JOIN syo_carrier AS t4 ON t1.order_carrier_id=t4.carrier_id
                LEFT JOIN syo_paypal_response AS t5 ON t1.order_id=t5.order_id
                LEFT JOIN syo_order_ship AS t6 ON t1.order_id=t6.ship_order_id
                LEFT JOIN syo_currency AS t7 ON t1.order_currency_id=t7.currency_id
                WHERE t1.order_export=0
                ORDER BY order_payment_at ASC";
                $query = mysql_query($sql);
                if ($query) {
                    while ($row = mysql_fetch_array($query)) {
                        $this->synOrderListUpdate($row, $db);
                    }
                    $this->dbMessage .=$db->domain_name . '<span style="color:green;"> 同步成功</span><br>';
                }
            } else {
                $this->dbMessage .=$db->domain_name . ' | ' . $db->domain_data . '<span style="color:red;"> 数据库选择失败</span><br>';
            }
        }
        @mysql_close($dbConnect);
    }

    protected function setOrderBack($db, $orderArray) {
        $dbConnectString = '';
        $row = '';
         $dbConnect = @mysql_connect($db->dataAddress->space_data_address, $db->domain_data_name, $db->domain_data_password);
        //$dbConnect = mysql_connect('localhost', 'root', '');
        if (!$dbConnect) {
            $this->dbMessage .= $db->domain_name . ' | ' . $db->domain_data . '<span style="color:red;"> 数据连接失败!</span><br>';
        } else {
                $db_selected = mysql_select_db($db->domain_data, $dbConnect);
            //$db_selected = mysql_select_db('lv003', $dbConnect);
            if ($db_selected) {
                foreach ($orderArray as $key => $order) {
                    $orderSiteSql = 'select order_id,order_currency_id from syo_order where invoice_id= "' . $order->invoice_id . '";';
                    $orderSite = mysql_query($orderSiteSql);
                    if ($orderSite) {
                        while ($row = mysql_fetch_array($orderSite)) {
                            if ($order->order_ship_id != 0) {
                                $ship = $order->ship;
                                $shipSql = 'insert into syo_order_ship (ship_order_id,ship_start_at,ship_end_at,ship_from,ship_to,ship_code) value ((select order_id from syo_order where invoice_id ="' . $order->invoice_id . '"),"' . $ship->ship_start_at . '","' . $ship->ship_end_at . '","' . $ship->ship_from . '",' . $row['order_currency_id'] . ',"' . $ship->ship_code . '")';
                                mysql_query($shipSql);
                                $sql = 'update syo_order set order_status=' . $order->order_status . ',order_ship_id=(select ship_id from syo_order_ship where ship_code="' . $ship->ship_code . '") where invoice_id="' . $order->invoice_id . '"';
                                $targetSite = mysql_query($sql);
                            } else {
                                $sql = 'update syo_order set order_status=' . $order->order_status . ' where invoice_id="' . $order->invoice_id . '" ;';
                                $targetSetOrder = mysql_query($sql);
                            }
                            if ($targetSetOrder || $targetSite) {
                                $order->order_shipping_syn = 0;
                                if ($order->save()) {
                                    $this->dbMessage .=$db->domain_name . '<span style="color:green;"> 反向同步成功!<br></span><br>';
                                } else {
                                    $this->dbMessage .=$db->domain_name . '<span style="color:red;"> 反向同步失败!<br></span><br>';
                                }
                            }
                        }
                        if (!$row) {
                            $this->dbMessage .=$db->domain_name . ' 未找到同步订单号: <span style="color:red;"> ' . $order->invoice_id . '<br></span><br>';
                        }
                    } else {
                        $this->dbMessage .=$db->domain_name . '<span style="color:red;"> 未找到同步订单号:' . $order->invoice_id . '!<br></span><br>';
                    }
                }
            } else {
                $this->dbMessage .=$db->domain_name . ' | ' . $db->domain_data . '<span style="color:red;"> 数据库选择失败!</span><br>';
            }
        }
        @mysql_close($dbConnect);
    }

    /**
     * 同步订单
     * @param type $row
     * @param type $type 
     */
    protected function synOrderListUpdate($row, $db) {
        $error = '';
        $success = '';
        $isNew = 1;
        $isOrder = Order::model()->findByAttributes(array('invoice_id' => $row['invoice_id']));
        if ($isOrder) {
            if (!$isOrder->order_site_option) {
                $order = $isOrder;
                $custmerId = (int) $row['customer_id'];
                $order->order_status = $row['order_status'];
                $order->order_ship_id = $row['order_ship_id'];
                $order->order_valid = $row['order_valid'];
                $order->order_export = $row['order_export'];
                $order->order_create_at = $row['order_create_at'];
                if ($order->update()) {
                    
                } else {
                    
                }
            }
        } else {
            $order = new Order();
            $order->order_site_id = $db->domain_id;
            $order->invoice_id = $row['invoice_id'];
            $custmerId = (int) $row['customer_id'];
            $userAndAddress = $this->setUser($row, $db);
            $order->customer_id = $userAndAddress['userId'];                                //change
            $order->order_subtotal = $row['order_subtotal'];
            $order->order_trackingtotal = $row['order_trackingtotal'];
            $order->order_promo_free = $row['order_promo_free'];
            $order->order_grandtotal = $row['order_grandtotal'];
            $order->order_currency_id = $this->currency[trim($row['currency_code'])];
            $order->order_payment_id = $row['order_payment_id'];
            $order->order_carrier_id = $row['order_carrier_id'];                      //change
            $order->order_address_id = $userAndAddress['addressId'];                      //change
            $order->order_ship_id = $row['order_ship_id'];
            $order->order_discount_id = $row['order_discount_id'];
            $order->order_status = $row['order_status'];
            $order->order_valid = $row['order_valid'];
            $order->order_export = $row['order_export'];
            $order->order_qty = $row['order_qty'];
            $order->order_ip = $row['order_ip'];
            $order->order_salt = $row['order_salt'];
            $order->order_comment = $row['order_comment'];
            $order->order_create_at = $row['order_create_at'];
            $order->order_payment_at = $row['order_payment_at'];
            if ($order->save()) {
                $sqlItem = "SELECT t1.*,t2.product_name,t2.product_sku,t3.* FROM syo_order_item as t1
                        LEFT JOIN syo_product as t2 ON t1.item_product_id=t2.product_id
                        LEFT JOIN syo_order_attribute as t3 ON t1.item_attribute_id=t3.order_attribute_id
                        where t1.order_id={$row['order_id']}";

                $queryItem = mysql_query($sqlItem);
                while ($rowItem = @mysql_fetch_array($queryItem)) {
                    //同步属性
                    if ($rowItem['order_attribute_color'] || $rowItem['order_attribute_size']) {
                        $orderAttribute = OrderAttribute::model()->findByAttributes(array('order_attribute_size' => $rowItem['order_attribute_size'], 'order_attribute_color' => $rowItem['order_attribute_color']));
                        if (!$orderAttribute) {
                            $orderAttribute = new OrderAttribute();
                            $orderAttribute->order_attribute_color = $rowItem['order_attribute_color'];
                            $orderAttribute->order_attribute_size = $rowItem['order_attribute_size'];
                            if ($orderAttribute->save()) {
                                
                            } else {
                                var_dump($orderAttribute->errors);
                            }
                        }
                    }
                    //同步订单
                    //$product = ProductCollection::model()->findByAttributes(array('product_sku' => $rowItem['product_sku'], 'product_site_id' => $db->domain_id));
                    $product = ProductCollection::model()->findByAttributes(array('product_sku' => $rowItem['product_sku']));
                    if (!$product) {
                        $product = new ProductCollection();
                        if (!$rowItem['product_name'] || !$rowItem['product_sku']) {
                            $product->product_name = $rowItem['item_product_name'];       //更新时候可以 item_product_name可以保存SKU
                            $product->product_sku = $rowItem['item_product_name'];
                        } else {
                            $product->product_name = $rowItem['product_name'];
                            $product->product_sku = $rowItem['product_sku'];
                        }
                        $product->product_site_id = $db->domain_id;
                        $product->save();
                    }
                    $orderItem = new OrderItem();
                    $orderItem->item_qty = $rowItem['item_qty'];
                    $orderItem->item_price = $rowItem['item_price'];
                    $orderItem->item_weight = $rowItem['item_weight'];
                    $orderItem->item_total = $rowItem['item_total'];
                    $orderItem->item_attribute_id = $orderAttribute->order_attribute_id;
                    $orderItem->item_product_id = $product->product_id;
                    $orderItem->item_product_name = $product->product_sku;
                    $orderItem->order_id = $order->order_id;
                    $orderItem->save();
                }
            } else {
                $error .=$db->domain_prefix . $row['invoice_id'] . '订单同步失败！<br>';
            }
        }
        if ($order) {
            $ship = OrderShip::model()->findByAttributes(array('ship_order_id' => $order->order_id));
            if ($ship) {
                $ship->ship_to = $row['ship_to'];
                $ship->ship_code = $row['ship_code'];
                $ship->update();
            } else {
                $orderShip = new OrderShip();
                $orderShip->ship_order_id = $order->order_id;
                $orderShip->ship_start_at = $row['ship_start_at'];
                $orderShip->ship_end_at = $row['ship_end_at'];
                $orderShip->ship_from = $row['ship_from'];
                $orderShip->ship_to = $order->order_address_id;
                $orderShip->ship_code = $row['ship_code'];
                if ($orderShip->save()) {
                    $order->order_ship_id = $orderShip->ship_id;
                    $order->update();
                } else {
                    
                }
            }
        }
    }

    /**
     * 用户账号和地址信息录入
     * @param type $row
     * @param type $db
     * @return array() 返回为数组附带用户ID，地址ID，成功信息，失败信息 
     */
    protected function setUser($row, $db) {
        $isAddressExist = 0;
        $addressReturnId = 0;
        $error = '';
        $success = '';
        $userId = 0;
        $return = array();
        $user = Customer::model()->findByAttributes(array('customer_email' => $row['customer_email']));
        if ($user) {
            //如有变动则更新
            $userString = md5($user->customer_name . $user->customer_active . $user->customer_role . $user->customer_default_address . $user->customer_group);
            $rowUserString = md5($row['customer_name'] . $row['customer_active'] . $row['customer_role'] . $row['customer_default_address'] . $row['customer_group']);
            if ($userString != $rowUserString) {
                $user->customer_active = $row['customer_active'];
                $user->customer_role = $row['customer_role'];
                $user->customer_default_address = $row['customer_default_address'];
                $user->customer_group = $row['customer_group'];
                $user->customer_visit_count = $row['customer_visit_count'];
                $user->save();
            }
            $userId = $user->customer_id;
            //检查地址是否存在
            $address = $user->address;
            $isAddressExist = 0;
            foreach ($address as $key => $value) {
                $addressString = $value->address_create_at;
                $rowString = $row['address_create_at'];
                if (md5($addressString) == md5($rowString)) {
                    $addressReturnId = $value->address_id;
                    $isAddressExist = 1;
                }
            }
            if (!$isAddressExist) {
                $address = new CustomerAddress();
                $address->customer_id = $user->customer_id;
                $address->customer_gender = $row['customer_gender'];
                $address->customer_firstname = $row['customer_firstname'];
                $address->customer_lastname = $row['customer_lastname'];
                $address->address_company = $row['address_company'];
                $address->address_street = $row['address_street'];
                $address->address_city = $row['address_city'];
                $address->address_state = $row['address_state'];
                $address->address_country = $row['address_country'];
                $address->address_postcode = $row['address_postcode'];
                $address->address_phonenumber = $row['address_phonenumber'];
                $address->address_create_at = $row['address_create_at'];
                if ($address->save()) {
                    $addressReturnId = $address->address_id;
                } else {
                    $error .=$db->domain_prefix . $row['customer_name'] . ' 存在账号但地址保存失败！<br>';
                }
            }
        } else {
            $user = new Customer();
            $user->customer_email = $row['customer_email'];
            $user->customer_name = $row['customer_name'];
            $user->customer_pwd = $row['customer_pwd'];
            $user->customer_newsletter = $row['customer_newsletter'];
            $user->customer_active = $row['customer_active'];
            $user->customer_role = $row['customer_role'];
            $user->customer_default_address = $row['customer_default_address'];
            $user->customer_group = $row['customer_group'];
            $user->customer_ip = $row['customer_ip'];
            $user->customer_login = $row['customer_login'];
            $user->customer_visit_count = $row['customer_visit_count'];
            $user->customer_last_update = $row['customer_last_update'];
            $user->customer_create_at = $row['customer_create_at'];
            if ($user->save()) {
                $address = new CustomerAddress();
                $address->customer_id = $user->customer_id;
                $address->customer_gender = $row['customer_gender'];
                $address->customer_firstname = $row['customer_firstname'];
                $address->customer_lastname = $row['customer_lastname'];
                $address->address_company = $row['address_company'];
                $address->address_street = $row['address_street'];
                $address->address_city = $row['address_city'];
                $address->address_state = $row['address_state'];
                $address->address_country = $row['address_country'];
                $address->address_postcode = $row['address_postcode'];
                $address->address_phonenumber = $row['address_phonenumber'];
                $address->address_create_at = $row['address_create_at'];
                if ($address->save()) {
                    $addressReturnId = $address->address_id;
                } else {
                    $error .=$db->domain_prefix . $row['customer_name'] . ' 地址保存失败！<br>';
                }
                $userId = $user->customer_id;
            } else {
                $error .= $db->domain_prefix . $row['customer_email'] . '账号保存失败！<br>';
            }
        }
        $return['success'] = $success;
        $return['error'] = $error;
        $return['addressId'] = $addressReturnId;
        $return['userId'] = $userId;

        return $return;
    }

    private function _load_model() {
        if (isset($_GET['id'])) {
            $model = Order::model()->findByPk($_GET['id']);
        }
        if ($model == null) {
            throw new CHttpException(404, "The requested page does not exist!");
        }
        return $model;
    }

    public function actionOutPutOrder() {
        $this->breadcrumbs = array(
            'Orders' => array('index'),
            '订单导出',
        );


        $model = new OutPutOrderForm();
        if (isset($_POST['yt0']) && isset($_POST['OutPutOrderForm'])) {
            $model->attributes = $_POST['OutPutOrderForm'];
            $model->site = $_POST['OutPutOrderForm']['site'];
            $model->outStartTime = $_POST['OutPutOrderForm']['outStartTime'];
            $model->outEndTime = $_POST['OutPutOrderForm']['outEndTime'];
            $model->paymentStatue = $_POST['OutPutOrderForm']['paymentStatue'];
            $model->getOrder();
            $orders = $model->order;
            Yii::import('application.vendors.*');
            require_once 'PHPExcel/PHPExcel.php';
            require_once 'PHPExcel/PHPExcel/IOFactory.php';
            if ($orders) {
                $objPHPExcel = new PHPExcel();
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', '下单时间')->setCellValue('B1', '订单编号')
                        ->setCellValue('C1', 'SKU')->setCellValue('D1', '商品名')
                        ->setCellValue('E1', '数量')->setCellValue('F1', '客户姓名')
                        ->setCellValue('G1', '国家')->setCellValue('H1', '省/州')
                        ->setCellValue('I1', '城市')->setCellValue('J1', '地址一')
                        ->setCellValue('K1', '地址二')->setCellValue('L1', '邮编')
                        ->setCellValue('M1', '电话')->setCellValue('N1', '货运方式')
                        //  ->setCellValue("O1", 'Email')->setCellValue("P1", "交易号")
                        ->setCellValue("Q1", "交易号");
                $objPHPExcel->getActiveSheet(0)->setTitle('订单输出');
                $index = 2;
                foreach ($orders as $key => $order) {
                    $orderPrefix = $order->site->domain_prefix;
                    $address = $order->address;
                    $carrier = $order->carrier;
                    $customer = $order->customer;
                    $paypal = $order->paypal;
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValueExplicit('A' . $index, $order['order_create_at'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('B' . $index, '(' . $orderPrefix . ')' . $order['invoice_id'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('F' . $index, $address['customer_firstname'] . ' ' . $address['customer_lastname'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('G' . $index, Country::item($address['address_country']), PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('H' . $index, $address['address_state'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('I' . $index, $address['address_city'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('J' . $index, $address['address_street'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('K' . $index, '', PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('L' . $index, $address['address_postcode'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('M' . $index, $address['address_phonenumber'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('N' . $index, $carrier['carrier_name'], PHPExcel_Cell_DataType::TYPE_STRING)
                            //    ->setCellValueExplicit('O' . $index, $customer['customer_email'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('P' . $index, $paypal['response_txn_id'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('Q' . $index, Order::getOrderStatue($order['order_status']), PHPExcel_Cell_DataType::TYPE_STRING);

                    $sql = "SELECT t1.*,t2.product_name AS pname,t2.product_sku FROM {{order_item}} as t1
                        LEFT JOIN {{product_collection}} as t2 ON t1.item_product_id=t2.product_id
                        where t1.order_id={$order['order_id']}";
                    $productList = Yii::app()->db->createCommand($sql)->queryAll();
                    $i = 0;
                    $j = 0;
                    $array = array();
                    foreach ($productList as $row) {
                        $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('C' . ($index + $i), $row['product_sku'], PHPExcel_Cell_DataType::TYPE_STRING)
                                ->setCellValueExplicit('D' . ($index + $i), $row['pname'], PHPExcel_Cell_DataType::TYPE_STRING)
                                ->setCellValueExplicit('E' . ($index + $i), $row['item_qty']);
                        $i++;
                    }
                    $index += $i;
                }

                $name = '南京联嵌' . date('Y') . '年' . date('m月d日', strtotime($model->outStartTime)) . '-' . date('m月d日', strtotime($model->outEndTime)) . '订单导出.xls';
                $objPHPExcel->setActiveSheetIndex(0);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename=' . $name);
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('php://output');
            } else {
                $this->message['error'] = date('Y-m-d', strtotime($model->outStartTime)) . '到' . date('Y-m-d', strtotime($model->outEndTime)) . '无满足条件的订单';
            }
        }
        $this->render('outPutOrder', array('model' => $model, 'order' => $order));
    }

    public function actionProductShippingShow() {
        $this->breadcrumbs = array(
            'Orders' => array('index'),
            '发货统计',
        );
        $z = 2;
        $array = array();

        $model = new OutPutOrderForm();
        if (isset($_POST['yt0']) && isset($_POST['OutPutOrderForm'])) {
            $model->attributes = $_POST['OutPutOrderForm'];
            $model->site=$_POST['OutPutOrderForm']['site'];
            $model->outStartTime = $_POST['OutPutOrderForm']['outStartTime'];
            $model->outEndTime = $_POST['OutPutOrderForm']['outEndTime'];
            $model->paymentStatue = 2;
            $model->getOrder();
            $orders = $model->order;

            Yii::import('application.vendors.*');
            require_once 'PHPExcel/PHPExcel.php';
            require_once 'PHPExcel/PHPExcel/IOFactory.php';

            if ($orders) {
                $objPHPExcel = new PHPExcel();
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', '下单时间')->setCellValue('B1', '订单编号')
                        ->setCellValue('C1', 'SKU')->setCellValue('D1', '商品名')
                        ->setCellValue('E1', '数量')->setCellValue('F1', '客户姓名')
                        ->setCellValue('G1', '国家')->setCellValue('H1', '省/州')
                        ->setCellValue('I1', '城市')->setCellValue('J1', '地址一')
                        ->setCellValue('K1', '地址二')->setCellValue('L1', '邮编')
                        ->setCellValue('M1', '电话')->setCellValue('N1', '货运方式')
                        //   ->setCellValue("O1", 'Email')->setCellValue("P1", "交易号")
                        ->setCellValue("Q1", "交易号");
                $objPHPExcel->getActiveSheet(0)->setTitle('订单输出');
                $index = 2;
                foreach ($orders as $key => $order) {
                    if($order->order_export==0){
                    $orderPrefix = $order->site->domain_prefix;
                    $address = $order->address;
                    $carrier = $order->carrier;
                    $customer = $order->customer;
                    $paypal = $order->paypal;
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValueExplicit('A' . $index, $order['order_create_at'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('B' . $index, '(' . $orderPrefix . ')' . $order['invoice_id'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('F' . $index, $address['customer_firstname'] . ' ' . $address['customer_lastname'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('G' . $index, Country::item($address['address_country']), PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('H' . $index, $address['address_state'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('I' . $index, $address['address_city'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('J' . $index, $address['address_street'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('K' . $index, '', PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('L' . $index, $address['address_postcode'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('M' . $index, $address['address_phonenumber'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('N' . $index, $carrier['carrier_name'], PHPExcel_Cell_DataType::TYPE_STRING)
                            //       ->setCellValueExplicit('O' . $index, $customer['customer_email'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('P' . $index, $paypal['response_txn_id'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('Q' . $index, Order::getOrderStatue($order['order_status']), PHPExcel_Cell_DataType::TYPE_STRING);

                    $sql = "SELECT t1.*,t2.product_name AS pname,t2.product_sku FROM {{order_item}} as t1
                        LEFT JOIN {{product_collection}} as t2 ON t1.item_product_id=t2.product_id
                        where t1.order_id={$order['order_id']}";
                    $productList = Yii::app()->db->createCommand($sql)->queryAll();
                    $i = 0;
                    $j = 0;

                    foreach ($productList as $row) {
                        $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('C' . ($index + $i), $row['product_sku'], PHPExcel_Cell_DataType::TYPE_STRING)
                                ->setCellValueExplicit('D' . ($index + $i), $row['pname'], PHPExcel_Cell_DataType::TYPE_STRING)
                                ->setCellValueExplicit('E' . ($index + $i), $row['item_qty']);
                        if ($array[$row['product_sku']]) {
                            $array[$row['product_sku']] += $row['item_qty'];
                        } else {
                            $array[$row['product_sku']] = $row['item_qty'];
                        }
                        $i++;
                    }
                    $index += $i;
                    $order->order_status=Order::PreparationProgress;
                    $order->order_site_option=1;
                    $order->order_export=1;
                    $order->save(false);
                    }
                }

                if ($array) {

                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('S' . 1, '发货产品名称', PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValue('T' . 1, '数量', PHPExcel_Cell_DataType::TYPE_STRING);
                    foreach ($array as $key => $value) {
                        $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('S' . $z, $key, PHPExcel_Cell_DataType::TYPE_STRING)
                                ->setCellValue('T' . $z, $value, PHPExcel_Cell_DataType::TYPE_STRING);
                        $z++;
                    }
                }

                $name = '南京联嵌' . date('Y') . '年' . date('m月d日', strtotime($model->outStartTime)) . '-' . date('m月d日', strtotime($model->outEndTime)) . '未发货订单统计.xls';
                $objPHPExcel->setActiveSheetIndex(0);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename=' . $name);
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('php://output');
            } else {
                $this->message['error'] = date('Y-m-d', strtotime($model->outStartTime)) . '到' . date('Y-m-d', strtotime($model->outEndTime)) . '无满足条件的订单';
            }
        }
        $this->render('productShippingShow', array('model' => $model, 'order' => $order));
    }

    public function actionShowOutputOrder(){
        $model = new Order('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];

        $this->render('showOutputOrder', array(
            'model' => $model,
        ));
    }

    public function actionShippingImport() {

        if (isset($_POST['yt0']) && isset($_FILES['uploadFile'])) {
            $file = CUploadedFile::getInstanceByName('uploadFile');
            if ($file->extensionName == 'xls') {
                $filename = 'media/shipping/shipping_' . date('Y-m-d-H-i-s') . '.' . $file->extensionName;
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
                    foreach ($data as $row => $item) {
                        if (!empty($item) && $row > 1) {
                            $order = trim($item[0]);
                            $count = strpos($order, ')');
                            $orerId = substr($order, $count + 1);
                            $order = Order::model()->findByAttributes(array('invoice_id' => $orerId));
                            if ($order) {
                                if ($order->order_status != 3) {
                                    $ship = new OrderShip();
                                    $ship->ship_order_id = $order->order_id;
                                    $ship->ship_start_at = date('Y-m-d H:m:s', time());
                                    $ship->ship_end_at = date('Y-m-d H:m:s', time() + '15days');
                                    $ship->ship_from = 'China';
                                    $ship->ship_to = $order->address->address_country;
                                    $ship->ship_code = $item[1];

                                    if ($ship->save()) {
                                        $order->order_site_option = 1;
                                        $order->order_shipping_syn = 1;
                                        $order->order_ship_id = $ship->ship_id;
                                        $order->order_status = 3;
                                        $order->order_export = 0;
                                        $order->update();
                                        $this->message['success'] .=$item[0] . '货运号 '.$item[1].' 导入成功成功.<br/>';
                                    }else{
                                        var_dump($ship->errors);
                                    }
                                } else {
                                    $this->message['error'].=$item[0] . '订单号 '.$item[1].' 已经导入.<br/>';
                                }
                            } else {
                                $this->message['error'] .=$orerId . '订单号没有找到.<br/>';
                            }
                        }
                    }
                }

            } else {
                $this->message['error'] = '文件格式只能为xls';
            }
        }
        $this->render('shippingImport');
    }

    public function actionOutPutWaitingPayment() {

        $this->breadcrumbs = array(
            'Orders' => array('index'),
            '待发货订单导出',
        );
        $z = 2;
        $array = array();

        $model = Order::model()->findAllByAttributes(array('order_status' => Order::AwaitingPayment));
        $orders = $model;

        if (!$model) {
            $model = new Order();
        }


        if ($orders) {
            Yii::import('application.vendors.*');
            require_once 'PHPExcel/PHPExcel.php';
            require_once 'PHPExcel/PHPExcel/IOFactory.php';
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', '下单时间')->setCellValue('B1', '订单编号')
                    ->setCellValue('C1', 'SKU')->setCellValue('D1', '商品名')
                    ->setCellValue('E1', '数量')->setCellValue('F1', '客户姓名')
                    ->setCellValue('G1', '国家')->setCellValue('H1', '省/州')
                    ->setCellValue('I1', '城市')->setCellValue('J1', '地址一')
                    ->setCellValue('K1', '地址二')->setCellValue('L1', '邮编')
                    ->setCellValue('M1', '电话')->setCellValue('N1', '货运方式')
                    ->setCellValue("O1", 'Email')->setCellValue("P1", "交易号")
                    ->setCellValue("Q1", "交易号");
            $objPHPExcel->getActiveSheet(0)->setTitle('订单输出');
            $index = 2;
            foreach ($orders as $key => $order) {
                $orderPrefix = $order->site->domain_prefix;
                $address = $order->address;
                $carrier = $order->carrier;
                $customer = $order->customer;
                $paypal = $order->paypal;
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValueExplicit('A' . $index, $order['order_create_at'], PHPExcel_Cell_DataType::TYPE_STRING)
                        ->setCellValueExplicit('B' . $index, '(' . $orderPrefix . ')' . $order['invoice_id'], PHPExcel_Cell_DataType::TYPE_STRING)
                        ->setCellValueExplicit('F' . $index, $address['customer_firstname'] . ' ' . $address['customer_lastname'], PHPExcel_Cell_DataType::TYPE_STRING)
                        ->setCellValueExplicit('G' . $index, Country::item($address['address_country']), PHPExcel_Cell_DataType::TYPE_STRING)
                        ->setCellValueExplicit('H' . $index, $address['address_state'], PHPExcel_Cell_DataType::TYPE_STRING)
                        ->setCellValueExplicit('I' . $index, $address['address_city'], PHPExcel_Cell_DataType::TYPE_STRING)
                        ->setCellValueExplicit('J' . $index, $address['address_street'], PHPExcel_Cell_DataType::TYPE_STRING)
                        ->setCellValueExplicit('K' . $index, '', PHPExcel_Cell_DataType::TYPE_STRING)
                        ->setCellValueExplicit('L' . $index, $address['address_postcode'], PHPExcel_Cell_DataType::TYPE_STRING)
                        ->setCellValueExplicit('M' . $index, $address['address_phonenumber'], PHPExcel_Cell_DataType::TYPE_STRING)
                        ->setCellValueExplicit('N' . $index, $carrier['carrier_name'], PHPExcel_Cell_DataType::TYPE_STRING)
                        ->setCellValueExplicit('O' . $index, $customer['customer_email'], PHPExcel_Cell_DataType::TYPE_STRING)
                        ->setCellValueExplicit('P' . $index, $paypal['response_txn_id'], PHPExcel_Cell_DataType::TYPE_STRING)
                        ->setCellValueExplicit('Q' . $index, Order::getOrderStatue($order['order_status']), PHPExcel_Cell_DataType::TYPE_STRING);

                $sql = "SELECT t1.*,t2.product_name AS pname,t2.product_sku FROM {{order_item}} as t1
                        LEFT JOIN {{product_collection}} as t2 ON t1.item_product_id=t2.product_id
                        where t1.order_id={$order->order_id}";

                $productList = Yii::app()->db->createCommand($sql)->queryAll();
                $i = 0;
                $j = 0;

                foreach ($productList as $row) {
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('C' . ($index + $i), $row['product_sku'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('D' . ($index + $i), $row['pname'], PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValueExplicit('E' . ($index + $i), $row['item_qty']);
                    if ($array[$row['product_sku']]) {
                        $array[$row['product_sku']] +=$row['item_qty'];
                    } else {
                        $array[$row['product_sku']] = $row['item_qty'];
                    }
                    $i++;
                }
                if ($i == 0) {
                    $index++;
                } else {
                    $index += $i;
                }
            }

            if ($array) {
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('S' . 1, '发货产品名称', PHPExcel_Cell_DataType::TYPE_STRING)
                        ->setCellValue('T' . 1, '数量', PHPExcel_Cell_DataType::TYPE_STRING);
                foreach ($array as $key => $value) {
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('S' . $z, $key, PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValue('T' . $z, $value, PHPExcel_Cell_DataType::TYPE_STRING);
                    $z++;
                }
            }
            $name = '南京联嵌' . date('Y-m-d') . '待付款订单导出.xls';
            $objPHPExcel->setActiveSheetIndex(0);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename=' . $name);
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        } else {
            $this->message['error'] = '无满足条件的订单';
        }

        $this->render('waitingPayment', array('model' => $model, 'order' => $order));
    }

    public function actionOutPutBreakDownWaitingPayment() {

        $z = 2;
        $array = array();

        $model = Order::model()->findAllByAttributes(array('order_status' => Order::AwaitingPayment));
        $orders = $model;

        if (!$model) {
            $model = new Order();
        }

        if ($orders) {
            Yii::import('application.vendors.*');
            require_once 'PHPExcel/PHPExcel.php';
            require_once 'PHPExcel/PHPExcel/IOFactory.php';
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', '下单时间')->setCellValue('B1', '订单编号');
            $objPHPExcel->getActiveSheet(0)->setTitle('订单输出');
            $index = 2;
            foreach ($orders as $key => $order) {
                $orderPrefix = $order->site->domain_prefix;

                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValueExplicit('A' . $index, $order['order_create_at'], PHPExcel_Cell_DataType::TYPE_STRING)
                        ->setCellValueExplicit('B' . $index, '(' . $orderPrefix . ')' . $order['invoice_id'], PHPExcel_Cell_DataType::TYPE_STRING);
                $index++;
            }
            $name = '南京联嵌' . date('Y-m-d') . '待付款订单导出.xls';
            $objPHPExcel->setActiveSheetIndex(0);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename=' . $name);
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        } else {
            $this->message['error'] = '无满足条件的订单';
        }

        $this->redirect('OutPutWaitingPayment');
    }

    public function actionSynSite() {
        $siteForm = new SiteForm();
        $this->actionMessage = '特定站点同步';
        $siteForm->getParameter();
        if ($siteForm->site) {
            foreach ($siteForm->site as $key => $value) {
                $this->getOrder($value);
            }
        }
        if ($this->dbMessage) {
            Yii::app()->user->setFlash('warning', $this->dbMessage);
        }
        $this->render('synSite', array('siteForm' => $siteForm));
    }

    public function actionSynSiteBack() {
        $order = Order::model()->findAllByAttributes(array('order_shipping_syn' => 1));
        $siteArray = array();
        $orderArray = array();
        if ($order) {
            foreach ($order as $key => $value) {
                $siteArray[$value->order_site_id][] = $value;
            }
            foreach ($siteArray as $key => $value) {
                $site = Domain::model()->findByPk($key);
                $this->setOrderBack($site, $value);
            }
//            $site = Domain::model()->findByPk($value->order_site_id);
//            $this->setOrderBack($site, $value);
        }
        if ($this->dbMessage) {
            Yii::app()->user->setFlash('warning', $this->dbMessage);
        }
        $this->render('synOrderBack');
    }

    public function actionDomain(){

        $model = new Domain('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Domain']))
            $model->attributes = $_GET['Domain'];

        $this->render('domain', array(
            'model' => $model,
        ));
    }

    public function actionViewDomain(){
        $id=(int)$_GET['id'];
        $domain=Domain::model()->findByAttributes(array('domain_id'=>$id));
        $sql='select sum(order_grandtotal) as sale,order_currency_id from syo_order where order_site_id=70 and order_status=3 group by order_currency_id ';
        $result=Yii::app()->db->createCommand($sql)->queryAll();
        $this->render('viewDomain',array('model'=>$domain));
    }

    public function actionUpdateDomain(){
        $id=(int)$_GET['id'];

        $domain=Domain::model()->findByAttributes(array('domain_id'=>$id));
        $sql='select sum(order_grandtotal) as sale,order_currency_id from syo_order where order_site_id=70 and order_status=3 group by order_currency_id ';
        $result=Yii::app()->db->createCommand($sql)->queryAll();
        if($_POST['Domain']&&isset($_POST['yt0'])){
           if( $domain->domain_user!=$_POST['Domain']['domain_user']){
               $userBefore=DomainUser::model()->findByPk($domain->domain_user);
               $userafter=DomainUser::model()->findByPk($_POST['Domain']['domain_user']);
              $history['domain_user']['before']=$userBefore->user_name;
              $history['domain_user']['after']=$userafter->user_name;
           }
           if($domain->domain_seo_keywords!=$_POST['Domain']['domain_seo_keywords']){
              $history['domain_seo_keywords']['before']=$domain->domain_seo_keywords;
              $history['domain_seo_keywords']['after']=$_POST['Domain']['domain_seo_keywords'];
           }
            if($domain->domain_note_seo!=$_POST['Domain']['domain_note_seo']){
                $history['domain_note_seo']['before']=$domain->domain_note_seo;
                $history['domain_note_seo']['after']=$_POST['Domain']['domain_note_seo'];
            }
           $domain->domain_user=$_POST['Domain']['domain_user'];
           $domain->domain_seo_keywords=$_POST['Domain']['domain_seo_keywords'];
           $domain->domain_note_seo=$_POST['Domain']['domain_note_seo'];
           if($domain->save()){
               if($history){
                   $user=Yii::app()->user->name;
                  foreach($history as $key=>$value){
                      $sql="insert into syo_history (history_made,history_type,history_domain_id,history_before,history_after) values ('".$user."','".$key."','".$domain->domain_id."','".$value['before']."','".$value['after']."')";
                      Yii::app()->db->createCommand($sql)->execute();
                  }
               }
               Yii::app()->user->setFlash('success',$domain->domain_name. '修改成功！');
           }

        }
        $historyShowSql='select * from syo_history where history_domain_id='.$domain->domain_id;
        $historyShow=Yii::app()->db->createCommand($historyShowSql)->queryAll();
        $this->render('updateDomain',array('model'=>$domain,'historyShow'=>$historyShow));
    }

}
