<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'member_group_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'member_group_name',array('class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'member_group_allow_message',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'member_group_allow_visit',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'member_group_allow_post',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'member_group_allow_postverify',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'member_group_allow_send_message',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'member_group_allow_post_num',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'member_group_description',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'member_group_sort',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'member_group_is_delete',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
