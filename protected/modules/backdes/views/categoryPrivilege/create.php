<?php
$this->breadcrumbs=array(
	'Category Privileges'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CategoryPrivilege','url'=>array('index')),
	array('label'=>'Manage CategoryPrivilege','url'=>array('admin')),
);
?>

<h1>Create CategoryPrivilege</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>