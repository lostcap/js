<?php
$this->breadcrumbs = array(
    '联嵌订单管理总后台',
);
?>

<h2></h2>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'product_form',
    'htmlOptions' => array('class' => 'well'),
));
?>
<div style="width:350;float:right;margin-right: 30px;margin-top: 20px;">
<?php
echo '<h2>订单总额: <span>';
$prictString = '￥' . $price['total'];
?>
<?php
$this->widget('bootstrap.widgets.BootButton', array(
    'label' => $prictString,
    'type' => 'success',
    'htmlOptions' => array('data-title' => '货币详细', 'data-content' => $currencyString, 'rel' => 'popover'),
));

echo '</span></h2><br>';
?>
<?php
$this->widget('bootstrap.widgets.BootTabbable', array(
    'type' => 'tabs',
    'placement' => 'above', // 'above', 'right', 'below' or 'left'
    'htmlOptions' => array('class' => 'well','style' => 'width:300px;'),
    'tabs' => array(
        array('label' => '最近2天', 'content' => $this->renderPartial('_priceShow', array('return' => $return2, 'type' => 'info'), true), 'active' => true),
        array('label' => '最近7天', 'content' => $this->renderPartial('_priceShow', array('return' => $return7, 'type' => 'inverse'), true)),
        array('label' => '最近1个月', 'content' => $this->renderPartial('_priceShow', array('return' => $return30, 'type' => 'warning'), true)),
//        array('label'=>'高级查看', 'content'=>'...'),
    ),
));
?>
</div>
<div style="width: 250px;margin-left: 30px;margin-top: 20px;">
<?php
echo '<h2>自定义时间查看 </h2>';
?>
<br>

<fieldset>
    <div style="margin-left:10px;">
        <?php echo '开始时间: ' ?>

        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $outPutOrderForm,
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
        <br>
        <?php echo '结束时间: ' ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $outPutOrderForm,
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
<?php
if($orderByTime){
    echo '<br>'.$orderByTime['time'].' 日<br><h2>销售额：';

    $this->widget('bootstrap.widgets.BootButton', array(
        'label' => $orderByTime['price']['total'],
        'type' => 'success',
        'htmlOptions' => array('data-title' => '货币详细', 'data-content' => $orderByTime['currencyString'], 'rel' => 'popover'),
    ));
    echo '</h2>';
}
?>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'ok white', 'label' => '确定查看')); ?>
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'reset', 'icon' => 'remove', 'label' => '重置内容')); ?>
</div>
</div>
<?php
$this->endWidget();
?>


<?php if (Yii::app()->user->checkAccess('personInCharge')) { ?>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
                'id' => 'product_form',
                'htmlOptions' => array('class' => 'well'),
            ));
    echo '<strong>新订单</strong> ';
    $this->widget('bootstrap.widgets.BootButton', array(
        'label' => '订单产生规则',
        'url' => '#myModal',
        'type' => 'primary',
        'size' => 'mini',
        'htmlOptions' => array('data-toggle' => 'modal', 'style' => 'float:right; '),
    ));
    $this->widget('bootstrap.widgets.BootGridView', array(
        'id' => 'order-grid',
        'dataProvider' => $model->newOrder(),
        'type' => 'striped',
        'columns' => array(
            array(
                'header' => '订单号',
                'name' => 'invoice_id',
                'value' => '$data->getInvoice()',
                'htmlOptions' => array(
                    'style' => 'width: 150px;color:#090;',
                ),
            ),
            array(
                'header' => '客户邮箱',
                'name' => 'customer_id',
                'type' => 'raw',
                'value' => '$data->customer->customer_email',
                'htmlOptions' => array(
                    'style' => 'width: 150px;color:#090;',
                ),
            ),
            array(
                'header' => '网站地址',
                'name' => 'order_site_id',
                'type' => 'raw',
                'value' => '$data->site->domain_name',
                'htmlOptions' => array(
                    'style' => 'width: 150px;color:#090;',
                ),
            ),
            array(
                'header' => '下单时间',
                'name' => 'order_create_at',
                'type' => 'raw',
                'value' => '$data->order_create_at',
                'filter' => FALSE,
                'htmlOptions' => array(
                    'style' => 'width: 150px;',
                ),
            ),
            array(
                'header' => '操作',
                'class' => 'bootstrap.widgets.BootButtonColumn',
                'template' => '{view} {shipping}',
                'buttons' => array(
                    'view' => array(
                        'url' => 'Yii::app()->controller->createUrl("order/view",array("id"=>$data->order_id))',
                        'options' => array("target" => "_blank"),
                    ),
                    'shipping' => array(
                        'label' => 'Shipping',
                        'imageUrl' => '/images/fam_lorry.gif',
                        'visible' => '$data->order_status==' . Order::Delived . ' OR $data->order_status==' . Order::Shipped,
                    ),
                ),
            ),
        ),
    ));
    $this->endWidget();
    ?>





    <?php $this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'myModal')); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>订单显示提醒</h3>
    </div>

    <div class="modal-body">
        <p><?php
    $this->widget('bootstrap.widgets.BootLabel', array(
        'type' => 'warning', // '', 'success', 'warning', 'important', 'info' or 'inverse'
        'label' => '1.',
    ));
    ?> 网站每日0:00到3:00属于系统更新订单系统时间！</p>
        <p><?php
        $this->widget('bootstrap.widgets.BootLabel', array(
            'type' => 'success',
            'label' => '2.',
        ));
    ?> 如果没有显示已经成功的订单，请点击"订单管理>>订单同步"！</p>
        <p><?php
        $this->widget('bootstrap.widgets.BootLabel', array(
            'type' => 'important',
            'label' => '3.',
        ));
    ?> 后台显示金额按人民币种结算！</p>
        <p><?php
        $this->widget('bootstrap.widgets.BootLabel', array(
            'type' => 'info',
            'label' => '4.',
        ));
    ?> 显示最近20天内未发货的订单，已经发货的订单不在显示列表内！</p>
    </div>

    <div class="modal-footer">
        <?php
        $this->widget('bootstrap.widgets.BootButton', array(
            'type' => 'primary',
            'label' => '确定',
            'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        ));
        ?>
        <?php
        $this->widget('bootstrap.widgets.BootButton', array(
            'label' => '关闭',
            'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>
    <?php
} else {

    echo '<h1>欢迎使用联嵌订单管理系统</h1><br>';

    echo '<br>';
    $this->widget('bootstrap.widgets.BootBadge', array(
        'type' => 'info', // '', 'success', 'warning', 'error', 'info' or 'inverse'
        'label' => '1',
    ));
    echo ' 您当前登录的账号为：<span style="color:green;">' . Yii::app()->user->id . '</span><br><br>';
    $this->widget('bootstrap.widgets.BootBadge', array(
        'type' => 'warning', // '', 'success', 'warning', 'error', 'info' or 'inverse'
        'label' => '2',
    ));
    echo ' 系统设有定时同步功能，每日 0:00-3:00 为系统同步时间段。如需及时同步请联系超级管理员！<br><br/>';
    $this->widget('bootstrap.widgets.BootBadge', array(
        'type' => 'success', // '', 'success', 'warning', 'error', 'info' or 'inverse'
        'label' => '3',
    ));
    echo ' 您当前只能操作权限范围内的页面，如需其它功能请联系系统工程师。<br><br/>';
}
?>





