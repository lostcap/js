<?php
$this->breadcrumbs=array(
	'Statistics',
);

?> 
<h1>Statistics</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
