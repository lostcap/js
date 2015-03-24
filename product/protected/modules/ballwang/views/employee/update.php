<?php
$this->breadcrumbs=array(
	'Employees'=>array('index'),
	$model->employee_ID=>array('view','id'=>$model->employee_ID),
	'Update',
);

?> 
<h2>更新 Employee <?php echo $model->employee_ID; ?></h2>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>