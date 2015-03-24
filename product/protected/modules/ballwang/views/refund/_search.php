<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'refund_id',array('class'=>'span5')); ?>

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
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
