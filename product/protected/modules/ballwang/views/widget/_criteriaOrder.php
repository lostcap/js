<style>
    .checkbox{
        margin-left: 0px;
    }
    .inline{  
        width: 200px;
        margin-left: 10px;
    }
</style>
<div>
    <?php
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id' => 'horizontalForm',
                'type' => 'horizontal',
                'htmlOptions' => array('class' => 'well', 'enctype' => 'multipart/form-data'),
            ));
    echo '<div id="categoryShow">';
    echo '<h1>' . $this->actionMessage . '</h1>';
    echo '<p> '.$message.'</p>';
    echo '<br>';
    if ($model->siteCategory) {
        echo $form->checkBoxListInlineRow($model, 'siteCategorySelect', $model->siteCategory);
    }
    if ($model->priority) {
        echo $form->checkBoxListInlineRow($model, 'prioritySelect', $model->priority);
    }
    echo '</div>';
    $this->widget('bootstrap.widgets.BootLabel', array(
        'type' => 'success', // '', 'success', 'warning', 'important', 'info' or 'inverse'
        'label' => '点击切换网站选择',
        'htmlOptions' => array(
            'id' => 'siteSearch',
            'style' => 'margin-left: 85px;',
        )
    ));
    if ($model->siteSearch) {
        echo '<div class="siteSearch" id="siteShow" style="display: none">';
        echo $form->checkBoxListInlineRow($model, 'siteSearchSelect', $model->siteSearch);
        echo '</div>';
    }
    echo '<br>';
    echo '<div style="width: 700px;margin-left: 83px;margin-top: 20px;">';
    $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'ok white', 'label' => '确定提交'));
    echo '</div>';
    $this->endWidget();
    ?>
</div>

<script>
    $('#siteSearch').click(function(){
        $('#siteShow').slideToggle("slow");
        $('#categoryShow').slideToggle("slow");
    });
</script>