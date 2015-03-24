<?php
$categoryArray = array();

foreach ($model['data'] as $key => $value) {
    $categoryArray[] = $key;
    $modelFirstData[] = $value;
}

$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options' => array(
        'title' => array('text' => $title),
        'xAxis' => array(
            'categories' => $categoryArray,
            'labels' => array(
                'rotation' => -45,
                'align' => 'right',
                'style' => array(
                    'font' => 'normal 13px Verdana, sans-serif',
            )),
        ),
        'yAxis' => array(
            'title' => array('text' => $yName)
        ),
        'series' => array(
            array('name' => $model['stepChartName'], 'data' => $modelFirstData),
        //  array('name' => $modelSecond['stepChartName'], 'data' =>  $modelSecondData),
        )
    )
));
?>