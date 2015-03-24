<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
        <div class="container" id="page" style="width: 300px;">
            <div id="header">
                <div id="logo"> </div>
            </div><!-- header -->

            <br>
                
                <?php echo $content; ?>

                <div class="clear"></div>

                <div id="footer" style="clear: both;text-align: center;">
                    Copyright &copy; <?php echo date('Y'); ?> by Ballwang.<br/>
                    南京联嵌 All Rights Reserved.<br/>
                    <?php echo Yii::powered(); ?>
                </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
