<?php
$this->breadcrumbs=array(
	'Content Detials',
);

$this->menu=array(
	array('label'=>'Create ContentDetial','url'=>array('create')),
	array('label'=>'Manage ContentDetial','url'=>array('admin')),
);
?>

<h1>Content Detials</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
