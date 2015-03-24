<div style="float: left;">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id' => 'horizontalForm10',
                'type' => 'inline',
                'htmlOptions' => array('class' => 'well'),
            ));
    echo '<h4>客户信息</h4>——————————————————————————<br></br>';
    echo '<div style="width: 340px;">';
    ?>
    <table cellspacing="0" class="">
        <tbody>
            <tr>
                <td ><label>客户姓名</label></td>
                <td>
                    <a href="#">
                        <strong><?php echo $model->customer->customer_name; ?></strong>
                    </a>
                </td>
            </tr>
            <tr>
                <td ><label>Email</label></td>
                <td><a href="mailto:<?php echo $model->customer->customer_email; ?>"><strong><?php echo $model->customer->customer_email; ?></strong></a></td>
            </tr>
            <tr>
                <td ><label>注册时间:</label></td>
                <td><strong><?php echo $model->customer->customer_create_at; ?></strong></td>
            </tr>
            <tr>
                <td ><label>有效订单数:</label></td>
                <td><strong><?php echo Order::getCustomerValidOrders($model->customer_id); ?></strong></td>
            </tr>
            <tr>
                <td ><label>总计金额:</label></td>
                <td><strong>$<?php echo Order::getCustomerTotalAmount($model->customer_id); ?></strong></td>
            </tr>
            <tr>
                <td ><label>客户组</label></td>
                <td><strong><?php echo $model->customer->group->group_name; ?></strong></td>
            </tr>
        </tbody>
    </table>
    <?php
    echo '</div>';
    $this->endWidget();
    ?>
</div>
<div style="float: left; width: 800px;">
    <?php
    $this->widget('bootstrap.widgets.BootGridView', array(
        'id' => 'order-grid3',
        'dataProvider' => $order,
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
                'header' => '订单总计',
                'name' => 'order_grandtotal',
                'type' => 'raw',
                'value' => '$data->currency->currency_symbol.$data->order_grandtotal',
                'filter' => FALSE,
                'htmlOptions' => array(
                    'style' => 'width: 150px;',
                ),
            ),
            array(
                'header' => '货运方式',
                'name' => 'order_carrier_id',
                'type' => 'raw',
                'value' => '$data->carrier->carrier_name',
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
</div>


