<p class="well">
    退单总额：<span style="color: green;">￥ <?php echo $data['data']['refundTimeTotalCount']; ?></span>
    <span style="margin-left: 60px;">总退单数量：<span style="color: green;"><?php echo $data['data']['refundTimeOrderTotalNum']; ?></span> 个</span>
</p>
<?php
$this->renderPartial('/widget/_lineChartTwoContent', array('model' => $data, 'dateCategory' => $timeCategory));
?>

<?php
$data['stepChartName']='每条线退单统计';
$this->renderPartial('/widget/_lineChartManyContent', array('model' => $data, 'dateCategory' => $timeCategory));
?>

<?php
$this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'order-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'type' => 'striped',
    'columns' => array(
        array(
            'header' => '订单号',
            'name' => 'refund_order_num',
            'value' => '$data->getInvoice()',
            'htmlOptions' => array(
                'style' => 'width: 150px;color:#090;',
            ),
        ),
        array(
            'header' => '支付方式',
            'name' => 'refund_paymethod',
            'value' => '$data->payment->payment_name',
            'filter' => FALSE,
            'htmlOptions' => array(
                'style' => 'width: 60px;',
            ),
        ),
        array(
            'header' => '退款金额',
            'name' => 'refund_account',
            'type' => 'raw',
            'value' => '$data->currency->currency_symbol.$data->refund_account',
            'filter' => FALSE,
            'htmlOptions' => array(
                'style' => 'width: 60px;color:#090;',
            ),
        ),
        array(
            'header' => '退款状态',
            'name' => 'refund_status',
            'type' => 'raw',
            'filter' => array('1' => '全部退款', '0' => '部分退款'),
            'value' => '$data->refund_status==1 ? "全部退款":"部分退款"',
//            'htmlOptions'=>array(
//                'style'=>'width: 150px;color:#090;',
//            ),
        ),
        array(
            'header' => '退款国家',
            'name' => 'refund_country',
            'type' => 'raw',
            'filter' => FALSE,
            'value' => '$data->country->name',
//            'htmlOptions'=>array(
//                'style'=>'width: 150px;color:#090;',
//            ),
        ),
        array(
            'header' => '退款网站',
            'name' => 'refund_site',
            'type' => 'raw',
            'filter' => FALSE,
            'value' => '$data->site->domain_name',
//            'htmlOptions'=>array(
//                'style'=>'width: 150px;color:#090;',
//            ),
        ),
        array(
            'header' => '下单时间',
            'name' => 'refund_order_time',
            'type' => 'raw',
            'value' => '$data->refund_order_time',
            'filter' => FALSE,
            'htmlOptions' => array(
                'style' => 'width: 120px;',
            ),
        ),
        array(
            'header' => '详情',
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'template' => '{view}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->controller->createUrl("order/view",array("id"=>$data->refund_order_id))',
                    'options' => array("target" => "_blank"),
                ),
            ),
        ),
    ),
));
?>
