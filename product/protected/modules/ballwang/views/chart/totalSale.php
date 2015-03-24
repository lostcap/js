<p class="well">
    销售总额：<span style="color: green;">￥<?php echo $data['total']; ?></span>
    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'label' => '统计规则说明',
        'type' => 'primary',
        'htmlOptions' => array(
            'data-toggle' => 'modal',
            'data-target' => '#myModal',
            'style' => 'float:right;',
        ),
    ));
    ?>
</p>


<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'myModal')); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>销售总额统计说明</h4>
</div>

<div class="modal-body">
    <p><?php
$this->widget('bootstrap.widgets.BootLabel', array(
    'type' => 'warning', // '', 'success', 'warning', 'important', 'info' or 'inverse'
    'label' => '1.',
));
?> 销售总额统计指定时间内支付成功和已经发货的订单额，部分退款订单仍然统计全额！</p>
    <p><?php
        $this->widget('bootstrap.widgets.BootLabel', array(
            'type' => 'success',
            'label' => '2.',
        ));
?> 退款，拒付或者其它原因造成的资金撤销都视为失败订单！</p>
    <p><?php
        $this->widget('bootstrap.widgets.BootLabel', array(
            'type' => 'important',
            'label' => '3.',
        ));
?> 对于资金撤销的订单会在相应月份中扣除该月销售量！</p>
    <p><?php
        $this->widget('bootstrap.widgets.BootLabel', array(
            'type' => 'info',
            'label' => '4.',
        ));
?> 该项统计根据每个销售站后台订单状态统计！最近3个月内的订单状态修改会自动同步！</p>
</div>

<div class="modal-footer">
    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'type' => 'primary',
        'label' => '已经了解！',
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
$this->renderPartial('_stepChart', array('model' => $data));
?>
<p class="well">
    每条产品线销售总计:
    <?php
    if ($categorySale = $dataArea['total']) {
        foreach ($categorySale as $key => $value) {
            echo '<span style="color:red;">' . $key . '</span>:<span style="color:green;">￥' . $value . '</span>, ';
        }
    }
    ?>
    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'label' => '统计规则说明',
        'type' => 'primary',
        'htmlOptions' => array(
            'data-toggle' => 'modal',
            'data-target' => '#myModal2',
            'style' => 'float:right;',
        ),
    ));
    ?>

    <?php $this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'myModal2')); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>每条产品先销售总额统计说明</h4>
</div>

<div class="modal-body">
    <p><?php
    $this->widget('bootstrap.widgets.BootLabel', array(
        'type' => 'warning', // '', 'success', 'warning', 'important', 'info' or 'inverse'
        'label' => '1.',
    ));
    ?> 每条产品线的销售总额统计指定时间内支付成功和已经发货的订单额!</p>
    <p><?php
        $this->widget('bootstrap.widgets.BootLabel', array(
            'type' => 'success',
            'label' => '2.',
        ));
    ?> 退款，拒付或者其它原因造成的资金撤销都视为失败订单！</p>
    <p><?php
        $this->widget('bootstrap.widgets.BootLabel', array(
            'type' => 'important',
            'label' => '3.',
        ));
    ?> 最近3个月对于资金撤销的订单会在相应月份中扣除该条产品先该月销售量！</p>
</div>

<div class="modal-footer">
    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'type' => 'primary',
        'label' => '已经了解！',
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

</p>
<?php
$this->renderPartial('/widget/_areaChart', array('model' => $dataArea));
?>
<div style="width: 440px;float: left;">
    <?php
    $data['stepChartName'] = '月销售量所占销售总额百分比';
    $this->renderPartial('/widget/_pieChart', array('model' => $data));
    ?>
</div>
<div style="width: 430px;float: left;margin-left: 65px;">
    <?php
    $dataCategory['stepChartName'] = '每条产品线销售总额所占百分比';
    $this->renderPartial('/widget/_pieChart', array('model' => $dataCategory));
    ?>
</div>


