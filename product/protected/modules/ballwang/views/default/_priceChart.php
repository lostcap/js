<?php
$categoryArray = array();
$price['美元']=3;
$price['欧元']=3;
$price['英镑']=30;

foreach ($price as $key => $value) {
    $categoryArray[] = $key;
    $modelFirstData[] = $value;
}

echo '########';

$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options' => array(
        'title' => array('text' => 'you'),
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
            'title' => array('text' => 'work')
        ),
        'series' => array(
            array('name' => 'ksiise', 'data' => $modelFirstData),
        //  array('name' => $modelSecond['stepChartName'], 'data' =>  $modelSecondData),
        )
    )
));

echo '########@@@@@@@@';
?>