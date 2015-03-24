<?php
$this->breadcrumbs=array(
	'Statistics'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Statistics','url'=>array('index')),
	array('label'=>'Create Statistics','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('statistics-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Statistics</h1>

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
	'id'=>'statistics-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'statistics_id',
		'statistics_category_id',
		'statistics_views',
		'statistics_ip',
		'statistics_yesterday_ip',
		'statistics_day_ip',
		/*
		'statistics_week_ip',
		'statistics_month_ip',
		'statistics_yesterday_views',
		'statistics_day_views',
		'statistics_week_views',
		'statistics_month_views',
		'statistics_update_time',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
