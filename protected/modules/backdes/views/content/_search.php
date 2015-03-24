<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'content_id',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'catgory_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'content_title',array('class'=>'span5','maxlength'=>80)); ?>

	<?php echo $form->textFieldRow($model,'content_keywords',array('class'=>'span5','maxlength'=>40)); ?>

	<?php echo $form->textAreaRow($model,'content_description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'content_thumb',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'content_url',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'content_order',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'content_status',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'content_username',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'content_edit_name',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'content_from_name',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'inputtime',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'updatetime',array('class'=>'span5','maxlength'=>10)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
