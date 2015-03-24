<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Manage',
);

 

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>管理 Products 项目</h2>

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
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'product_id',
		'product_name',
		'product_name_alias',
		'product_sku',
		'product_url',
		'product_weight',
		/*
		'product_base_price',
		'product_orig_price',
		'product_special_price',
		'product_stock_qty',
		'product_stock_cart_min',
		'product_stock_cart_max',
		'product_stock_status',
		'product_status',
		'product_active',
		'product_short_description',
		'product_description',
		'product_seo_id',
		'product_category_id',
		'product_promotion',
		'product_wholesale',
		'product_feature',
		'product_freeshiping',
		'product_accessory',
		'product_together',
		'product_create_at',
		'product_last_update',
		'product_new_arrivals',
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
