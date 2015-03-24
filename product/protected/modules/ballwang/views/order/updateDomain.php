<div style="float:left;">
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>

<fieldset>

    <legend><?php echo $model->domain_name;?></legend>
    <?php
    $todayString=strtotime(Date('Y-m-d'));
    $onlineString=strtotime($model->domain_online_time);
    $day=round(($todayString-$onlineString)/3600/24);
    ?>
    <?php echo $form->textFieldRow($model, 'domain_name', array('disabled'=>true)); ?>
    <?php echo $form->textFieldRow($model->support, 'primary_site_name', array('disabled'=>true)); ?>
    <?php echo $form->dropDownListRow($model, 'domain_user',Domain::getDomainUser()); ?>
    <?php echo $form->textFieldRow($model, 'domain_online_time',array('disabled'=>true,'hint'=>'推广已有<span style="color:red;">'.$day.'</span>天！')); ?>
    <!--    <div class="control-group ">
        <label class="control-label">销售额</label>
        <div class="controls"><input disabled="disabled" value="123"></div>
    </div>-->

    <?php echo $form->textAreaRow($model, 'domain_seo_keywords', array('class'=>'', 'rows'=>4)); ?>
    <?php echo $form->textAreaRow($model, 'domain_note_seo', array('class'=>'', 'rows'=>4)); ?>


</fieldset>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'修改')); ?>
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'label'=>'重置')); ?>
</div>

<?php $this->endWidget(); ?>
</div>
<div style="float:left;margin-left: 40px;">
    <fieldset>
        <legend>修改历史</legend>
    </fieldset>
    <?php
    if($historyShow){
        $array['domain_note_seo']='备注';
        $array['domain_user']='负责人';
        $array['domain_seo_keywords']='关键词';
       foreach($historyShow as $key=>$value){
           echo $value['history_made'].'在'.$value['history_time'].'<br>把 '.$array[$value['history_type']].' 内容 “'.$value['history_before'].'”<br>修改为“'.$value['history_after'].'”<br></br>';
       }
    }

?>
</div>