<?php
$data = $model['data'];
$categoryArray = array();
$categoryDataArray = array();
if ($data) {
    foreach ($data as $key => $value) {
        $categoryArray[] = $key;
        $categoryDataArray[] = (int) $value;
    }
}
$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options' => array(
        'title' => array('text' => $model['stepChartName']),
        'xAxis' => array(
            'categories' => $categoryArray,
            'labels' => array(
                'rotation' => -45,
                'align' => 'right',
                'style' => array(
                    'font' => 'normal 13px Verdana, sans-serif',
            )),
            'title' => array('text' => $model['xName']),
        ),
        'yAxis' => array(
            'min' => 0,
            'title' => array('text' => $model['yName'])
        ),
        'legend' => array(
            'enabled' => false,
        ),
        'tooltip' => array(
            'formatter' => 'js:function() {
            return \'<b>\'+ this.x +\'</b>\'+
                \': \'+this.y +
                \'\';
          
      }'),
        'series' => array(
            array(
                'type' => 'column',
                'data' => $categoryDataArray,
                'dataLabels' => array(
                    'enabled' => true,
                    'rotation' => 0,
                    'color' => 'green',
                    'align' => 'center',
                    'x' => 2,
                    'y' => -3,
                    'formatter' => 'js:function() {
                         return this.y;
                         }',
                    'style' => array(
                        'font' => 'normal 13px Verdana, sans-serif',
                    ),
                ),
            ),
        )
    )
));
?>



