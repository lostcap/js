<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'detial_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'content_id',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textAreaRow($model,'content_detial_text',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'content_detial_is_pagination',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'content_detial_is_allow_comment',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
