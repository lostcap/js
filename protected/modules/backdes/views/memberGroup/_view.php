<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_group_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->member_group_id),array('view','id'=>$data->member_group_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_group_name')); ?>:</b>
	<?php echo CHtml::encode($data->member_group_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_group_allow_message')); ?>:</b>
	<?php echo CHtml::encode($data->member_group_allow_message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_group_allow_visit')); ?>:</b>
	<?php echo CHtml::encode($data->member_group_allow_visit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_group_allow_post')); ?>:</b>
	<?php echo CHtml::encode($data->member_group_allow_post); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_group_allow_postverify')); ?>:</b>
	<?php echo CHtml::encode($data->member_group_allow_postverify); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_group_allow_send_message')); ?>:</b>
	<?php echo CHtml::encode($data->member_group_allow_send_message); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('member_group_allow_post_num')); ?>:</b>
	<?php echo CHtml::encode($data->member_group_allow_post_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_group_description')); ?>:</b>
	<?php echo CHtml::encode($data->member_group_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_group_sort')); ?>:</b>
	<?php echo CHtml::encode($data->member_group_sort); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_group_is_delete')); ?>:</b>
	<?php echo CHtml::encode($data->member_group_is_delete); ?>
	<br />

	*/ ?>

</div>