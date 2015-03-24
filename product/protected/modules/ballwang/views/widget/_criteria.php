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
    echo '<h1>'.$this->actionMessage.'</h1>';
    echo '<br>';
    if ($model->siteCategory) {
        echo $form->checkBoxListInlineRow($model, 'siteCategorySelect', $model->siteCategory);
    }
    if ($model->priority) {
        echo $form->checkBoxListInlineRow($model, 'prioritySelect', $model->priority);
    }
    echo '</div>';
    echo $form->textAreaRow($model,'siteContent', array('class'=>'span8', 'rows'=>5));
	
	echo '<span style="margin-left: 85px;">例如:www.a.com,www.b.com,www.c.com;网站前面带有www.</span><br></br>';
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
    ?>
    <?php
    $this->widget('bootstrap.widgets.BootTabbable', array(
        'type' => 'tabs',
        'placement' => 'above', // 'above', 'right', 'below' or 'left'
        'tabs' => array(
            array('label' => '批量处理excel导入', 'content' => $this->renderPartial('../widget/input', '', TRUE), 'active' => true),
            array('label' => '模糊处理excel导入', 'content' => $this->renderPartial('../widget/inputLike', '', TRUE)),
            array('label' => 'SQL语句使用', 'content' => $this->renderPartial('../widget/inputSql', '', TRUE)),
        ),
        'htmlOptions' => array(
            'style' => 'width: 700px;margin-left: 83px;margin-top: 20px;',
        )
    ));
    
    ?>
    
    <?php
    $this->endWidget();
    ?>
</div>

<script>
    $('#siteSearch').click(function(){
        $('#siteShow').slideToggle("slow");
        $('#categoryShow').slideToggle("slow");
    });
</script>