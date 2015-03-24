<?php
$this->breadcrumbs=array(
	'Member Groups'=>array('index'),
	$model->member_group_id,
);

$this->menu=array(
	array('label'=>'List MemberGroup','url'=>array('index')),
	array('label'=>'Create MemberGroup','url'=>array('create')),
	array('label'=>'Update MemberGroup','url'=>array('update','id'=>$model->member_group_id)),
	array('label'=>'Delete MemberGroup','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->member_group_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MemberGroup','url'=>array('admin')),
);
?>

<h1>View MemberGroup #<?php echo $model->member_group_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'member_group_id',
		'member_group_name',
		'member_group_allow_message',
		'member_group_allow_visit',
		'member_group_allow_post',
		'member_group_allow_postverify',
		'member_group_allow_send_message',
		'member_group_allow_post_num',
		'member_group_description',
		'member_group_sort',
		'member_group_is_delete',
	),
)); ?>
