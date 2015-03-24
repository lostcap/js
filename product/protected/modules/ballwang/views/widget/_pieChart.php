<?php
$data = array();
if ($model['data']) {
    foreach ($model['data'] as $key => $value) {
        $data[] = array($key, (int) $value);
    }
    $this->Widget('ext.highcharts.HighchartsWidget', array(
        'options' => array(
            'title' => array('text' => $model['stepChartName']),
            'tooltip' => array(
                'formatter' => 'js:function() {
            return \'<b>\'+ this.point.name +\'</b>: \'+ this.percentage.toFixed(2) +\' %\';
         }',
            ),
            'plotOptions' => array(
                'pie' => array(
                    'size'=>'50%',
                    'lineWidth'=>1,
                    'allowPointSelect' => true,
                    'cursor' => 'pointer',
                    'dataLabels' => array(
                        'enabled' => true,
                        'formatter' => 'js:function() {
                  return \'<b>\'+ this.point.name +\'</b>: \'+ this.percentage.toFixed(2) +\' %\';
               }',
                    ),
                ),
            ),
           
            'series' => array(
                array(
                    'type' => 'pie',
                    'name' => $model['stepChartName'],
                    'data' => $data
                ),
            ),
        )
    ));
}
?>



