<?php
$this->breadcrumbs=array(
	'Employees',
);

?> 
<h1>Employees</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
