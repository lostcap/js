<?php
$this->breadcrumbs=array(
	'Content Logs'=>array('index'),
	$model->content_log_id,
);

$this->menu=array(
	array('label'=>'List ContentLog','url'=>array('index')),
	array('label'=>'Create ContentLog','url'=>array('create')),
	array('label'=>'Update ContentLog','url'=>array('update','id'=>$model->content_log_id)),
	array('label'=>'Delete ContentLog','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->content_log_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ContentLog','url'=>array('admin')),
);
?>

<h1>View ContentLog #<?php echo $model->content_log_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'content_log_id',
		'content_log_action',
		'content_log_action_type',
		'content_log_admin_id',
		'content_log_admin_ip',
		'content_log_time',
	),
)); ?>
