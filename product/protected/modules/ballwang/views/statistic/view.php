<?php
$this->breadcrumbs=array(
	'Statistics'=>array('index'),
	$model->statistic_id,
);
?>
 

<h2>查看 Statistic <?php echo $model->statistic_id; ?></h2>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'statistic_id',
		'statistic_time_year',
		'statistic_time_month',
		'statistic_timie_day',
		'statistic_time',
		'statistic_category',
		'statistic_currency',
		'statistic_account',
		'statistic_success_order',
		'statistic_register_customer',
		'statistic_order_customer',
		'statistic_order_site_num',
		'statistic_order_paymethod',
	),
)); ?>
