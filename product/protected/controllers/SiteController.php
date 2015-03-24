<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
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

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
	 
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $headers = "From: {$model->email}\r\nReply-To: {$model->email}";
                mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
	
	public function actionTest(){
	$date=date('Y-m-d-H-i-s');
$message='This is site/Test action work time :'.$date."\n";
file_put_contents('Test.log', $message, FILE_APPEND);
	}

    public function actionWork() {
        $this->layout = 'column3';
        $auth = Yii::app()->authManager;
//        $auth->createOperation('domainAction', '域名管理');
//        $auth->createOperation('shippingAction', '货运权限');
//        $auth->createOperation('chatAction', '客服权限');
//        $auth->createOperation('saleAction', '销售权限');
//        $auth->createOperation('teamLeadAction', '组长权限');
//        $auth->createOperation('teamMemberAction', '组员权限');
//        $auth->createOPeration('personInChargeAction', '主管权限');
//        $auth->createOPeration('managerAction', '经理权限');
//        $auth->createOPeration('engineerAction', '工程师权限');
//        $auth->createOPeration('engineerInChargeAction', '工程师权限');
//        $role = $auth->createRole('domain');
//        $role->addChild('domainAction');
//
//        $role = $auth->createRole('shipping');
//        $role->addChild('shippingAction');
//
//        $role = $auth->createRole('sale');
//        $role->addChild('saleAction');
//        
//        $role = $auth->createRole('chat');
//        $role->addChild('chatAction');        
//
//        $role = $auth->createRole('teamMember');
//        $role->addChild('teamMemberAction');
//
//        $role = $auth->createRole('teamLead');
//        $role->addChild('teamMember');
//        $role->addChild('teamLeadAction');
//
//        $role = $auth->createRole('personInCharge');
//        $role->addChild('personInChargeAction');
//        $role->addChild('teamLead');
//        $role->addChild('sale');
//        $role->addChild('shipping');
//
//        $role = $auth->createRole('manager');
//        $role->addChild('personInCharge');
//        $role->addChild('managerAction');
//
//        $role = $auth->createRole('engineer');
//        $role->addChild('engineerAction');
//        $role->addChild('manager');
//
//        $role = $auth->createRole('engineerInCharge');
//        $role->addChild('engineerInChargeAction');
//        $role->addChild('engineer');
        
//        $auth->createOPeration('optionSql', 'SQL操作权限');
        $auth->addItemChild('engineerInCharge', 'domain');
        
        
        
        echo 'Add role OK !';
  
    }

}