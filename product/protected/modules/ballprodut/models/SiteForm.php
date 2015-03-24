<?php

class SiteForm extends CFormModel {
    //分类搜索
    public $siteCategorySelect = array();
    public $siteCategory = array();
    //特定网站收索
    public $siteSearchSelect = array();
    public $siteSearch = array();
    public $siteSearchShow = 10;                //特定网站显示数量
    //权重收索
    public $prioritySelect = array();
    public $priority = array('0' => 0, '1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9);
    //网站订单量收索
    public $orderSelect = array();
    public $order = '';
    public $siteStartTime = '';
    public $siteEndTime = '';
    public $siteMiddleTime = '';
    public $siteContent='';
    public $siteContentArray=array();
    //返回满足条件的网站
    public $site = array();
    public $siteIdArray=array();
    public $criteria = '';
    public $uploadFile = '';
    public $uploadFileLike = '';
    public $inputSql = '';
    public $sql = '';
    public $message = '';


    public function __construct($scenario = '') {
        parent::__construct($scenario);
        $this->criteria = new CDbCriteria();
        $this->getSiteCategory();
        $this->getSiteSearch();
        $this->siteEndTime = date('Y-m-d');
        $this->siteStartTime = date('Y-m-d', strtotime("$this->siteEndTime- 1day"));
    }

    public function attributeLabels() {
        return array(
            'siteCategory' => '分类',
            'siteSearch' => '特定站点',
            'siteCategorySelect' => '分类选择',
            'siteSearchSelect' => '网站选择',
            'prioritySelect' => '权重选择',
            'sitedownSKU' => '下架商品SKU',
            'siteContent'=>'多站点选择',
            'siteStartTime'=>'开始时间',
            'siteEndTime'=>'结束时间',
        );
    }

    /**
     * 根据上传的参数返回满足条件的网站
     */
    public function getSelectCondition() {
        $this->_changeTime();
        if (!empty($this->siteSearchSelect)) {
            $this->criteria->addInCondition('domain_id', $this->siteSearchSelect);
        } else if (!empty($this->orderSelect)) {
            $this->criteria->addInCondition('domain_id', $this->orderSelect);
        } else {
            if (!empty($this->siteCategorySelect)) {
                $this->criteria->addInCondition('domain_site_support', $this->siteCategorySelect);
            }
            if (!empty($this->prioritySelect)) {
                $this->criteria->addInCondition('domain_priority', $this->prioritySelect);
            }
            if ($this->siteStartTime && $this->siteEndTime) {
                $this->criteria->addBetweenCondition('domain_online_time', $this->siteStartTime, $this->siteEndTime);
            }
        }
        $this->criteria->select = 'domain_id,domain_name';
        $domain = Domain::model()->findAll($this->criteria);
        if ($domain) {
            foreach ($domain as $key => $value) {
                $this->site[$value['domain_id']] = $value['domain_id'];
            }
        }
    }

    protected function _changeTime() {
        if (strtotime($this->siteStartTime) > strtotime($this->siteEndTime)) {
            $this->siteMiddleTime = $this->siteStartTime;
            $this->siteStartTime = $this->siteEndTime;
            $this->siteEndTime = $this->siteMiddleTime;
        }
    }

    /**
     * 根据传入项获得网站分类
     * @param int $id 
     */
    public function getSiteCategory($id=1) {
        $sql = 'select primary_site_id,primary_site_name from syo_primary_site where primary_site_used = ' . $id;
        $siteCategory = Yii::app()->db->createCommand($sql)->queryAll();
        if ($siteCategory) {
            foreach ($siteCategory as $key => $value) {
                $this->siteCategory[$value['primary_site_id']] = $value['primary_site_name'];
            }
        }
    }

    /**
     * 特定网站选择条件
     */
    public function getSiteSearch() {
        $sql = 'select domain_id ,domain_name from syo_domain where domain_active=1';
        $siteSearch = Yii::app()->db->createCommand($sql)->queryAll();

        if ($siteSearch) {
            foreach ($siteSearch as $key => $value) {
                $this->siteSearch[$value['domain_id']] = $value['domain_name'];
            }
        }
    }

    /**
     * 获得表单内容，并以数组形式返回查询到的站点！
     */
    public function getParameter($siteActive=true) {
        if (isset($_POST['SiteForm'])) {
            $this->criteria = new CDbCriteria();
            $this->siteCategorySelect = $_POST['SiteForm']['siteCategorySelect'];
            $this->prioritySelect = $_POST['SiteForm']['prioritySelect'];
            $this->siteSearchSelect = $_POST['SiteForm']['siteSearchSelect'];
            $this->siteStartTime = $_POST['SiteForm']['siteStartTime'];
            $this->siteEndTime = $_POST['SiteForm']['siteEndTime'];
            $this->siteContent= $_POST['SiteForm']['siteContent'];
            if($this->siteContent){
                    $this->siteContent=explode(',',$this->siteContent);
                foreach($this->siteContent as $key=>$value){
                    $this->siteContentArray[]=trim($value);
                }
            }
            if ($this->siteSearchSelect) {
                $this->criteria->addInCondition('domain_id', $this->siteSearchSelect);
            } else if ($this->siteCategorySelect || $this->prioritySelect) {
                if ($this->siteCategorySelect)
                    $this->criteria->addInCondition('domain_site_support', $this->siteCategorySelect);
                if ($this->prioritySelect)
                    $this->criteria->addInCondition('domain_priority', $this->prioritySelect);
            }else if ($this->siteContentArray){
                $this->criteria->addInCondition('domain_name',$this->siteContentArray);
            }
            $this->_changeTime();
            if($siteActive){
                $this->criteria->addCondition('domain_active=1');
            }else{
                $this->criteria->addCondition('domain_active<2');
            }
            $site = Domain::model()->findAll($this->criteria);
            if ($site) {
                $this->site = $site;
            }
        }
    }

    /**
     *根据已经筛选完的站点提出满足条件站点的ID
     */
    public function getOrderBySite(){
        if($this->site){
            foreach($this->site as $key=>$value){
                 $this->siteIdArray[]=$value->domain_id;
            }
        }
    }

    /**
     * 安装时间导出订单，并且只导出已经发货的订单
     */
    public function getAllOrder($orderLevel=1,$parmeter=true){
        $this->getParameter($parmeter);
        $this->getOrderBySite();
        if($this->siteIdArray){
            $criteria = new CDbCriteria();
            $criteria->addBetweenCondition('order_create_at', $this->siteStartTime, $this->siteEndTime);
            //只导出已经发货的订单
            $criteria->addInCondition('order_site_id',$this->siteIdArray);
            if($orderLevel==1){
                $criteria->addCondition('order_status='.Order::Shipped);
            }else if($orderLevel==2){
                $criteria->addCondition('order_status='.Order::Shipped.' OR order_status='.Order::Refund);
            }

            $this->order = Order::model()->findAll($criteria);
        }
    }


    /**
     * 活动自定义内容
     */
    public function getInputFile() {
        if (isset($_FILES['uploadFile']) && isset($_POST['yt0'])) {
            $file = CUploadedFile::getInstanceByName('uploadFile');
            if ($file->extensionName == 'xls') {
                $filename = 'media/product/downProduct_' . date('Y-m-d') . '.' . $file->extensionName;
                $file->saveAs($filename);
                Yii::import('application.vendors.*');
                require_once 'PHPExcel/PHPExcel.php';
                require_once 'PHPExcel/PHPExcel/IOFactory.php';
                $reader = PHPExcel_IOFactory::createReader('Excel5'); // 读取 excel 文件
                $reader->setReadDataOnly(true);
                $reader = $reader->load($filename);
                if ($reader) {
                    //获得文件句柄
                    $this->uploadFile = $reader->getSheet(0)->toArray();
                }
            } else {
                if ($file) {
                    Yii::app()->user->setFlash('warning', '系统只接受以.xls结尾的文件！');
                } else {
                    Yii::app()->user->setFlash('error', '文件不能为空！');
                }
            }
        } else if (isset($_FILES['uploadFileLike']) && isset($_POST['yt1'])) {
            $file = CUploadedFile::getInstanceByName('uploadFileLike');
            if ($file->extensionName == 'xls') {
                $filename = 'media/product/downProductLike_' . date('Y-m-d') . '.' . $file->extensionName;
                $file->saveAs($filename);
                Yii::import('application.vendors.*');
                require_once 'PHPExcel/PHPExcel.php';
                require_once 'PHPExcel/PHPExcel/IOFactory.php';
                $reader = PHPExcel_IOFactory::createReader('Excel5'); // 读取 excel 文件
                $reader->setReadDataOnly(true);
                $reader = $reader->load($filename);
                if ($reader) {
                    //获得文件句柄
                    $this->uploadFileLike = $reader->getSheet(0)->toArray();
                }
            } else {
                if ($file) {
                    Yii::app()->user->setFlash('warning', '系统只接受以.xls结尾的文件！');
                } else {
                    Yii::app()->user->setFlash('error', '文件不能为空！');
                }
            }
        } else if (isset($_POST['inputSql']) && isset($_POST['yt2'])) {
            //活动自定义的SQL语句
            $this->inputSql = $_POST['inputSql'];
        }
    }

    /**
     * 执行数据库连接,同步到各个站点。
     * @param $domain
     * @param $sql
     * @param bool $array
     */
    protected function getOrder($domain, $sql, $array=FALSE) {
        $dbConnectString = '';
        $message = '';
        $row = '';
        $dbConnect = @mysql_connect($domain->dataAddress->space_data_address, $domain->domain_data_name, $domain->domain_data_password);
        //$dbConnect = mysql_connect('localhost', 'root', '');
        if (!$dbConnect) {
            echo $message .= $domain->domain_data . '数据连接失败！<br>';
        } else {
            mysql_select_db($domain->domain_data, $dbConnect) or die('Query interrupted' . mysql_error());
            //mysql_select_db('yqee1_1_12', $dbConnect) or die('Query interrupted' . mysql_error());
            //区分sql是否为数组形式。
            if ($array) {
                foreach ($sql as $key => $value) {
                    $query = mysql_query($value);
                    if ($query) {
                        $message .= $domain->domain_name . '执行' . $value . '成功！<br>';
                    } else {
                        $message .= $domain->domain_name . '执行' . $value . '<span style="color:red">失败</span>！<br>';
                    }
                }
            } else {
                $query = mysql_query($sql);
                if ($query) {
                    $message .= $domain->domain_name . '执行' . $sql . '成功！<br>';
                } else {
                    $message .= $domain->domain_name . '执行' . $sql . '<span style="color:red">失败</span>！<br>';
                }
            }
        }
        $this->message .=$message;
        @mysql_close($dbConnect);
    }

    /**
     * 根据不同的动作执行相关的操作
     * @param $action
     */
    public function excuteProduct($action) {
        //获得传入参数
        $this->getParameter();
        if ($this->site) {
            //获得上传文件
            $this->getInputFile();
            if ($this->uploadFile) {
                //根据上传文件内人整理出需要处理的产品SKU
                $array = '(\'\'';
                foreach ($this->uploadFile as $key => $value) {
                    if (!empty($value) && $key > 1) {
                        $array .=',' . '\'' . trim($value[0]) . '\'';
                    }
                }
                $array .=')';
                //活动对应sql
                if ($action == 'down') {
                    $sql = 'update syo_product set product_active = 0 where product_sku in ' . $array;
                } else if ($action == 'up') {
                    $sql = 'update syo_product set product_active = 1 where product_sku in ' . $array;
                } else if ($action == 'delete') {
                    $sql = 'delete from syo_product where product_sku in ' . $array;
                }
                //同步到各个站点
                foreach ($this->site as $key => $value) {
                    $this->getOrder($value, $sql);
                }
            } else if ($this->uploadFileLike) {
                //活动SQL语句并保存到sql数组中
                $sql = array();
                foreach ($this->uploadFileLike as $key => $value) {
                    if (!empty($value) && $key > 1) {
                        if ($action == 'down') {
                            $sql [] = 'update syo_product set product_active = 0 where product_sku like ' . '\'' . $value[0] . '\'';
                        } else if ($action == 'up') {
                            $sql [] = 'update syo_product set product_active = 1 where product_sku like ' . '\'' . $value[0] . '\'';
                        } else if ($action == 'delete') {
                            $sql [] = 'delete from syo_product where product_sku like ' . '\'' . $value[0] . '\'';
                        }
                    }
                }
                //同步更新到每个站点
                foreach ($this->site as $key => $value) {
                    $this->getOrder($value, $sql, TRUE);
                }
            } else if ($this->inputSql) {
                foreach ($this->site as $key => $value) {
                    $this->getOrder($value, $this->inputSql);
                }
            }
        }
        if ($this->message) {
            Yii::app()->user->setFlash('info', $this->message);
        }
    }

}
