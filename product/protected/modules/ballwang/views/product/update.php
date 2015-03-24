<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->product_id=>array('view','id'=>$model->product_id),
	'Update',
);

?> 
<h2>更新 Product <?php echo $model->product_id; ?></h2>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>