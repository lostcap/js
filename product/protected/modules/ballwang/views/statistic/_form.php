<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'statistic-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">带有 <span class="required">*</span> 为必填项.</p>

	<?php echo $form->errorSummary($model); ?>

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
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
