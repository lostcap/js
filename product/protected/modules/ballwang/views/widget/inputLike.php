<?php if (Yii::app()->user->checkAccess('optionSql')) { ?>
<tr>
    说明：该操作需要提供<span style="color: red;">模糊</span>的产品SKU，Excel的格式如下 【<a href="/download/product_Like.xls"> 模糊产品SKU </a>】
</tr>
<br></br>
<tr>
    <td class="label">选择要上传的文件<span class="required">*</span></td>
    <td class="value"><?php echo CHtml::fileField('uploadFileLike', '', array('style' => 'margin-bottom: 0px;')); ?></td>
    <td class="scope-label"><span class="nobr"></span></td>
    <td><small></small></td>
</tr>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'ok white', 'label' => '处理')); ?>
<?php
} else {
    echo '<tr> 说明：如果你懂我请联系管理员，添加权限。</tr>';
}?>