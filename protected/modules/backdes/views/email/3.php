<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $hostName; ?></title>
</head>
<body>
<table style="font-family:Verdana,sans-serif; font-size:11px; color:#374953; width: 550px;">
    <tr>
        <td align="left">
        </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td align="left"><?php echo Yii::t('default','Dear'); ?> <strong style="color:#DB3484;"><?php echo $name; ?></strong>,</td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td align="left" style="background-color:#DB3484; color:#FFF; font-size: 12px; font-weight:bold; padding: 0.5em 1em;">
            <?php echo Yii::t('default','Your order number'); ?>#<?php echo $order_name; ?> </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td align="left">
            <b>
                <?php echo Yii::t('default','Your order has been sent'); ?>
            </b><br />
                <?php echo Yii::t('default','You can track your order on the following tracking website with the tracking number'); ?><br/>
            <?php echo Yii::t('default','Tracking number'); ?> :<?php echo $shipCode ; ?><br/>
            <?php echo Yii::t('default','Inquiry address'); ?> :<?php echo $trackUrl;?>
        </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td align="left">
            <?php echo Yii::t('default','Any problems, just feel free to contact us'); ?><br/>
            <?php echo Yii::t('default','Service E-mail'); ?>：<?php echo str_replace('www.','service@',$hostName); ?>

<!--
            <?php echo Yii::t('default','If you still have problems, please contact our general service desk mailbox'); ?>：
-->

        </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td align="center" style="font-size:10px; border-top: 1px solid #D9DADE;">
            <a href="<?php echo $hostUrl; ?>" style="color:#DB3484; font-weight:bold; text-decoration:none;"><?php echo $hostName; ?></a>
        </td>
    </tr>
</table>
</body>
</html>

