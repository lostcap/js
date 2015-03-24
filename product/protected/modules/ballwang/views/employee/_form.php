<div>

    <?php
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id' => 'employee-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array(
                    'style' => 'width: 570px;',
                    'class' => 'well',
                ),
            ));
    ?>
    <h3>账号创建</h3>
    <p class="help-block">带有 <span class="required">*</span> 为必填项.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model, 'employee_name', array('class' => 'span5', 'maxlength' => 32)); ?>

    <?php echo $form->textFieldRow($model, 'employee_email', array('class' => 'span5', 'maxlength' => 128)); ?>

    <?php
    if ($model->isNewRecord) {
        echo $form->textFieldRow($model, 'employee_passwd', array('class' => 'span5', 'maxlength' => 32));
        ?>
        <?php if (Yii::app()->user->checkAccess('engineerAction')) { ?>
            <h3>权限分配</h3>
            <?php echo CHtml::dropDownList('role', '', AuthItem::getRoles(),array('style'=>'width: 380px;')) ?>
        <?php } ?>
        <?php
    }
    ?>
    <?php echo $form->dropDownListRow($model, 'employee_active', array('1' => '激活', '0' => '失效'), array('class' => 'span5')); ?>

    <div class="form-actions" style="width: 340px;">
        <?php
        $this->widget('bootstrap.widgets.BootButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => $model->isNewRecord ? 'Create' : 'Save',
        ));
        ?>
    </div>
    <?php $this->endWidget(); ?>
</div>


