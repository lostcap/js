<?php

class SiteController extends BallController {

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'ImportSite', 'ChangePwd','admin'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
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
        $model = new Site;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Site'])) {
            $model->attributes = $_POST['Site'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->site_id));
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

        if (isset($_POST['Site'])) {
            $model->attributes = $_POST['Site'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->site_id));
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

    public function actionUpdateAll() {
        $sql = 'select * from seo_domain as t1 
            LEFT JION seo_domain_attribute as t2 on t1.domain_attribute=t2.attribute_id
            LEFT JION seo_domain_space as t3 on t1.domain_space_id=t3.space_id 
            LEFT JION seo_space_attribute as t4 on t4.space_id=t3.space_name_id 
            where t4.space_name="Diahosting" AND t2.attribute_name="资源站"
            ';
        $domain = Yii::app()->db->createCommand($sql)->queryAll();
        if ($doamin) {
            
        }
    }

    public function actionImportSite() {

        if (isset($_POST['yt0']) && isset($_FILES['uploadFile'])) {
            $file = CUploadedFile::getInstanceByName('uploadFile');
            if ($file->extensionName == 'xls') {
                $filename = 'media/upload/site_db' . date('Y-m-d') . '.' . $file->extensionName;
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
                            $site_name = strtolower(trim($item[0]));
                            $site = Site::model()->findByAttributes(array('site_name' => $site_name, 'site_prefix' => trim($item[1])));
                            if ($site) {
                                $site->site_db_host = trim($item[2]);
                                $site->site_db = trim($item[3]);
                                $site->site_db_name = trim($item[4]);
                                $site->site_db_password = trim($item[5]);
                                if ($site->update()) {
                                    $this->message['success'].='<strong>' . trim($item[0]) . '</strong>更新成功！<br>';
                                }
                            } else {
                                $site = new Site();
                                $site->site_name = $site_name;
                                $site->site_prefix = trim($item[1]);
                                $site->site_db_host = trim($item[2]);
                                $site->site_db = trim($item[3]);
                                $site->site_db_name = trim($item[4]);
                                $site->site_db_password = trim($item[5]);
                                if ($site->save()) {
                                    $this->message['success'].='<strong>' . trim($item[0]) . '</strong>添加成功！';
                                } else {
                                    $message = '';
                                    foreach ($site->errors as $key => $value) {
                                        $message.= $value[0] . '<br>';
                                    }
                                    $this->message['error'] = '<strong>' . trim($item[0]) . '</strong><br>' . $message;
                                }
                            }
                        }
                    }
                }
            } else {
                $this->message['error'] = '文件格式只能为xls';
            }
        }
        $this->render('importSite');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Site');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Site('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Site']))
            $model->attributes = $_GET['Site'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionChangePwd() {
        $pwd =new LoginChageForm();
        if (isset($_POST['LoginChageForm']) && isset($_POST['yt0'])&&!empty ($_POST['LoginChageForm'])) {
            $pwd->attributes=$_POST['LoginChageForm'];
            if ($pwd->validate()) {
                $employee = Employee::model()->findByAttributes(array('employee_email' => Yii::app()->user->id));
                if ($employee) {
                    $employee->employee_passwd = Employee::hashPwd($pwd->password);
                    if ($employee->save()) {
                        Yii::app()->user->logout();
                        $this->redirect('/ballwang/');
                        $this->message['success'] = '密码修改成功！';
                    }
                }
            }else{
                if($pwd->errors){
                    foreach ($pwd->errors as $key =>$value){
                        $this->message['error'] .=$value[0].'<br>';
                    }
                }
            }
        }
            
        $this->render('changepwd', array('model' => $pwd));
    }
    
     

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Site::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'site-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
