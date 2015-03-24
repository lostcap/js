<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('attachment_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->attachment_id),array('view','id'=>$data->attachment_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attachment_catid')); ?>:</b>
	<?php echo CHtml::encode($data->attachment_catid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attachment_filename')); ?>:</b>
	<?php echo CHtml::encode($data->attachment_filename); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attachment_filepath')); ?>:</b>
	<?php echo CHtml::encode($data->attachment_filepath); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attachment_is_image')); ?>:</b>
	<?php echo CHtml::encode($data->attachment_is_image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attachment_is_thumb')); ?>:</b>
	<?php echo CHtml::encode($data->attachment_is_thumb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attachment_userid')); ?>:</b>
	<?php echo CHtml::encode($data->attachment_userid); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('attachment_uploadtime')); ?>:</b>
	<?php echo CHtml::encode($data->attachment_uploadtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attachment_uploadip')); ?>:</b>
	<?php echo CHtml::encode($data->attachment_uploadip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attachment_status')); ?>:</b>
	<?php echo CHtml::encode($data->attachment_status); ?>
	<br />

	*/ ?>

</div>