<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistic_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->statistic_id),array('view','id'=>$data->statistic_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistic_time_year')); ?>:</b>
	<?php echo CHtml::encode($data->statistic_time_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistic_time_month')); ?>:</b>
	<?php echo CHtml::encode($data->statistic_time_month); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistic_timie_day')); ?>:</b>
	<?php echo CHtml::encode($data->statistic_timie_day); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistic_time')); ?>:</b>
	<?php echo CHtml::encode($data->statistic_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistic_category')); ?>:</b>
	<?php echo CHtml::encode($data->statistic_category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistic_currency')); ?>:</b>
	<?php echo CHtml::encode($data->statistic_currency); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('statistic_account')); ?>:</b>
	<?php echo CHtml::encode($data->statistic_account); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistic_success_order')); ?>:</b>
	<?php echo CHtml::encode($data->statistic_success_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistic_register_customer')); ?>:</b>
	<?php echo CHtml::encode($data->statistic_register_customer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistic_order_customer')); ?>:</b>
	<?php echo CHtml::encode($data->statistic_order_customer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistic_order_site_num')); ?>:</b>
	<?php echo CHtml::encode($data->statistic_order_site_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statistic_order_paymethod')); ?>:</b>
	<?php echo CHtml::encode($data->statistic_order_paymethod); ?>
	<br />

	*/ ?>

</div>