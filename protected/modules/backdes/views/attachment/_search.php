<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'attachment_id',array('class'=>'span5','maxlength'=>11)); ?>

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
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
