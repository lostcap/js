<?php
$this->breadcrumbs=array(
	'Member Groups'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MemberGroup','url'=>array('index')),
	array('label'=>'Create MemberGroup','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('member-group-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Member Groups</h1>

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
	'id'=>'member-group-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'member_group_id',
		'member_group_name',
		'member_group_allow_message',
		'member_group_allow_visit',
		'member_group_allow_post',
		'member_group_allow_postverify',
		/*
		'member_group_allow_send_message',
		'member_group_allow_post_num',
		'member_group_description',
		'member_group_sort',
		'member_group_is_delete',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
