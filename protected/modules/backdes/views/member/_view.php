<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->member_id),array('view','id'=>$data->member_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_username')); ?>:</b>
	<?php echo CHtml::encode($data->member_username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_password')); ?>:</b>
	<?php echo CHtml::encode($data->member_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_nickname')); ?>:</b>
	<?php echo CHtml::encode($data->member_nickname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_email')); ?>:</b>
	<?php echo CHtml::encode($data->member_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_group_id')); ?>:</b>
	<?php echo CHtml::encode($data->member_group_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_message')); ?>:</b>
	<?php echo CHtml::encode($data->member_message); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('member_mobile')); ?>:</b>
	<?php echo CHtml::encode($data->member_mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_register_date')); ?>:</b>
	<?php echo CHtml::encode($data->member_register_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_last_login_date')); ?>:</b>
	<?php echo CHtml::encode($data->member_last_login_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_register_ip')); ?>:</b>
	<?php echo CHtml::encode($data->member_register_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_last_login_ip')); ?>:</b>
	<?php echo CHtml::encode($data->member_last_login_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_login_num_rand')); ?>:</b>
	<?php echo CHtml::encode($data->member_login_num_rand); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_is_lock')); ?>:</b>
	<?php echo CHtml::encode($data->member_is_lock); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_is_delete')); ?>:</b>
	<?php echo CHtml::encode($data->member_is_delete); ?>
	<br />

	*/ ?>

</div>