<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'statistic_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'statistic_time_year',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'statistic_time_month',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'statistic_timie_day',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'statistic_time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'statistic_category',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'statistic_currency',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'statistic_account',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'statistic_success_order',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'statistic_register_customer',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'statistic_order_customer',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'statistic_order_site_num',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'statistic_order_paymethod',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
