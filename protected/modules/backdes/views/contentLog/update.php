<?php
$this->breadcrumbs=array(
	'Content Logs'=>array('index'),
	$model->content_log_id=>array('view','id'=>$model->content_log_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ContentLog','url'=>array('index')),
	array('label'=>'Create ContentLog','url'=>array('create')),
	array('label'=>'View ContentLog','url'=>array('view','id'=>$model->content_log_id)),
	array('label'=>'Manage ContentLog','url'=>array('admin')),
);
?>

<h1>Update ContentLog <?php echo $model->content_log_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>