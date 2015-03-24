<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'content_log_id',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'content_log_action',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'content_log_action_type',array('class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'content_log_admin_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'content_log_admin_ip',array('class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'content_log_time',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
