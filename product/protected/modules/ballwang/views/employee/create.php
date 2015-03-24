<?php
$this->breadcrumbs=array(
	'Employees'=>array('index'),
	'Create',
);

?> 

<h2>创建 Employee 项目</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>