<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistics_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->statistics_id),array('view','id'=>$data->statistics_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistics_category_id')); ?>:</b>
	<?php echo CHtml::encode($data->statistics_category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistics_views')); ?>:</b>
	<?php echo CHtml::encode($data->statistics_views); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistics_ip')); ?>:</b>
	<?php echo CHtml::encode($data->statistics_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistics_yesterday_ip')); ?>:</b>
	<?php echo CHtml::encode($data->statistics_yesterday_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistics_day_ip')); ?>:</b>
	<?php echo CHtml::encode($data->statistics_day_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistics_week_ip')); ?>:</b>
	<?php echo CHtml::encode($data->statistics_week_ip); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('statistics_month_ip')); ?>:</b>
	<?php echo CHtml::encode($data->statistics_month_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistics_yesterday_views')); ?>:</b>
	<?php echo CHtml::encode($data->statistics_yesterday_views); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistics_day_views')); ?>:</b>
	<?php echo CHtml::encode($data->statistics_day_views); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistics_week_views')); ?>:</b>
	<?php echo CHtml::encode($data->statistics_week_views); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistics_month_views')); ?>:</b>
	<?php echo CHtml::encode($data->statistics_month_views); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistics_update_time')); ?>:</b>
	<?php echo CHtml::encode($data->statistics_update_time); ?>
	<br />

	*/ ?>

</div>