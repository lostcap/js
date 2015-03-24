<?php
$this->breadcrumbs=array(
	'Content Logs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ContentLog','url'=>array('index')),
	array('label'=>'Manage ContentLog','url'=>array('admin')),
);
?>

<h1>Create ContentLog</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>