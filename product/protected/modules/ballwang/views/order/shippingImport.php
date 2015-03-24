<?php
$this->breadcrumbs = array(
    'Sites' => array('index'),
    '批量导入跟踪号',
);
?>
<br>
<h2>货运号批量导入</h2>
<br>
<p>
    批量导入跟踪号，如果您是第一次操作请下载导入格式 【<a href="/download/shipping.xls">格式下载</a>】
</p>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well','enctype' => 'multipart/form-data'),
)); ?>
 <tr>
    <td class="label">选择要上传的文件<span class="required">*</span></td>
    <td class="value"><?php echo CHtml::fileField('uploadFile','',array('style'=>'margin-bottom: 0px;')); ?></td>
    <td class="scope-label"><span class="nobr"></span></td>
    <td><small></small></td>
</tr>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Submit')); ?>
 

<?php $this->endWidget(); ?>