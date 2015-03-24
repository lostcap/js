<?php
$this->breadcrumbs=array(
	'Member Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MemberGroup','url'=>array('index')),
	array('label'=>'Manage MemberGroup','url'=>array('admin')),
);
?>

<h1>Create MemberGroup</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>