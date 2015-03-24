<?php
$this->breadcrumbs = array(
    'Orders' => array('index'),
    'Manage',
);

?>

<h2>待处理邮件列队</h2>

<?php
$this->widget('bootstrap.widgets.BootButton', array(
    'label' => '邮件列队规则说明',
    'url' => '#myModal',
    'type' => 'primary',
    'size' => 'mini',
    'htmlOptions' => array('data-toggle' => 'modal', 'style' => 'float:right; '),
));
?>
    <h5>
        邮件服务器状态检查
    </h5>
<p>
    邮件总数限制(<span style="color: #006400;"><?php echo $emailServer['email_limit']; ?></span>),已发邮件数目(<span style="color: #006400;"><?php echo $emailServer['email_used']; ?></span>),
    可发邮件数量(<span style="color: red;"><?php echo $emailServer['email_limit']-$emailServer['email_used']; ?></span>),
    邮件服务器正常(<span style="color: #006400;"><?php echo $emailServer['email_active']; ?></span>),
    邮件服务器宕机(<span style="color: red;"><?php echo $emailServer['email_down']; ?></span>)。<br>
    当前系统服务器时间为(<span style="color: green;"><?php echo date('Y-m-d H:i:s'); ?></span>)。
</p>




<?php
$this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'order-grid',
    'dataProvider' => $model->searchEmailQueue(),
    'filter' => $model,
    'type'=>'striped',
    'columns' => array(
        array(
            'header' => '订单号',
            'name' => 'invoice_id',
            'value' => '$data->getInvoice()',
            'htmlOptions'=>array(
                'style'=>'width: 150px;color:#090;',
            ),
        ),
//		'order_site_id',

        array(
            'header' => '订单状态',
            'name' => 'order_status',
            'type' => 'raw',
            'value' => 'Lookup::item("payment_status",$data->order_status)',
            'filter' => Lookup::items("payment_status"),
            'htmlOptions'=>array(
                'style'=>'width: 150px;',
            ),
        ),

        array(
            'header' => '客户邮箱',
            'name' => 'customer_id',
            'type' => 'raw',
            'value' => '$data->customer->customer_email',
            'htmlOptions'=>array(
                'style'=>'width: 150px;color:#090;',
            ),
        ),
        array(
            'header' => '订单额',
            'name' =>  'order_grandtotal',
            'type' => 'raw',
            'value' => '$data->currency->currency_symbol.$data->order_grandtotal',
//            'htmlOptions'=>array(
//                'style'=>'width: 150px;color:#090;',
//            ),
        ),
        array(
            'header' => '货运方式',
            'name' => 'order_carrier_id',
            'type' => 'raw',
            'value' => '$data->carrier->carrier_name',
            'filter'=>FALSE,
            'htmlOptions'=>array(
                'style'=>'width: 50px;',
            ),
        ),
        array(
            'header' => '下单时间',
            'name' => 'order_create_at',
            'type' => 'raw',
            'value' => '$data->order_create_at',
            'filter'=>FALSE,
            'htmlOptions'=>array(
                'style'=>'width: 150px;',
            ),
        ),

        array(
            'header' => '操作',
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'template' => '{view} {shipping}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->controller->createUrl("order/view",array("id"=>$data->order_id))',
                    'options' => array("target" => "_blank"),
                ),
                'shipping' => array(
                    'label' => 'Shipping',
                    'imageUrl' => '/images/fam_lorry.gif',
                    'visible' => '$data->order_status==' . Order::Delived . ' OR $data->order_status==' . Order::Shipped,
                ),
            ),
        ),
    ),
));
?>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'myModal')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>订单显示提醒</h3>
</div>

<div class="modal-body">
    <p><?php
        $this->widget('bootstrap.widgets.BootLabel', array(
            'type' => 'warning', // '', 'success', 'warning', 'important', 'info' or 'inverse'
            'label' => '1.',
        ));
        ?> 邮件列队每小时处理一遍，该邮件列队只负责发送已经导入追踪号的订单。</p>
    <p><?php
        $this->widget('bootstrap.widgets.BootLabel', array(
            'type' => 'success',
            'label' => '2.',
        ));
        ?> 邮件列队中的订单系统只发送一次邮件通知客户！</p>
    <p><?php
        $this->widget('bootstrap.widgets.BootLabel', array(
            'type' => 'important',
            'label' => '3.',
        ));
        ?> 发送未成功的邮件,系统将每小时尝试发送一遍，直到发送成功为止！</p>
    <p><?php
        $this->widget('bootstrap.widgets.BootLabel', array(
            'type' => 'info',
            'label' => '4.',
        ));
        ?> 我们每天将于服务器时间凌晨刷新发送邮件数量(服务器时间与本地时间存在时差)！</p>
</div>

<div class="modal-footer">
    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'type' => 'primary',
        'label' => '确定',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    ));
    ?>
    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'label' => '关闭',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
