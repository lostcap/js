<?php

$this->widget('bootstrap.widgets.BootButtonGroup', array(
    'type' => 'primary',
    'toggle' => 'radio', // 'checkbox' or 'radio'
    'buttons' => array(
        array('label' => 'Left','style'=>'work'),
        array('label' => 'Middle'),
        array('label' => 'Right'),
    ),
));
?>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>
 

<?php $this->endWidget(); ?>
