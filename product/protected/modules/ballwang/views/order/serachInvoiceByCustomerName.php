<?php
$this->breadcrumbs = array(
    'Orders' => array('index'),
    '订单查找',
);
?>

<h2>订单查找</h2>


<?php
$form = $this->beginWidget('CActiveForm', array(
            'id' => 'product_form',
            'htmlOptions' => array('class' => 'well'),
        ));
?>

<p>
    输入你想要查找的客户姓名，我们将列出这个客户所下的订单 。
</p>
<br>
<tr>
    <td class="label">客户姓名：<span class="required">*</span></td>
    <td class="value"><?php echo CHtml::textField('email', $email, array('style' => 'margin-bottom: 0px;')); ?></td>
    <td class="scope-label"><span class="nobr"></span></td>
    <td><small></small></td>
</tr>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'ok white', 'label' => '查找订单')); ?>

<?php $this->endWidget(); ?>

<?php
if ($email) {
    $this->widget('bootstrap.widgets.BootGridView', array(
        'id' => 'order-grid',
        'dataProvider' => $model->orderSearchByCustomerName($email),
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
                'filter' => Lookup::items("payment_status"),
                'htmlOptions' => array(
                    'style' => 'width: 150px;',
                ),
            ),
            array(
                'header' => '客户邮箱',
                'name' => 'customer_id',
                'type' => 'raw',
                'value' => '$data->customer->customer_email',
                'htmlOptions' => array(
                    'style' => 'width: 150px;color:#090;',
                ),
            ),
            array(
                'header' => '邮箱',
                'name' => 'order_grandtotal',
                'type' => 'raw',
                'value' => '$data->order_grandtotal',
//            'htmlOptions'=>array(
//                'style'=>'width: 150px;color:#090;',
//            ),
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
} else {
    
}
?>


