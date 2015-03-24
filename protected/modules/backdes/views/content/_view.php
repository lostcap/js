<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->content_id),array('view','id'=>$data->content_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('catgory_id')); ?>:</b>
	<?php echo CHtml::encode($data->catgory_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_title')); ?>:</b>
	<?php echo CHtml::encode($data->content_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_keywords')); ?>:</b>
	<?php echo CHtml::encode($data->content_keywords); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_description')); ?>:</b>
	<?php echo CHtml::encode($data->content_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_thumb')); ?>:</b>
	<?php echo CHtml::encode($data->content_thumb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_url')); ?>:</b>
	<?php echo CHtml::encode($data->content_url); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('content_order')); ?>:</b>
	<?php echo CHtml::encode($data->content_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_status')); ?>:</b>
	<?php echo CHtml::encode($data->content_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_username')); ?>:</b>
	<?php echo CHtml::encode($data->content_username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_edit_name')); ?>:</b>
	<?php echo CHtml::encode($data->content_edit_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_from_name')); ?>:</b>
	<?php echo CHtml::encode($data->content_from_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inputtime')); ?>:</b>
	<?php echo CHtml::encode($data->inputtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updatetime')); ?>:</b>
	<?php echo CHtml::encode($data->updatetime); ?>
	<br />

	*/ ?>

</div>