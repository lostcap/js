<div>
<?php
echo '<h2>销售额: <span>';
$prictString = '￥' . $return['price']['total'];
?>
<?php

$this->widget('bootstrap.widgets.BootButton', array(
    'label' => $prictString,
    'type' => $type,
    'htmlOptions' => array('data-title' => '货币详细', 'data-content' => $return['currencyString'], 'rel' => 'popover'),
));
echo '</span></h2><br>';
?>
</div>