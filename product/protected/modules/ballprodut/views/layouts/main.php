<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>
        <div class="container" id="page">
            <div id="header">
                <div id="logo"> </div>
            </div><!-- header -->
            <div id="mainmenu">
                <?php
                $this->widget('bootstrap.widgets.TbNavbar', array(
                    'fixed' => false,
                    'brand' => '管理中心',
                    'brandUrl' => '/ballwang/default/order',
                    'collapse' => true, // requires bootstrap-responsive.css
                    'items' => array(
                        array(
                            'class' => 'bootstrap.widgets.BootMenu',
                            'items' => array(
                                array('label' => '订单管理', 'url' => '#', 'items' => array(
                                        array('label' => '订单常用管理'),
                                        array('label' => '查看全部订单', 'icon' => 'time', 'url' => array('order/admin')),
                                        array('label' => '未发货订单', 'icon' => 'icon-align-center', 'url' => array('order/noShippedAdmin')),
                                        array('label' => '按订单号查找', 'icon' => 'icon-th-list', 'url' => array('order/orderSerach')),
                                        array('label' => '按客户查找', 'icon' => 'icon-barcode', 'url' => array('order/OrderSerachByCustomer')),
                                        //        array('label' => '订单及时操作'),
                                        array('label' => '按条件导出订单', 'icon' => 'eye-open', 'url' => array('order/OutPutOrder')),
                                    //       array('label' => '订单状态修改'),
                                    //   array('label' => '待付款订单', 'icon' => 'icon-print', 'url' => array('order/WaitingPayment')),
                                    ), 'active' => true, 'visible' => Yii::app()->user->checkAccess('shippingAction')),
                                array('label'=>'站点管理','url'=>'#','items'=>array(
                                    array('label'=>'站点总览'),
                                    array('label'=>'站点现状','icon'=>'icon-time', 'url' => array('order/domain')),
                                )),
                                array('label' => '发货管理', 'url' => '#', 'items' => array(
                                        array('label' => '发货前操作'),
                                        array('label' => '已订货订单', 'icon' => 'icon-envelope', 'url' => array('order/ShowOutputOrder')),
                                        array('label' => '发货导出', 'icon' => 'icon-plus-sign', 'url' => array('order/productShippingShow')),
                                        array('label' => '滞留订单', 'icon' => 'icon-adjust', 'url' => array('order/noShippedProduct')),
                                        array('label' => '货运号导入', 'icon' => 'tag', 'url' => array('order/shippingImport')),
                                        array('label' => '发货邮件查看', 'icon' => 'icon-zoom-in', 'url' => array('order/ShowEmail')),
                                        array('label' => '邮件强制推送', 'icon' => 'icon-envelope', 'url' => array('order/SendEmail')),
                                        array('label' => '订单报表导出', 'icon' => 'icon-list-alt', 'url' => array('order/OutputReportForm')),

                                    //  array('label' => 'One more separated link', 'url' => '#'),
                                    ), 'visible' => Yii::app()->user->checkAccess('shippingAction')),
                                array('label' => '产品管理', 'url' => '#', 'items' => array(
                                        array('label' => '产品常规操作'),
                                        array('label' => '批量下价', 'icon' => 'icon-ban-circle', 'url' => array('product/downall')),
                                        array('label' => '批量开启', 'icon' => 'icon-envelope', 'url' => array('product/upall')),
                                        array('label' => '批量删除', 'icon' => 'icon-remove-circle', 'url' => array('product/deleteall')),
                                    //  '---',
                                    //  array('label' => '其它操作'),
                                    //  array('label' => '产品上架', 'icon' => 'icon-star-empty', 'url' => '/ballwang/order/OrderSerachByCustomer'),
                                    //  array('label' => 'One more separated link', 'url' => '#'),
                                    ), 'visible' => Yii::app()->user->checkAccess('engineerAction')),
                                array('label' => '同步管理', 'url' => '#', 'items' => array(
                                        array('label' => '同步手动操作'),
                                    //  array('label' => '订单同步', 'icon' => 'icon-th', 'url' => '/ballwang/order/synSite'),
                                        array('label' => '特定站点同步', 'icon' => 'icon-zoom-in', 'url' => array('order/synSite'), 'visible' => Yii::app()->user->checkAccess('engineerAction')),
                                        array('label' => '所有站点同步', 'icon' => 'refresh', 'url' => array('order/SynOrder'), 'visible' => Yii::app()->user->checkAccess('engineerAction')),
                                        array('label' => '同步各个站点', 'icon' => 'icon-upload', 'url' => array('order/SynSiteBack'), 'visible' => Yii::app()->user->checkAccess('engineerAction')),
                                    //    '---',
                                    //   
                                    //  array('label' => '其它操作'),
                                    //  array('label' => '产品上架', 'icon' => 'icon-star-empty', 'url' => '/ballwang/order/OrderSerachByCustomer'),
                                    //  array('label' => 'One more separated link', 'url' => '#'),
                                    ), 'visible' => Yii::app()->user->checkAccess('engineerAction')),
                                array('label' => '客服管理', 'url' => '#', 'items' => array(
                                        array('label' => '常规操作'),
                                        //  array('label' => '订单同步', 'icon' => 'icon-th', 'url' => '/ballwang/order/synSite'),
                                        array('label' => '未发货订单', 'icon' => 'icon-align-center', 'url' => array('order/noShippedAdmin')),
                                        array('label' => '按订单号查找', 'icon' => 'icon-th-list', 'url' => array('order/orderSerach')),
                                        array('label' => '按客户邮箱查找', 'icon' => 'icon-barcode', 'url' => array('order/OrderSerachByCustomer')),
                                        array('label' => '按客户姓名查找', 'icon' => 'icon-zoom-in', 'url' => array('order/OrderSerachByCustomerName')),
                                        array('label' => '待付款订单', 'icon' => 'icon-print', 'url' => array('order/WaitingPayment')),
                                        array('label' => '退款订单导入', 'icon' => 'icon-ok-sign', 'url' => array('refund/doRefund')),
                                    //    '---',
                                    //   
                                    //     array('label' => '其它操作'),
                                    //    array('label' => '产品上架', 'icon' => 'icon-star-empty', 'url' => '/ballwang/order/OrderSerachByCustomer'),
                                    // array('label' => 'One more separated link', 'url' => '#'),
                                ), 'visible' => Yii::app()->user->checkAccess('chatAction')),
                                array('label' => '图形量化', 'url' => '#', 'items' => array(
                                        //  array('label' => '订单同步', 'icon' => 'icon-th', 'url' => '/ballwang/order/synSite'),
                                        array('label' => '订单总额统计', 'icon' => 'icon-camera', 'url' => array('chart/TotalSale')),
                                        array('label' => '退款订单统计', 'icon' => 'icon-th-list', 'url' => array('refund/ChartRefund')),
                                        //    '---',
                                        //   
                                        array('label' => '其它操作'),
                                        array('label' => '统计数据静态化', 'icon' => 'icon-star-empty', 'url' => array('statistic/DoStatistic')),
                                        array('label' => 'One more separated link', 'url' => '#'),
                                ), 'visible' => Yii::app()->user->checkAccess('personInChargeAction')),
                                array('label' => '工具', 'url' => '#', 'items' => array(
                                        //  array('label' => '订单同步', 'icon' => 'icon-th', 'url' => '/ballwang/order/synSite'),
                                        array('label' => '客户邮箱导出', 'icon' => 'icon-film', 'url' => array('tool/OutPutCustmerEmail')),
                                    array('label' => 'EDM', 'icon' => 'icon-film', 'url' => array('tool/EDM')),
                                    //    '---',
                                    //    
                                    //    array('label' => '其它操作'),
                                    //    array('label' => '产品上架', 'icon' => 'icon-star-empty', 'url' => '/ballwang/order/OrderSerachByCustomer'),
                                    // array('label' => 'One more separated link', 'url' => '#'),
                                    ), 'visible' => Yii::app()->user->checkAccess('engineerAction')),
                            ),
                        ),
                        array(
                            'class' => 'bootstrap.widgets.BootMenu',
                            'htmlOptions' => array('class' => 'pull-right'),
                            'items' => array(
                                array('label' => '用户中心', 'url' => '#', 'items' => array(
                                        array('label' => 'USE HEADER'),
                                        array('label' => '修改密码', 'url' => array('site/ChangePwd')),
                                        array('label' => '管理员账号管理', 'url' => array('employee/admin'), 'visible' => Yii::app()->user->checkAccess('engineerInChargeAction')),
                                        array('label' => '', 'url' => '#'),
                                        '---',
                                        array('label' => 'NAV HEADER'),
                                        array('label' => '退出(' . Yii::app()->user->name . ')', 'url' => '/site/logout'),
                                    ), 'visible' => !Yii::app()->user->isGuest),
                                array('label' => '登录', 'url' => '#', 'visible' => Yii::app()->user->isGuest),
                            ),
                        ),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.TbBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>
            <br>
                <?php Site::bootstrap($this->message); ?>
                <?php echo $content; ?>

                <div class="clear"></div>

                <div id="footer" style="clear: both;text-align: center;">
                    Copyright &copy; <?php echo date('Y'); ?> by Ballwang.<br/>
                    All Rights Reserved.<br/>
                    <?php echo Yii::powered(); ?>
                </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
