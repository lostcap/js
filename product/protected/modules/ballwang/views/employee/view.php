<?php
$this->breadcrumbs=array(
	'Employees'=>array('index'),
	$model->employee_ID,
);
?>
 

<h2>查看 Employee <?php echo $model->employee_ID; ?></h2>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'employee_ID',
		'employee_name',
		'employee_email',
		'employee_passwd',
		'employee_active',
	),
)); ?>
