<?php
$this->breadcrumbs=array(
	'Attachments'=>array('index'),
	$model->attachment_id=>array('view','id'=>$model->attachment_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Attachment','url'=>array('index')),
	array('label'=>'Create Attachment','url'=>array('create')),
	array('label'=>'View Attachment','url'=>array('view','id'=>$model->attachment_id)),
	array('label'=>'Manage Attachment','url'=>array('admin')),
);
?>

<h1>Update Attachment <?php echo $model->attachment_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>