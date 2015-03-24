<style>
    .emph{color: red;}
    .modal{width: 1000px;left: 33%;}
</style>
<div style="float: left;margin-right: 35px;">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id' => 'horizontalForm1',
                'type' => 'inline',
                'htmlOptions' => array('class' => 'well'),
            ));
    echo '<h4>订单历史</h4>——————————————————————————<br></br>';
    echo $form->dropDownList($model, 'order_status', Lookup::items('payment_status'), array('id' => 'order_status', 'style' => 'width: 145px;'));
    $display = $model->order_status == Order::Shipped ? 'width: 100px;' : 'display:none;width: 100px;';
    echo $form->textFieldRow($ship, 'ship_code', array('id' => 'ship_code', 'style' => $display,));
    $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'icon' => 'ok', 'label' => '提交'));
    $this->endWidget();
    ?>
</div>
<div style="float: left;">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id' => 'horizontalForm2',
                'type' => 'inline',
                'htmlOptions' => array('class' => 'well'),
            ));
    echo '<h4>客户留言</h4>——————————————————————————<br></br>';
    echo '<div style="width: 340px;">';
    if ($model->order_comment) {
        echo $model->order_comment;
    } else {
        echo '该客户没有留言! ';
    }
    echo '</div>';
    $this->endWidget();
    ?>
</div>
<br></br>
<div style="float: left;margin-right: 35px;">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id' => 'horizontalForm3',
                'type' => 'inline',
                'htmlOptions' => array('class' => 'well'),
            ));
    echo '<h4>单号信息</h4>——————————————————————————<br></br>';
    echo '<div style="width: 340px;">';
    echo '订单号 ：  ' . $model->getInvoice() . '<br><br>';
    echo '下单时间：' . $model->order_create_at . '<br><br>';
    echo '订单状态：' . Lookup::item('payment_status', $model->order_status) . '<br>';
    echo '</div>';
    $this->endWidget();
    ?>   
</div>
<div style="float: left;">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id' => 'horizontalForm4',
                'type' => 'inline',
                'htmlOptions' => array('class' => 'well'),
            ));
    echo '<h4>客户信息</h4>——————————————————————————<br></br>';
    echo '<div style="width: 340px;">';
    ?>
    <table cellspacing="0" class="">
        <tbody>
            <tr>
                <td ><label>客户姓名</label></td>
                <td>
                    <a href="#">
                        <strong><?php echo $model->customer->customer_name; ?></strong>
                    </a>
                </td>
            </tr>
            <tr>
                <td ><label>Email</label></td>
                <td><a href="mailto:<?php echo $model->customer->customer_email; ?>"><strong><?php echo $model->customer->customer_email; ?></strong></a></td>
            </tr>
            <tr>
                <td ><label>注册时间:</label></td>
                <td><strong><?php echo $model->customer->customer_create_at; ?></strong></td>
            </tr>
            <tr>
                <td ><label>有效订单数:</label></td>
                <td><strong><?php echo Order::getCustomerValidOrders($model->customer_id); ?></strong></td>
            </tr>
            <tr>
                <td ><label>总计金额:</label></td>
                <td><strong>$<?php echo Order::getCustomerTotalAmount($model->customer_id); ?></strong></td>
            </tr>
            <tr>
                <td ><label>客户组</label></td>
                <td><strong><?php echo $model->customer->group->group_name; ?></strong></td>
            </tr>
        </tbody>
    </table>
    <?php
    echo '</div>';
    $this->endWidget();
    ?>
</div>
<br></br>
<div style="float: left;margin-right: 35px;">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id' => 'horizontalForm5',
                'type' => 'inline',
                'htmlOptions' => array('class' => 'well'),
            ));
    echo '<h4>货运地址</h4>——————————————————————————<br></br>';
    echo '<div style="width: 340px;">';
    ?>
    <?php $address = CustomerAddress::model()->findByPk($model->order_address_id); ?>
    <table cellspacing="0" class="">
        <tbody>
            <tr >
                <td style="width: 90px;"><label>姓名</label></td>
                <td>
                    <strong><?php echo $address->customer_firstname . ' ' . $address->customer_lastname; ?></strong>
                    </a>
                </td>
            </tr>
            <tr>
                <td ><label>地址1</label></td>
                <td><?php echo $address->address_street; ?> </td>
            </tr>
            <tr>
                <td ><label>地址2</label></td>
                <td><strong><?php //echo $model->customer->customer_create_at;                        ?></strong></td>
            </tr>
            <tr>
                <td ><label>邮编/城市:</label></td>
                <td><strong><?php echo $address->address_postcode . ' ' . $address->address_city; ?></strong></td>
            </tr>
            <tr>
                <td ><label>国家:</label></td>
                <td><strong><?php echo Country::item($address->address_country); ?></strong></td>
            </tr>
            <tr>
                <td ><label>电话：</label></td>
                <td><strong><?php echo $address->address_phonenumber; ?></strong></td>
            </tr>
        </tbody>
    </table>
    <?php
    echo '</div>';
    $this->endWidget();
    ?>   
