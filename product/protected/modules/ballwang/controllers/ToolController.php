<?php

class ToolController extends BallController {

    public $actionMessage;
    public $dbMessage;
    public $layout = 'column2';

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('OutPutCustmerEmail', 'update', 'admin', 'delete','edm'),
                'roles' => array('engineerAction'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionOutPutCustmerEmail() {
        $siteForm = new SiteForm();
        $this->actionMessage = '特定的客户邮箱导出';
        $siteForm->getParameter();
        if ($siteForm->site) {
            Yii::import('application.vendors.*');
            require_once 'PHPExcel/PHPExcel.php';
            require_once 'PHPExcel/PHPExcel/IOFactory.php';
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', '网站名称')
                    ->setCellValue('B1', '客户Email')
                    ->setCellValue('C1', '客户姓名');
            $objPHPExcel->getActiveSheet(0)->setTitle('特定站点客户邮箱导出');
            $index = 2;
            foreach ($siteForm->site as $key => $value) {
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValueExplicit('A' . $index, $value->domain_name, PHPExcel_Cell_DataType::TYPE_STRING);
                $custmoerArray = Customer::returnCustomerEmail($value->domain_id);
                if ($custmoerArray) {
                    $i = 0;
                    foreach ($custmoerArray as $key => $value) {
                        $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('B' . ($index + $i), $key, PHPExcel_Cell_DataType::TYPE_STRING)
                                ->setCellValue('C' . ($index + $i), $value, PHPExcel_Cell_DataType::TYPE_STRING);
                        $i++;
                    }
                    $index +=$i;
                }
                $index++;
            }


            $name = '南京联嵌' . date('Y-m-d-H-i-s') . '客户邮箱导出.xls';
            $objPHPExcel->setActiveSheetIndex(0);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename=' . $name);
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        }
        if ($this->dbMessage) {
            Yii::app()->user->setFlash('warning', $this->dbMessage);
        }
        $this->render('Tool', array('siteForm' => $siteForm));
    }

    public function actionEDM(){
           if (isset($_POST['yt0']) && isset($_FILES['uploadFile'])) {
               $file = CUploadedFile::getInstanceByName('uploadFile');
            if ($file->extensionName == 'xls') {
                $filename = 'media/edm/refund_' . date('Y-m-d-H-i-s') . '.' . $file->extensionName;
                $file->saveAs($filename);
                Yii::import('application.vendors.*');
                require_once 'PHPExcel/PHPExcel.php';
                require_once 'PHPExcel/PHPExcel/IOFactory.php';
                $reader = PHPExcel_IOFactory::createReader('Excel5'); // 读取 excel 文件
                $reader->setReadDataOnly(true);
                $reader = $reader->load($filename);
				
                if ($reader) {
                    $message = '';
                    $EmailConfig=array();
                    $EmailConfig['emailHostPort']=25;
                    $EmailConfig['emailSMTPAuth']=1;
                    $EmailConfig['emailCharset']='UTF-8';
                    $EmailConfig['emailContentType']='text/html';
                    $emailSite='';
                    $allConfig=false;
                    $data = $reader->getSheet(0)->toArray();
					
                    foreach ($data as $row => $item) {
                        if (!empty($item) && $row > 1) {
                            if($item[5]&&$item[6]&&$item[7]){
                               $EmailConfig['emailHost']=trim($item[5]);
                               $EmailConfig['emailUsername']=trim($item[6]);
                               $EmailConfig['emailPassword']=trim($item[7]);
                            }
                            if($item[2]){
                                $EmailConfig['emailFromName']=$item[2];
                            }
                            if($item[3]){
                                $EmailConfig['emailFromAddress']=$item[3];
                            }
                            if($item[1]){
                                $emailSite=trim($item[1]);
                            }
                            if(!$allConfig){
                                if($EmailConfig['emailHost']&&$EmailConfig['emailUsername']&&$EmailConfig['emailPassword']){
                                    if($EmailConfig['emailFromName']){
                                        if($EmailConfig['emailFromAddress']){
                                                if($emailSite){
                                                    $allConfig=true;
                                                }else{
                                                    $this->message['error']='发送网站未配置';
                                                }
                                        }else{
                                            $this->message['error']='显示邮箱未配置';
                                        }
                                    }else{
                                        $this->message['error']='邮件名称未配置';
                                    }
                                }else{
                                    $this->message['error']='邮箱未配置';
                                }
                            }
                            if($allConfig){
                                $mail=new SyoEdmEmail($EmailConfig);
                                //$mail->showData();
                                $data['subject']=$EmailConfig['emailFromName'];
                                $data['email']=trim($item[0]);
                                $data['site']=trim($item[1]);
                                $data['view']=trim($item[4]);
								
                                if($mail->sendEDM($data)){
                                    $this->message['success'] .= trim($item[0]).'邮件使用'.$item[4].'模版发送成功！<br>';
                                }else{
                                    $this->message['error'] .= trim($item[0]).'邮件使用'.$item[4].'模版发送失败<！<br>';
                                }
                            }
                        }
                    }
                }
            } else {
                $this->message['error'] = '文件格式只能为xls';
            }
           }
        $this->render('edm');
    }

    public function getEmailServerDate($item){
        $emailConfig=array();


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