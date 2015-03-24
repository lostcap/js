<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('detial_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->detial_id),array('view','id'=>$data->detial_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_id')); ?>:</b>
	<?php echo CHtml::encode($data->content_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_detial_text')); ?>:</b>
	<?php echo CHtml::encode($data->content_detial_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_detial_is_pagination')); ?>:</b>
	<?php echo CHtml::encode($data->content_detial_is_pagination); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_detial_is_allow_comment')); ?>:</b>
	<?php echo CHtml::encode($data->content_detial_is_allow_comment); ?>
	<br />


</div>