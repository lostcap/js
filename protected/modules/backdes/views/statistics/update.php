<?php
$this->breadcrumbs=array(
	'Statistics'=>array('index'),
	$model->statistics_id=>array('view','id'=>$model->statistics_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Statistics','url'=>array('index')),
	array('label'=>'Create Statistics','url'=>array('create')),
	array('label'=>'View Statistics','url'=>array('view','id'=>$model->statistics_id)),
	array('label'=>'Manage Statistics','url'=>array('admin')),
);
?>

<h1>Update Statistics <?php echo $model->statistics_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>