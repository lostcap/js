<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->product_id,
);
?>
 

<h2>查看 Product <?php echo $model->product_id; ?></h2>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'product_id',
		'product_name',
		'product_name_alias',
		'product_sku',
		'product_url',
		'product_weight',
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
	),
)); ?>
