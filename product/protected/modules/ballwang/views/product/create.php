<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Create',
);

?> 

<h2>创建 Product 项目</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>