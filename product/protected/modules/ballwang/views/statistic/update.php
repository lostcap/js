<?php
$this->breadcrumbs=array(
	'Statistics'=>array('index'),
	$model->statistic_id=>array('view','id'=>$model->statistic_id),
	'Update',
);

?> 
<h2>更新 Statistic <?php echo $model->statistic_id; ?></h2>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>