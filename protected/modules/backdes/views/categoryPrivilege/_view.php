<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('privilege_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->privilege_id),array('view','id'=>$data->privilege_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::encode($data->category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_roleid')); ?>:</b>
	<?php echo CHtml::encode($data->admin_roleid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('privilege_is_admin')); ?>:</b>
	<?php echo CHtml::encode($data->privilege_is_admin); ?>
	<br />


</div>