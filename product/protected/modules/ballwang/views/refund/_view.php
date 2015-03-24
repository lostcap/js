<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('refund_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->refund_id),array('view','id'=>$data->refund_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('refund_order_num')); ?>:</b>
	<?php echo CHtml::encode($data->refund_order_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('refund_currency')); ?>:</b>
	<?php echo CHtml::encode($data->refund_currency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('refund_account')); ?>:</b>
	<?php echo CHtml::encode($data->refund_account); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('refund_account_cny')); ?>:</b>
	<?php echo CHtml::encode($data->refund_account_cny); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('refund_paymethod')); ?>:</b>
	<?php echo CHtml::encode($data->refund_paymethod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('refund_site')); ?>:</b>
	<?php echo CHtml::encode($data->refund_site); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('refund_category')); ?>:</b>
	<?php echo CHtml::encode($data->refund_category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('refund_country')); ?>:</b>
	<?php echo CHtml::encode($data->refund_country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('refund_order_time')); ?>:</b>
	<?php echo CHtml::encode($data->refund_order_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('refund_time')); ?>:</b>
	<?php echo CHtml::encode($data->refund_time); ?>
	<br />

	*/ ?>

</div>