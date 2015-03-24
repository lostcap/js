<?php
$this->breadcrumbs=array(
	'Category Privileges',
);

$this->menu=array(
	array('label'=>'Create CategoryPrivilege','url'=>array('create')),
	array('label'=>'Manage CategoryPrivilege','url'=>array('admin')),
);
?>

<h1>Category Privileges</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
