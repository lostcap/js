<?php
$this->breadcrumbs=array(
	'Statistics'=>array('index'),
	$model->statistics_id,
);

$this->menu=array(
	array('label'=>'List Statistics','url'=>array('index')),
	array('label'=>'Create Statistics','url'=>array('create')),
	array('label'=>'Update Statistics','url'=>array('update','id'=>$model->statistics_id)),
	array('label'=>'Delete Statistics','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->statistics_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Statistics','url'=>array('admin')),
);
?>

<h1>View Statistics #<?php echo $model->statistics_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'statistics_id',
		'statistics_category_id',
		'statistics_views',
		'statistics_ip',
		'statistics_yesterday_ip',
		'statistics_day_ip',
		'statistics_week_ip',
		'statistics_month_ip',
		'statistics_yesterday_views',
		'statistics_day_views',
		'statistics_week_views',
		'statistics_month_views',
		'statistics_update_time',
	),
)); ?>
