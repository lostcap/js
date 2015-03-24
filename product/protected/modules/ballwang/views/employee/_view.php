<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->employee_ID),array('view','id'=>$data->employee_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_name')); ?>:</b>
	<?php echo CHtml::encode($data->employee_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_email')); ?>:</b>
	<?php echo CHtml::encode($data->employee_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_passwd')); ?>:</b>
	<?php echo CHtml::encode($data->employee_passwd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_active')); ?>:</b>
	<?php echo CHtml::encode($data->employee_active); ?>
	<br />


</div>