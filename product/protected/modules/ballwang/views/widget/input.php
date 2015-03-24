<tr>
    说明：该操作需要提供精确的产品SKU，Excel的格式如下 【<a href="/download/product_sku.xls"> 产品处理excel </a>】
</tr>
<br></br>
<tr>
    <td class="label">选择要上传的文件<span class="required">*</span></td>
    <td class="value"><?php echo CHtml::fileField('uploadFile', '', array('style' => 'margin-bottom: 0px;')); ?></td>
    <td class="scope-label"><span class="nobr"></span></td>
    <td><small></small></td>
</tr>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'ok white', 'label' => '上传处理')); ?>