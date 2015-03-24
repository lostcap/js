<?php
$this->breadcrumbs=array(
	'Content Detials'=>array('index'),
	$model->detial_id,
);

$this->menu=array(
	array('label'=>'List ContentDetial','url'=>array('index')),
	array('label'=>'Create ContentDetial','url'=>array('create')),
	array('label'=>'Update ContentDetial','url'=>array('update','id'=>$model->detial_id)),
	array('label'=>'Delete ContentDetial','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->detial_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ContentDetial','url'=>array('admin')),
);
?>

<h1>View ContentDetial #<?php echo $model->detial_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'detial_id',
		'content_id',
		'content_detial_text',
		'content_detial_is_pagination',
		'content_detial_is_allow_comment',
	),
)); ?>
