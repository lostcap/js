<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'refund-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">带有 <span class="required">*</span> 为必填项.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'refund_order_num',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'refund_currency',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'refund_account',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'refund_account_cny',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'refund_paymethod',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'refund_site',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'refund_category',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'refund_country',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'refund_order_time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'refund_time',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
