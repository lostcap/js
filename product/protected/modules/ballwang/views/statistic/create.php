<?php
$this->breadcrumbs=array(
	'Statistics'=>array('index'),
	'Create',
);

?> 

<h2>创建 Statistic 项目</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>