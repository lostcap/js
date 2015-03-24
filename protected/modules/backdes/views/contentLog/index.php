<?php
$this->breadcrumbs=array(
	'Content Logs',
);

$this->menu=array(
	array('label'=>'Create ContentLog','url'=>array('create')),
	array('label'=>'Manage ContentLog','url'=>array('admin')),
);
?>

<h1>Content Logs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
