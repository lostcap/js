<?php
class ChartController extends BallController {


public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }
	
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'create', 'update', 'TotalSale'),
                'roles' => array('personInCharge'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        Yii::app()->clientScript->registerScriptFile('/js/highcharts.js');
        Yii::app()->clientScript->registerScriptFile('/js/exporting.js');
    }

    public function actionChart() {
        $this->render('Chart');
    }

    public function actionTotalSale() {
        $data= Statistic::getCalculateSex('', 'total', 'month', '统计日期', '总销售额(元)');
        $data1=  Statistic::getCalculateSex('', 'totalArea', 'month', '统计日期', '总销售额(元)');
        $data2=  Statistic::getCalculateSex('', 'totalCategory', 'month', '统计日期', '总销售额(元)');
        $this->render('totalSale',array('data'=>$data,'dataArea'=>$data1,'dataCategory'=>$data2));
    }
    
    public function actionRefund(){
        $data= Statistic::getCalculateSex('', 'total', 'month', '统计日期', '总销售额(元)');
        $this->render('refund');
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}