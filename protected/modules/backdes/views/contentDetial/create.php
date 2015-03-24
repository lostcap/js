<?php
$this->breadcrumbs=array(
	'Content Detials'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ContentDetial','url'=>array('index')),
	array('label'=>'Manage ContentDetial','url'=>array('admin')),
);
?>

<h1>Create ContentDetial</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>