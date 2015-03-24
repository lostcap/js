<?php
$this->breadcrumbs = array(
    'Sites' => array('index'),
    '批量导入退款订单',
);
?>
<br>
<h2>EMD邮件导入</h2>
<br>
<p>
    EDM邮件导入，如果你是第一次导入请不要执行改操作。导入格式： 【<a href="/download/refund.xls">格式下载</a>】
    <br>如果邮箱和EDM栏目留空则使用最后一次出现的配置信息。
</p>

<?php
/** @var BootActiveForm $form */
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

