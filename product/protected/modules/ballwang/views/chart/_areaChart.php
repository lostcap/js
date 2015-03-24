<?php
$data = $model['data'];
$categoryArray = array();
$categoryData = array();
$categoryDataArray = array();

if ($data) {
    foreach ($data as $key => $value) {
        $categoryArray[] = $key;
        foreach ($value as $key1 => $value1) {
            $categoryDataArray[$key1]['name'] = $key1;
            $categoryDataArray[$key1]['data'][] = (int)$value1;
        }
    }
}

if ($categoryDataArray) {
    $i=0;
    foreach ($categoryDataArray as $key => $value) {
        $categoryData[$i]['name']=$value['name'];
        $categoryData[$i]['data']=$value['data'];
        $i++;
    }
}

$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options' => array(
        'chart' => array(
            'type' => 'area',
        ),
        'title' => array('text' => $model['stepChartName']),
        'xAxis' => array(
            'categories' => $categoryArray,
            'tickmarkPlacement' => 'on',
            'title' => array(
                'text' => $model['xName'],
                'enabled' => false,
            ),
        ),
        'yAxis' => array(
            'title' => array('text' => $model['yName']),
            
        ),
        'tooltip' => array(
            'formatter' => 'js:function() {
            return \'<b>\'+ this.x +\'</b>\'+
                \': \'+this.y +
                \'\';
      }'),
        'plotOptions' => array(
            'area' => array(
                'stacking' => 'normal',
                'lineColor' => '#666666',
                'lineWidth'=>'0.1',
                'marker' => array(
                    'lineColor' => '#666666',
                    'lineWidth'=>'0.1',
                ),
            )
        ),
        'series' => $categoryData,
    )
));
?>



