<?php
$this->breadcrumbs = array(
    'Sites' => array('index'),
    '批量导入退款订单',
);
?>
<br>
<h2>退款订单批量导入</h2>
<br>
<p>
    批量导入退款订单，如果您是第一次操作请下载导入格式 【<a href="/download/refund.xls">格式下载</a>】
</p>

<?php 
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well','enctype' => 'multipart/form-data'),
)); ?>
 <tr>
    <td class="label">选择要上传的文件<span class="required">*</span></td>
    <td class="value"><?php echo CHtml::fileField('uploadFile','',array('style'=>'margin-bottom: 0px;')); ?></td>
    <td class="scope-label"><span class="nobr"></span></td>
    <td><small></small></td>
</tr>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Submit')); ?>

<?php $this->endWidget(); ?>

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
            'filter' => array('1' => '全部退款', '2' => '部分退款'),
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
            'header' => '处理时间',
            'name' => 'refund_time',
            'type' => 'raw',
            'value' => '$data->refund_time',
            'filter' => FALSE,
            'htmlOptions' => array(
                'style' => 'width: 120px;',
            ),
        ),
        array(
            'header' => '操作',
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'template' => '{view}{delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->controller->createUrl("order/view",array("id"=>$data->refund_order_id))',
                    'options' => array("target" => "_blank"),
                ),
                'delete' => array(
                    'url' => 'Yii::app()->controller->createUrl("refund/delete",array("id"=>$data->refund_id))',
                    'options' => array("target" => "_blank"),
                ),
                 
            ),
        ),
    ),
));
?>

