<?php
$this->breadcrumbs=array(
	'Statistics',
);

$this->menu=array(
	array('label'=>'Create Statistics','url'=>array('create')),
	array('label'=>'Manage Statistics','url'=>array('admin')),
);
?>

<h1>Statistics</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
