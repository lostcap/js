<?php
$this->breadcrumbs=array(
	'Members'=>array('index'),
	$model->member_id,
);

$this->menu=array(
	array('label'=>'List Member','url'=>array('index')),
	array('label'=>'Create Member','url'=>array('create')),
	array('label'=>'Update Member','url'=>array('update','id'=>$model->member_id)),
	array('label'=>'Delete Member','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->member_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Member','url'=>array('admin')),
);
?>

<h1>View Member #<?php echo $model->member_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'member_id',
		'member_username',
		'member_password',
		'member_nickname',
		'member_email',
		'member_group_id',
		'member_message',
		'member_mobile',
		'member_register_date',
		'member_last_login_date',
		'member_register_ip',
		'member_last_login_ip',
		'member_login_num_rand',
		'member_is_lock',
		'member_is_delete',
	),
)); ?>