</div>

<div style="float: left;">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id' => 'horizontalForm6',
                'type' => 'inline',
                'htmlOptions' => array('class' => 'well'),
            ));
    echo '<h4>货运</h4>——————————————————————————<br></br>';
    echo '<div style="width: 340px;">';
    ?>
    <table cellspacing="0"  >
        <tbody>
            <tr>
                <td style="width: 90px;"><label>货运方式</label></td>
                <td>
                    <strong><?php echo $model->carrier->carrier_name ?></strong>
                </td>
            </tr>
            <tr>
                <td ><label>货运跟踪</label></td>
                <td>
                    <strong><a href="<?php echo $ship->trackUrl($ship->ship_code, $model->carrier->carrier_url); ?>" target="_blank">
                            <?php echo $ship->ship_code; ?></a></strong>
                </td>
            </tr>
            <tr>
                <td ><label>总重量</label></td>
                <td>
                    <strong><?php echo round($model->getWeightTotal(), 4); ?> g</strong>
                </td>
            </tr>
        </tbody>
    </table>
    <?php
    echo '</div>';
    $this->endWidget();
    ?>
</div>
<br></br>
<div style="clear: both;"></div>
<div style="float: left; width: 800px;">


    <?php
    if(Yii::app()->user->checkAccess('shipping')){
        $this->widget('bootstrap.widgets.BootButton', array(
            'label' => '修改产品',
            'url' => '#myModal',
            'type' => 'primary',
            'size' => 'mini',
            'htmlOptions' => array('data-toggle' => 'modal', 'style' => 'float:right; '),
        ));
    }
    $products = new OrderItem();
    $sign = Currency::getCurrencySymbol($model->order_currency_id);
    $this->widget('bootstrap.widgets.BootGridView', array(
        'id' => 'order-grid',
        'dataProvider' => $products->searchOrder($model->order_id),
        'filter' => $products,
        'type' => 'striped bordered condensed',
        'columns' => array(
            array(
                'header' => '产品名称',
                'value' => '$data->product->product_name',
                'htmlOptions' => array(
                    'style' => 'width: 150px;color:#090;',
                ),
            ),
            array(
                'header' => 'SKU',
                'value' => '$data->product->product_sku',
                'htmlOptions' => array(
                    'style' => 'width: 100px;color:#090;',
                ),
            ),
            array(
                'header' => '样式/大小',
                'value' => '$data->attribute->order_attribute_size',
                'htmlOptions' => array(
                    'style' => 'width: 100px;color:#090;',
                ),
            ),
            array(
                'header' => '价格',
                'value' => '$data->order->currency->currency_symbol.$data->item_price',
            ),
            array(
                'header' => '数量',
                'value' => '$data->item_qty',
                'htmlOptions' => array(
                    'style' => 'width:100px;color:#090;',
                ),
            ),
            array(
                'header' => '小计',
                'value' => '$data->order->currency->currency_symbol.$data->item_qty*$data->item_price',
                'htmlOptions' => array(
                    'style' => 'width: 150px;color:red;',
                ),
            ),
            array(
                'header' => '操作',
                'class' => 'bootstrap.widgets.BootButtonColumn',
                'template' => '{delete}',
                'buttons' => array(
                    'delete' => array(
                        'visible' => 'Yii::app()->user->checkAccess(\'shipping\')',
                    ),

                ),
            ),
//		'order_site_id',
        ),
    ));
    ?>

</div>

