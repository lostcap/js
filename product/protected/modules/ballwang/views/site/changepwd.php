<fieldset>
    <?php
    /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id' => 'inlineForm',
                'type' => 'inline',
                'htmlOptions' => array('class' => 'well','style'=>'margin-left: 315px;'),
            ));
    ?>
    <?php echo $form->textFieldRow($model, 'oldPassword'); ?><br></br>
    <?php echo $form->textFieldRow($model, 'password'); ?><br></br>
    <?php echo $form->textFieldRow($model, 'confirmPassword'); ?><br></br>

<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'icon' => 'ok', 'label' => '修改密码')); ?>

<?php $this->endWidget(); ?>
</fieldset>