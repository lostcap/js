<?php
$this->breadcrumbs=array(
	'Category Privileges'=>array('index'),
	$model->privilege_id=>array('view','id'=>$model->privilege_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CategoryPrivilege','url'=>array('index')),
	array('label'=>'Create CategoryPrivilege','url'=>array('create')),
	array('label'=>'View CategoryPrivilege','url'=>array('view','id'=>$model->privilege_id)),
	array('label'=>'Manage CategoryPrivilege','url'=>array('admin')),
);
?>

<h1>Update CategoryPrivilege <?php echo $model->privilege_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>