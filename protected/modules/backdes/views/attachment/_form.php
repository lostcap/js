<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'attachment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'attachment_catid',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'attachment_filename',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'attachment_filepath',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'attachment_is_image',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'attachment_is_thumb',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'attachment_userid',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'attachment_uploadtime',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'attachment_uploadip',array('class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'attachment_status',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
