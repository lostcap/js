<?php
$this->breadcrumbs=array(
	'Member Groups',
);

$this->menu=array(
	array('label'=>'Create MemberGroup','url'=>array('create')),
	array('label'=>'Manage MemberGroup','url'=>array('admin')),
);
?>

<h1>Member Groups</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
