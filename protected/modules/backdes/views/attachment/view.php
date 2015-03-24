<?php
$this->breadcrumbs=array(
	'Attachments'=>array('index'),
	$model->attachment_id,
);

$this->menu=array(
	array('label'=>'List Attachment','url'=>array('index')),
	array('label'=>'Create Attachment','url'=>array('create')),
	array('label'=>'Update Attachment','url'=>array('update','id'=>$model->attachment_id)),
	array('label'=>'Delete Attachment','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->attachment_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Attachment','url'=>array('admin')),
);
?>

<h1>View Attachment #<?php echo $model->attachment_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'attachment_id',
		'attachment_catid',
		'attachment_filename',
		'attachment_filepath',
		'attachment_is_image',
		'attachment_is_thumb',
		'attachment_userid',
		'attachment_uploadtime',
		'attachment_uploadip',
		'attachment_status',
	),
)); ?>
