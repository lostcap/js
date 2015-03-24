<?php
$this->breadcrumbs=array(
	'Refunds'=>array('index'),
	'Create',
);

?> 

<h2>创建 Refund 项目</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>