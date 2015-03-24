<?php
$this->breadcrumbs=array(
	'Content Detials'=>array('index'),
	$model->detial_id=>array('view','id'=>$model->detial_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ContentDetial','url'=>array('index')),
	array('label'=>'Create ContentDetial','url'=>array('create')),
	array('label'=>'View ContentDetial','url'=>array('view','id'=>$model->detial_id)),
	array('label'=>'Manage ContentDetial','url'=>array('admin')),
);
?>

<h1>Update ContentDetial <?php echo $model->detial_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>