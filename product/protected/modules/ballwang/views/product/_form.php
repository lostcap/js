<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">带有 <span class="required">*</span> 为必填项.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'product_name',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'product_name_alias',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'product_sku',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->textFieldRow($model,'product_url',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'product_weight',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_base_price',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_orig_price',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_special_price',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_stock_qty',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_stock_cart_min',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_stock_cart_max',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_stock_status',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_status',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_active',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_short_description',array('class'=>'span5','maxlength'=>512)); ?>

	<?php echo $form->textAreaRow($model,'product_description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'product_seo_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_category_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_promotion',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_wholesale',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_feature',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_freeshiping',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_accessory',array('class'=>'span5','maxlength'=>96)); ?>

	<?php echo $form->textFieldRow($model,'product_together',array('class'=>'span5','maxlength'=>96)); ?>

	<?php echo $form->textFieldRow($model,'product_create_at',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_last_update',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'product_new_arrivals',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
