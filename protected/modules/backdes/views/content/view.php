<?php
$this->breadcrumbs=array(
	'Contents'=>array('index'),
	$model->content_id,
);

$this->menu=array(
	array('label'=>'List Content','url'=>array('index')),
	array('label'=>'Create Content','url'=>array('create')),
	array('label'=>'Update Content','url'=>array('update','id'=>$model->content_id)),
	array('label'=>'Delete Content','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->content_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Content','url'=>array('admin')),
);
?>

<h1>View Content #<?php echo $model->content_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'content_id',
		'catgory_id',
		'content_title',
		'content_keywords',
		'content_description',
		'content_thumb',
		'content_url',
		'content_order',
		'content_status',
		'content_username',
		'content_edit_name',
		'content_from_name',
		'inputtime',
		'updatetime',
	),
)); ?>
