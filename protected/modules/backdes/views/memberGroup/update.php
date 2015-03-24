<?php
$this->breadcrumbs=array(
	'Member Groups'=>array('index'),
	$model->member_group_id=>array('view','id'=>$model->member_group_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MemberGroup','url'=>array('index')),
	array('label'=>'Create MemberGroup','url'=>array('create')),
	array('label'=>'View MemberGroup','url'=>array('view','id'=>$model->member_group_id)),
	array('label'=>'Manage MemberGroup','url'=>array('admin')),
);
?>

<h1>Update MemberGroup <?php echo $model->member_group_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>