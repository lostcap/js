<?php

class StatisticController extends BallController {

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

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('DoStatistic','sendMail','ResetEmailServer'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'create', 'update'),
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
        $model = new Statistic;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Statistic'])) {
            $model->attributes = $_POST['Statistic'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->statistic_id));
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

        if (isset($_POST['Statistic'])) {
            $model->attributes = $_POST['Statistic'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->statistic_id));
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
        $dataProvider = new CActiveDataProvider('Statistic');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Statistic('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Statistic']))
            $model->attributes = $_GET['Statistic'];

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
        $model = Statistic::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'statistic-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionSendMail(){
        $order=Order::model()->findAll('order_email_queue>0');
        if($order){
           EmailServer::sendMail($order);
        }
    }




    public function actionResetEmailServer(){
         $emailServer=EmailServer::model()->findAll('email_used!=0 AND email_active=1');
        if($emailServer){
            foreach($emailServer as $key => $value){
                $value->email_used=0;
                $value->update();
            }
        }
    }




    public function actionDoStatistic() {
//        $str1=strtotime( "2012-12-5");
//        $str2=strtotime( "2012-01-01");
//        $string=$str1-$str2;
//        echo $string/(3600*24);
//        exit;
 
        for ($i = 340; $i >= 0; $i--) {
            $date = Statistic::returnStatisticTime($i);
            $category = PrimarySite::getActiveSiteCategory();
            $USDToCNYRate = Currency::returnUSDToAnyCurrencyRate();
            $AnyCurrencyToUSDArray = Currency::returnAnyCurrencyToUSDArray();
            if ($category) {
                $total['statistic_account'] = 0;
                $total['statistic_success_order'] = 0;
                $total['statistic_order_customer'] = 0;
                $total['statistic_order_site_num'] = 0;
                $total['statistic_register_customer'] = 0;
                foreach ($category as $key => $value) {
                    $statistic = Statistic::model()->findByAttributes(array('statistic_time' => $date['yesterdaytime'], 'statistic_category' => $key));
                    if (!$statistic) {
                        $statistic = new Statistic();
                    }
                    
                    $statistic->statistic_time_year = $date['yesterdayY'];
                    $statistic->statistic_time_month = $date['yesterdaym'];
                    $statistic->statistic_time_day = $date['yesterdayd'];
                    $statistic->statistic_time = $date['yesterdaytime'];
                    $statistic->statistic_category = $key;
                    $statistic->statistic_currency = 2;
                    $siteIdArray = Domain::getArraySiteIdBySupportSite($key);
                    $data = Statistic::returnStatisticOrderAccount($siteIdArray, $date['time'], $USDToCNYRate, $AnyCurrencyToUSDArray);
                    $statistic->statistic_account = $data['account'];
                    $statistic->statistic_success_order = $data['orderCount'];
                    $statistic->statistic_order_customer = $data['customer'];
                    $statistic->statistic_order_site_num = $data['orderSite'];
                    $orderData = Statistic::returnAllOrderDate($siteIdArray, $date['time']);
                    $statistic->statistic_register_customer = $orderData['registerCustomer'];
                    if ($statistic->save()) {
                        $total['statistic_account'] +=$statistic->statistic_account;
                        $total['statistic_success_order'] +=$statistic->statistic_success_order;
                        $total['statistic_order_customer'] +=$statistic->statistic_order_customer;
                        $total['statistic_order_site_num'] +=$statistic->statistic_order_site_num;
                        $total['statistic_register_customer'] +=$statistic->statistic_register_customer;
                    }
                }
                $statisticTotal = Statistic::model()->findByAttributes(array('statistic_time' => $date['yesterdaytime'], 'statistic_total' => 1));
                if (!$statisticTotal) {
                    $statisticTotal = new Statistic();
                }
                $statisticTotal->statistic_time_year = $date['yesterdayY'];
                $statisticTotal->statistic_time_month = $date['yesterdaym'];
                $statisticTotal->statistic_time_day = $date['yesterdayd'];
                $statisticTotal->statistic_time = $date['yesterdaytime'];
                $statisticTotal->statistic_total = 1;
                $statisticTotal->statistic_category = 0;
                $statisticTotal->statistic_currency = 2;
                $statisticTotal->statistic_account = $total['statistic_account'];
                $statisticTotal->statistic_success_order = $total['statistic_success_order'];
                $statisticTotal->statistic_order_customer = $total['statistic_order_customer'];
                $statisticTotal->statistic_order_site_num = $total['statistic_order_site_num'];
                $statisticTotal->statistic_register_customer = $total['statistic_register_customer'];
                if ($statisticTotal->save()) {
                    $this->message['success'] = $date['time'] . ' 统计成功!';
                } else {
                    $this->message['error'] = $date['time'] . '<span style="color:red;">统计失败</span>!';
                }
            }
        }
        //$this->render('dostatic');
    }

}
