<?php
$this->breadcrumbs = array(
    'Orders' => array('index'),
    'Manage',
);
?>

<h2>滞留订单</h2>

<p>
    滞留订单列出退单率比较大的所有订单，主要通过长时间未发货，货物退单历史，顾客退单历史等来判断。所有未在<span style="color: red;">4天</span>内发货的订单都将列在滞留订单中。
</p>



<?php
$this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'order-grid',
    'dataProvider' => $model->noShippedSearch(),
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
            'header' => '订单额',
            'name' => 'order_grandtotal',
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
?>
