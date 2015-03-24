<?php
$this->breadcrumbs=array(
	'Refunds'=>array('index'),
	$model->refund_id,
);
?>
 

<h2>查看 Refund <?php echo $model->refund_id; ?></h2>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'refund_id',
		'refund_order_num',
		'refund_currency',
		'refund_account',
		'refund_account_cny',
		'refund_paymethod',
		'refund_site',
		'refund_category',
		'refund_country',
		'refund_order_time',
		'refund_time',
	),
)); ?>
