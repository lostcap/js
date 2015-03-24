
<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
            'id' => 'verticalForm',
            'htmlOptions' => array('class' => 'well'),
        ));
?>

<?php echo $form->textFieldRow($model, 'username', array('class' => 'span3')); ?>
<?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span3')); ?>
<?php if (CCaptcha::checkRequirements()): ?>
    <?php echo $form->textFieldRow($model, 'verifyCode', array('class' => 'span3')); ?>
    <p><?php $this->widget('CCaptcha'); ?></p>

<?php endif; ?>

<?php echo $form->checkboxRow($model, 'rememberMe'); ?>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'icon' => 'ok', 'label' => '登陆')); ?>

<?php $this->endWidget(); ?>