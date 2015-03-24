<?php
$data = $model['data'];
$dataTimeColumn = $model['data']['refundTimeCount'];
$dataTimeSpline = $model['data']['refundTimeOrderNum'];
foreach ($dateCategory as $key => $value) {
    $dataTimeColumnShow[] = (int)$dataTimeColumn[$value];
    $dataTimeSplineShow[] = (int)$dataTimeSpline[$value];
}

$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options' => array(
        'chart' => array(
            'zoomType' => 'xy',
        ),
        'title' => array('text' => $model['stepChartName']),
        'xAxis' => array(
            'categories' => $dateCategory,
            'labels' => array(
                'rotation' => -45,
                'align' => 'right',
                'style' => array(
                    'font' => 'normal 13px Verdana, sans-serif',
                )
            ),
        ),
        'yAxis' => array(
            array(
                'title' => array(
                    'text' => '退单金额',
                    'style' => array('color' => '#4572A7'),
                ),
                'labels' => array(
                    'formatter' => 'js:function() { return this.value +\' 元\';}',
                    'style' => array('color' => '#4572A7'),
                ),
            ),
            array(
                'title' => array(
                    'text' => '订单数量',
                    'style' => array('color' => '#AA4643'),
                ),
                'labels' => array(
                    'formatter' => 'js:function() { return this.value +\' 单\';}',
                    'style' => array('color' => '#AA4643'),
                ),
                'opposite' => 'true',
            ),
        ),
        'series' => array(
            array(
                'name' => '退单金额',
                'type' => 'column',
                'style' => array('color' => '#4572A7'),
                'data' => $dataTimeColumnShow,
            ),
            array(
                'name' => '退单数量',
                'type' => 'spline',
                'yAxis' => 1,
                'style' => array('color' => '#c0c0c0'),
                'data' =>$dataTimeSplineShow,
            ),
        //  array('name' => $modelSecond['stepChartName'], 'data' =>  $modelSecondData),
        )
    )
));
?>

