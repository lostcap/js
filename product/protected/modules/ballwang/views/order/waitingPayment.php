<?php
$this->breadcrumbs = array(
    'Orders' => array('index'),
    'Manage',
);
?>

<h2>WaitingPayment</h2>

<p>
    你可以使用 (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) 对有关项目进行搜索。
</p>


<?php
$this->widget('bootstrap.widgets.BootButton', array(
    'label' => '待付款单处理',
    'url' => '#myModal',
    'type' => 'primary',
    'htmlOptions' => array('data-toggle' => 'modal', 'style' => 'float:right;margin-right: 10px;'),
));
?>
<?php
//$this->widget('bootstrap.widgets.BootButton', array(
//    'label' => '损坏订单导出',
//    'url' =>$this->module->ballWang . '/order/OutPutBreakDownWaitingPayment',
//    'type' => 'primary',
//    'htmlOptions' => array('data-toggle' => 'modal', 'style' => 'float:right;margin-right: 10px;'),
//));
?>
<?php
$this->widget('bootstrap.widgets.BootButton', array(
    'label' => '订单导出',
    'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size' => 'Normal', // '', 'large', 'small' or 'mini'
    'url' => $this->module->ballWang . '/order/OutPutWaitingPayment',
    'htmlOptions' => array(
        'style' => 'float:right;margin-right: 10px;',
    ),
));
?>
<br>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'myModal')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>待付款订单处理</h3>
</div>

<div class="modal-body">
    <p>该项你需要按照处理的格式导入需要忽略的订单。<a href="/download/orderOut.xls">格式下载</a></p>
    <p>
        <?php
        $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                    'id' => 'horizontalForm',
                    'type' => 'horizontal',
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                ));
        ?>
    <tr>
        <td class="label">选择要上传的文件<span class="required">*</span></td>
        <td class="value"><?php echo CHtml::fileField('uploadFile', '', array('style' => 'margin-bottom: 0px;')); ?></td>
        <td class="scope-label"><span class="nobr"></span></td>
        <td><small></small></td>
    </tr>
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'ok white', 'label' => '上传处理')); ?>
    <?php
    $this->endWidget();
    ?>
</p>
</div>

<div class="modal-footer">
    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'label' => 'Close',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    ));
    ?>
</div>

<?php $this->endWidget(); ?>


<?php
$this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'order-grid',
    'dataProvider' => $model->waitingSearch(),
    'filter' => $model,
    'type' => 'striped',
    'columns' => array(
        array(
            'header' => '订单号',
            'name' => 'invoice_id',
            'value' => '$data->getInvoice()',
            'htmlOptions' => array(
                'style' => 'width: 150px;color:#090;',
            ),
        ),
//		'order_site_id',

        array(
            'header' => '订单状态',
            'name' => 'order_status',
            'type' => 'raw',
            'value' => 'Lookup::item("payment_status",$data->order_status)',
            'filter' => FALSE,
            'htmlOptions' => array(
                'style' => 'width: 150px;',
            ),
        ),
        array(
            'header' => '客户邮箱',
            'name' => 'customer_id',
            'type' => 'raw',
            'value' => '$data->customer->customer_email',
            'filter' => FALSE,
            'htmlOptions' => array(
                'style' => 'width: 150px;color:#090;',
            ),
        ),
		array(
                'header' => '网站地址',
                'name' => 'order_site_id',
                'type' => 'raw',
                'value' => '$data->site->domain_name',
                'htmlOptions' => array(
                    'style' => 'width: 150px;color:#090;',
                ),
            ),
        array(
            'header' => '订单额',
            'name' => 'order_grandtotal',
            'type' => 'raw',
            'value' => '$data->currency->currency_symbol.$data->order_grandtotal',
//            'htmlOptions'=>array(
//                'style'=>'width: 150px;color:#090;',
//            ),
        ),
        array(
            'header' => '支付方式',
            'name' => 'order_payment_id',
            'type' => 'raw',
            'value' => '$data->payment->payment_name',
            'filter' => FALSE,
            'htmlOptions' => array(
                'style' => 'width: 50px;',
            ),
        ),
        array(
            'header' => '货运方式',
            'name' => 'order_carrier_id',
            'type' => 'raw',
            'value' => '$data->carrier->carrier_name',
            'filter' => FALSE,
            'htmlOptions' => array(
                'style' => 'width: 50px;',
            ),
        ),
        array(
            'header' => '下单时间',
            'name' => 'order_create_at',
            'type' => 'raw',
            'value' => '$data->order_create_at',
            'filter' => FALSE,
            'htmlOptions' => array(
                'style' => 'width: 150px;',
            ),
        ),
        array(
            'header' => '操作',
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'template' => '{view} {shipping}{delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->controller->createUrl("order/view",array("id"=>$data->order_id))',
                    'options' => array("target" => "_blank"),
                ),
                'delete' => array(
                    'visible' => 'Yii::app()->user->checkAccess(\'chat\')',
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
