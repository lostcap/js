<?php $this->beginContent('/layouts/main1'); ?>
<div id="content" style="margin-top: 100px;">
    <?php Site::bootstrap($this->message); ?>
    <?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>