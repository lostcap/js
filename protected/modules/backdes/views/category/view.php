<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->category_id,
);

$this->menu=array(
	array('label'=>'List Category','url'=>array('index')),
	array('label'=>'Create Category','url'=>array('create')),
	array('label'=>'Update Category','url'=>array('update','id'=>$model->category_id)),
	array('label'=>'Delete Category','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->category_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Category','url'=>array('admin')),
);
?>

<h1>View Category #<?php echo $model->category_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'category_id',
		'category_level',
		'category_parentid',
		'category_name',
		'category_description',
		'category_url',
		'category_show_order',
		'category_is_menu',
		'category_is_delete',
	),
)); ?>
