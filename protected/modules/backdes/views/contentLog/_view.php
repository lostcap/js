<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_log_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->content_log_id),array('view','id'=>$data->content_log_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_log_action')); ?>:</b>
	<?php echo CHtml::encode($data->content_log_action); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_log_action_type')); ?>:</b>
	<?php echo CHtml::encode($data->content_log_action_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_log_admin_id')); ?>:</b>
	<?php echo CHtml::encode($data->content_log_admin_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_log_admin_ip')); ?>:</b>
	<?php echo CHtml::encode($data->content_log_admin_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_log_time')); ?>:</b>
	<?php echo CHtml::encode($data->content_log_time); ?>
	<br />


</div>