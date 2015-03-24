<?php
$this->breadcrumbs=array(
	'Category Privileges'=>array('index'),
	$model->privilege_id,
);

$this->menu=array(
	array('label'=>'List CategoryPrivilege','url'=>array('index')),
	array('label'=>'Create CategoryPrivilege','url'=>array('create')),
	array('label'=>'Update CategoryPrivilege','url'=>array('update','id'=>$model->privilege_id)),
	array('label'=>'Delete CategoryPrivilege','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->privilege_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CategoryPrivilege','url'=>array('admin')),
);
?>

<h1>View CategoryPrivilege #<?php echo $model->privilege_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'category_id',
		'privilege_id',
		'admin_roleid',
		'privilege_is_admin',
	),
)); ?>