<div style="clear: both;"></div>
<div style="float: left;margin-right: 35px;">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id' => 'horizontalForm7',
                'type' => 'inline',
                'htmlOptions' => array('class' => 'well'),
            ));
    echo '<h4>订单统计</h4>——————————————————————————<br></br>';
    echo '<div style="width: 340px;">';
    ?>
    <table width="100%" cellspacing="0">
        <col />
        <col width="1" />
        <tbody>
            <tr>
                <td ><strong>支付方式</strong></td>
                <td> <strong><?php echo $model->payment->payment_name; ?></strong></td>
            </tr>
        </tbody>

        <tfoot>
            <tr>
                <td >
                    <strong>物品总计</strong>
                </td>
                <td class="emph">
                    <strong><span class="price"><?php echo $sign . $model->order_subtotal; ?></span></strong>
                </td>
            </tr>
            <tr>
                <td >
                    <strong>满额优惠</strong>
                </td>
                <td class="emph">
                    <strong><span class="price"><?php echo '- ' . $sign . $model->order_promo_free; ?></span></strong>
                </td>
            </tr>

            <tr>
                <td >
                    <strong>优惠券</strong>
                </td>
                <td class="emph">
                    <strong><span class="price"><?php echo '- ' . $sign . $model->order_coupon; ?></span></strong>
                </td>
            </tr>
            <?php
            if ($model->order_refund != '0.0') {
                ?>
                <tr>
                    <td >
                        <strong>退款总额</strong>
                    </td>
                    <td class="emph">
                        <strong><span class="price"><?php echo '- ' . $sign . $model->order_refund; ?></span></strong>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td >
                    <strong>邮费</strong>
                </td>
                <td class="emph">
                    <strong><span class="price"><?php echo $sign . $model->order_trackingtotal; ?></span></strong>
                </td>
            </tr>
            <tr>
                <td >
                    <strong>总计</strong>
                </td>
                <td class="emph">
                    <strong><span class="price"><?php echo $sign . $model->order_grandtotal; ?></span></strong>
                </td>
            </tr>
        </tfoot>
    </table>
    <?php
    echo '</div>';
    $this->endWidget();
    ?>
</div>

<?php
$refund = $model->refund;
if ($refund) {
    ?>
    <div style="float: left;">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                    'id' => 'horizontalForm8',
                    'type' => 'inline',
                    'htmlOptions' => array('class' => 'well'),
                ));
        echo '<h4>退款理由</h4>——————————————————————————<br></br>';
        echo '<div style="width: 340px;">';
        $refund = $model->refund;
        if ($refund) {
            foreach ($refund as $key => $value) {
                ?>
                <p>
                    <?php echo '退款时间：'.$value->refund_time . '<br>'; ?> 
                    <?php echo '退款分类：<span style="color:red;">' . $value->refundCategory->refund_category_name . '</span>.<br>'; ?> 
                    <?php echo '退单金额: <span style="color:red;">- '.$value->currency->currency_symbol.$value->refund_account.'</span><br>'; ?>
                    <?php echo '退款类型：';
                    echo '<span style="color:red">';
                    echo $value->refund_status == 1 ? "全部退款" : "部分退款";
                    echo '</span>';
                    echo '<br>'; ?>
                <?php echo '退款说明：<span style="color:green;">' . $value->refund_content . '</span><br>'; ?>
                </p>

                <?php
            }
        }
        echo '</div>';
        $this->endWidget();
        ?>
    </div>
    <?php
}
?>
<br></br>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'myModal')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>订单显示：<span style="color: green;"><?php echo $model->getInvoice();?></span></h3>
</div>
<br>

<p style="margin-left: 50px;">如果在添加之前操作过删除商品，需要刷新页面才能同步小窗体中产品信息，但是不刷新不影响添加商品.</p>

<?php
$this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'order-grid1',
    'dataProvider' => $products->searchOrder($model->order_id),
    'filter' => $products,
    'type' => 'striped bordered condensed',
    'htmlOptions' => array('style' => 'width: 900px;margin-left: 50px;'),
    'columns' => array(
        array(
            'header' => '产品名称',
            'value' => '$data->product->product_name',
            'htmlOptions' => array(
                'style' => 'width: 150px;',
            ),
        ),
        array(
            'header' => 'SKU',
            'value' => '$data->product->product_sku',
            'htmlOptions' => array(
                'style' => 'width: 100px;color:#090;',
            ),
        ),
        array(
            'header' => '样式/大小',
            'value' => '$data->attribute->order_attribute_size',
            'htmlOptions' => array(
                'style' => 'width: 100px;color:#090;',
            ),
        ),
        array(
            'header' => '价格',
            'value' => '$data->order->currency->currency_symbol.$data->item_price',
        ),
        array(
            'header' => '数量',
            'value' => '$data->item_qty',
            'htmlOptions' => array(
                'style' => 'width:100px;',
            ),
        ),
        array(
            'header' => '小计',
            'value' => '$data->order->currency->currency_symbol.$data->item_qty*$data->item_price',
            'htmlOptions' => array(
                'style' => 'width: 150px;color:red;',
            ),
        ),

//		'order_site_id',
    ),
));
?>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
    'id'=>'order-form1',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('style' => 'width: 900px;margin-left: 50px;'),
)); ?>
<a href="#" style="" id='addNewProduct' >添加产品</a>

<div style="display: none;margin-top: 20px;" id="showNewProductForm">

<div id="returnProductSKU">
    <?php
    echo '产品名称：<input name="product_name"><br>';
    echo '产品SKU：<input name="product_sku"><br>';
    echo '产品尺码：<input name="product_size"><br>';
    echo '产品数量：<input name="product_qty"><br>';
    echo '产品价格：<input name="product_price"><br> ';
    ?>
    <input value="<?php echo $model->order_id; ?>" name="order_id" type="hidden">
    <input value="<?php echo $model->order_site_id; ?>" name="order_site_id" type="hidden">
</div>
    <?php
    echo CHtml::SubmitButton('确认添加');
    ?>
</div>
<?php $this->endWidget(); ?>

<div class="form-actions">

</div>
<?php $this->endWidget(); ?>
<script>
    $('#addNewProduct').click(function(){
        $('#showNewProductForm').slideToggle("slow");
    });
</script>



