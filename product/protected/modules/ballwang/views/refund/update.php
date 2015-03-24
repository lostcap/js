<?php
$this->breadcrumbs=array(
	'Refunds'=>array('index'),
	$model->refund_id=>array('view','id'=>$model->refund_id),
	'Update',
);

?> 
<h2>更新 Refund <?php echo $model->refund_id; ?></h2>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>