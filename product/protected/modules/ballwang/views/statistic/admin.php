<?php
$this->breadcrumbs=array(
	'Statistics'=>array('index'),
	'Manage',
);

 

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('statistic-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>管理 Statistics 项目</h2>

<p>
你可以使用 (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) 对有关项目进行搜索。
</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'statistic-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'statistic_id',
		'statistic_time_year',
		'statistic_time_month',
		'statistic_timie_day',
		'statistic_time',
		'statistic_category',
		/*
		'statistic_currency',
		'statistic_account',
		'statistic_success_order',
		'statistic_register_customer',
		'statistic_order_customer',
		'statistic_order_site_num',
		'statistic_order_paymethod',
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
