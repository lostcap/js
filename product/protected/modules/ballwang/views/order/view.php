<?php
$this->breadcrumbs = array(
    'Orders' => array('index'),
    $model->order_id,
);
?>

<br></br>
<h2>订单查看</h2>
<br>

<?php
$this->widget('bootstrap.widgets.BootTabbable', array(
    'type' => 'tabs',
    'placement' => 'left', // 'above', 'right', 'below' or 'left'
    'tabs' => array(
        array('label' => '订单详情', 'content' => $this->renderPartial('order_detail', array('model' => $model, 'ship' => $ship), true), 'active' => true),
        array('label' => '用户详情', 'content' => $this->renderPartial('user_detail', array('model' => $model, 'order' => $order, 'address' => $address), true)),
        array('label' => '货运查看', 'content' => '<p>开发中...</p>'),
    ),
));
?>
