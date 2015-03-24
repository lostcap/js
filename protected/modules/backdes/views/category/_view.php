<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->category_id),array('view','id'=>$data->category_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_level')); ?>:</b>
	<?php echo CHtml::encode($data->category_level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_parentid')); ?>:</b>
	<?php echo CHtml::encode($data->category_parentid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_name')); ?>:</b>
	<?php echo CHtml::encode($data->category_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_description')); ?>:</b>
	<?php echo CHtml::encode($data->category_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_url')); ?>:</b>
	<?php echo CHtml::encode($data->category_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_show_order')); ?>:</b>
	<?php echo CHtml::encode($data->category_show_order); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('category_is_menu')); ?>:</b>
	<?php echo CHtml::encode($data->category_is_menu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_is_delete')); ?>:</b>
	<?php echo CHtml::encode($data->category_is_delete); ?>
	<br />

	*/ ?>

</div>