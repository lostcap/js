<?php
$data = $model['data'];
$refundOrder = $model['data']['refundOrderNum'];
$data = array();

foreach ($refundOrder as $key => $value) {
    $dataShowCategory = $key;
    foreach ($dateCategory as $key1 => $value1) {
        $dataShowData[] = (int)$value[$value1];
    }
    $data[] = array('name' => $dataShowCategory, 'data' => $dataShowData);
}

$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options' => array(
        'chart' => array(
            'type' => 'spline',
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
                    'text' => '退单个数',
                ),
                'labels' => array(
                    'formatter' => 'js:function() { return this.value +\' 单\';}',
                    'style' => array('color' => '#4572A7'),
                ),
            ),
        ),
        'tooltip' => array(
            array(
                'formatter' => 'js:function() {
                        return \'<b>\'+ this.series.name +\'</b><br/>\'+
                        this.x +\': \'+ this.y +\'单\';
                }'
            ),
        ),
        'series' => $data,
    )
));
?>

