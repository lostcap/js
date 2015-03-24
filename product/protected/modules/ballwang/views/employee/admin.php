<?php
$this->breadcrumbs = array(
    'Employees' => array('index'),
    'Manage',
);
?>

<h2 >管理 Employees 项目</h2>
<?php
$this->widget('bootstrap.widgets.BootButton', array(
    'label' => '添加管理员',
    'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size' => 'Normal', // '', 'large', 'small' or 'mini'
    'url' => $this->module->ballWang . '/employee/create',
    'htmlOptions' => array(
        'style' => 'float:right',
    ),
));
?>
<br></br>
<?php
$this->widget('bootstrap.widgets.BootGridView', array(
    'id' => 'employee-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'htmlOptions' => array(
        'style' => 'width: 900px;',
    ),
    'columns' => array(
        'employee_ID',
        'employee_name',
        'employee_email',
        //   'employee_passwd',
//    'employee_active',
        array(
            'name' => 'employee_active',
            'value' => '$data->employee_active==1?"激活":"失效"',
            'filter' => array('1' => '激活', '0' => '失效'),
        ),
        array(
            'template' => '{update}{delete}',
            'class' => 'bootstrap.widgets.BootButtonColumn',
        ),
    ),
));
?>
