<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'statistics-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'statistics_category_id',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'statistics_views',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'statistics_ip',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'statistics_yesterday_ip',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'statistics_day_ip',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'statistics_week_ip',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'statistics_month_ip',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'statistics_yesterday_views',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'statistics_day_views',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'statistics_week_views',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'statistics_month_views',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'statistics_update_time',array('class'=>'span5','maxlength'=>10)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
