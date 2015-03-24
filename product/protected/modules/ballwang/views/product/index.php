<?php
$this->breadcrumbs=array(
	'Products',
);

?> 
<h1>Products</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
