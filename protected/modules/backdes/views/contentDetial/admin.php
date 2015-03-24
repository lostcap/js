<?php
$this->breadcrumbs=array(
	'Content Detials'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ContentDetial','url'=>array('index')),
	array('label'=>'Create ContentDetial','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('content-detial-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Content Detials</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'content-detial-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'detial_id',
		'content_id',
		'content_detial_text',
		'content_detial_is_pagination',
		'content_detial_is_allow_comment',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
