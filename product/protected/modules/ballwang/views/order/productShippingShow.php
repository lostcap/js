<h3>请选择订单导出条件</h3> 
<br>
<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
            'id' => 'horizontalForm',
            'type' => 'horizontal',
        ));
?>

<fieldset>
    <?php echo $form->dropDownListRow($model, 'site', $model->siteArray); ?>

    <div style="margin-left: 60px;">
        <?php echo '开始时间: ' ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'outStartTime',
            'options' => array(
                'dateFormat' => 'yy-mm-dd', //database save format  
                //'altFormat'=>'mm-dd-yy', //display format  
                'showAnim' => 'fold',
            //'yearRange'=>'-3:+3'   
            ),
            'htmlOptions' => array(
                'style' => 'width:90px;',
            )
        ));
        ?>  
        <?php echo '结束时间: ' ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'outEndTime',
            'options' => array(
                'dateFormat' => 'yy-mm-dd', //database save format  
                //'altFormat'=>'mm-dd-yy', //display format  
                'showAnim' => 'fold',
            //'yearRange'=>'-3:+3'   
            ),
            'htmlOptions' => array(
                'style' => 'width:90px;',
            )
        ));
        ?> 
    </div>
</fieldset>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'ok white', 'label' => '确定导出')); ?>
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'reset', 'icon' => 'remove', 'label' => '重置内容')); ?>
</div>

<?php $this->endWidget(); ?>

