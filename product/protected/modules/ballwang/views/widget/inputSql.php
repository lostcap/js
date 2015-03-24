<?php if (Yii::app()->user->checkAccess('optionSql')) { ?>
    <tr>
        说明：该操作需要具备一定SQL语句知识方可使用。
    </tr>
    <br></br>
    <tr>
        <td class="value"><?php echo CHtml::textArea('inputSql', '', array('rows' => 6, 'cols' => 40, 'class' => 'span8')); ?></td>
    </tr>
    <br></br>
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'ok white', 'label' => '处理SQL命令')); ?>
    <?php
} else {
    echo '<tr> 说明：如果你懂我请联系管理员，添加权限。</tr>';
}?>