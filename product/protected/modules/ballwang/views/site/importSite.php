<?php
$this->breadcrumbs = array(
    'Sites' => array('index'),
    '批量导入网站',
);
?>
<br>
<h2>网站数据库信息批量导入</h2>

<p>
    批量导入网站信息，导入格式 <a href="/download/siteDb.xls">下载</a>
</p>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'product_form',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<tr>
    <td class="label">选择要上传的文件<span class="required">*</span></td>
    <td class="value"><?php echo CHtml::fileField('uploadFile'); ?></td>
    <td class="scope-label"><span class="nobr"></span></td>
    <td><small></small></td>
</tr>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Submit')); ?>
 


<?php $this->endWidget() ?>