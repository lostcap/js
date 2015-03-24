<?php
$this->breadcrumbs = array(
    'Domains' => array('index'),
);

?>

<h1>现推站点浏览</h1>


<?php
$backname=$this->backName;
$this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'domain-grid',
    'dataProvider' => $model->orderSearch(),
    'filter' => $model,
    'columns' => array(
//        'domain_buy_via',
        'domain_name',
        array(
            'header'=>'产品线',
            'name'=>'domain_site_support',
            'value'=>'$data->support->primary_site_name',
            'type' => 'raw',
            'filter' => Domain::getPrimarySite(),
            'htmlOptions'=>array(
                'style'=>'width: 100px;color:#090;',
            ),
        ) ,
        array(
            'header'=>'负责人',
            'name'=>'domain_user',
            'value'=>'$data->domainUser->user_name',
            'type'=>'raw',
            'filter'=>Domain::getDomainUser(),

        ),
        array(
            'header'=>'关键词',
            'name'=>'domain_seo_keywords',
            'htmlOptions'=>array(
                'style'=>'width: 100px;color:#090;',
            ),
        ),
        array(
            'header'=>'备注',
            'name'=>'domain_note_seo',
            'filter'=>false,
            'htmlOptions'=>array(
                'style'=>'width: 100px;color:#090;',
            ),
        ),


//        'domain_space_id',
//        'domain_attribute',
//        'domain_keyword',
//        'domain_site_support',
//        'domain_ftp',

//        'domain_ftp_password',

//        'domain_data_password',
//        'domain_data',
//        array(
//            'name'=>'domain_data_address',
//            'value'=>'$data->dataAddress->space_data_address',
//        ),

    array(
        'header'=>'推广时间',
        'name'=>'domain_online_time',
    ),

        array(
            'class' => 'CButtonColumn',
            'template'=>'{update}',
            'updateButtonUrl'=>'Yii::app()->createUrl("'.$backname.'/order/updateDomain",array("id" => $data->domain_id))',

        ),
    ),
));
?>
