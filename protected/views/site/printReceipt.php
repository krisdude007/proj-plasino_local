<html dir="ltr">
<head>
<title><?php echo Yii::t('youtoo', 'Print Product Receipt'); ?></title>
<style>
    @media print
{
    * {-webkit-print-color-adjust:exact;}
}
</style>
</head>
<body onload="window.print();" style="border: 1px solid #2d2926; width: 980px; margin: 0 auto;"><!--onload='window.print()'-->
<table style="border: 1px solid #8B0B0A; background-image: url('/webassets/images/receiptBG.png'); width: 100%">
<tbody>
<tr>
<td valign='top' width="350" style="color: #df9721;">
<h1 style='margin-bottom: 0; margin-right: 50px;'><?php echo Yii::t('youtoo', 'Baldini\'s Casino'); ?></h1>
<div><?php echo Yii::t('youtoo', '865 S Rock Blvd, Sparks, NV 89431, United States'); ?></div>
</td>
<td valign='top' style="text-align: right; margin-right: 10px; margin-top: 20px;" width="350">
<img src='/webassets/images/logo-blank.png'>
</td>

</tr>
<tr><td colspan="2"><h1 style='margin-bottom: 0;color: #df9721; text-align: center; '><?php echo Yii::t('youtoo', 'Store Receipt'); ?> #<?php echo $creditTransaction->id; ?></h1></td>
</tr>
</tbody>
</table>
<div>&nbsp;</div>
<table width='100%' style='margin:0 auto;'>
<tr>
<td valign='top'>
<!--<h2 style='margin-bottom: 0'><?php //echo Yii::t('youtoo', 'Cash Receipt'); ?></h2>-->
<!--    <div style="position: relative; top: 10px; right: 150px; float: right;"><img src="<?php //echo "/userimages/".$prize->image?>" style="width: 100px;"/></div>-->
<?php if ($user->first_name != '' && $user->last_name != ''): ?>
<div><strong><?php echo Yii::t('youtoo', 'Name'); ?>:</strong> <?php echo $user->first_name; ?> <?php echo $user->last_name; ?></div>
<?php endif; ?>
<div><strong><?php echo Yii::t('youtoo', 'Email'); ?>:</strong> <?php echo $user->username; ?></div
<div><strong><?php echo Yii::t('youtoo', 'Address'); ?>:</strong>
 <?php echo $user->userLocations[0]->address1; ?><?php echo $user->userLocations[0]->address2; ?>,
<?php echo $user->userLocations[0]->city; //.", ".$user->userLocations[0]->state." ".$user->userLocations[0]->postal_code;      ?>
    <?php echo $user->userLocations[0]->state; ?>,
    <?php echo $user->userLocations[0]->postal_code; ?>
 <?php echo $user->userLocations[0]->country; ?></div>
<div>&nbsp;</div>
<div><strong><?php echo Yii::t('youtoo', 'User ID'); ?>:</strong> <?php echo $user->id; ?></div>
<div><strong><?php echo Yii::t('youtoo', 'Transaction ID'); ?>:</strong> <?php echo $creditTransaction->id; ?></div>
 <div><strong><?php echo Yii::t('youtoo', 'Payment Type'); ?>: </strong><?php if (isset($creditTransaction->type) == 'spent') {
     echo 'Credits';
 } else {
     echo 'Stripe';
 } ?>
</div>
<div><strong><?php echo Yii::t('youtoo', 'Date of Receipt'); ?>:</strong> <?php echo $creditTransaction->created_on; ?></div>
</td>
</tr>
</table>
<div>&nbsp;</div>
<table width='100%' style="margin:0 auto; border: 1px solid #df9721;">
<tr style='background-color: #DDDDDD'>
<th style='text-align: center'><?php echo Yii::t('youtoo', 'Line Item'); ?></th>
<th style='text-align: center'><?php echo Yii::t('youtoo', 'Item ID'); ?></th>
<th style='text-align: center'><?php echo Yii::t('youtoo', 'Item Name'); ?></th>
<th style='text-align: center'><?php echo Yii::t('youtoo', 'Item Description'); ?></th>
<th style='text-align: center'><?php echo Yii::t('youtoo', 'Item Image'); ?></th>
<th style='text-align: center'><?php echo Yii::t('youtoo', 'Credits'); ?></th>
<th style='text-align: center'><?php echo Yii::t('youtoo', 'Qty Ordered'); ?></th>
</tr>
<tr>
<td valign='top' style='text-align: center'>
1
</td>
<td valign='top' style='text-align: center'>
<?php
echo $prize->id;
?>
</td>
<td valign='top' style='text-align: center'>
<?php
echo $prize->name;
?>
</td>
<td valign='top' style='text-align: center'>
<?php
echo $prize->description;
?>
</td>
<td valign='top' style='text-align: center'>
<img src="
<?php
echo "/userimages/".$prize->image;
?>" style="width: 50px;" />
</td>
<td valign='top' style='text-align: center'>
<?php
echo $prize->credits_required;
?>
</td>
<td valign='top' style='text-align: center'>                                       1
</td>
</tr>
</table>
</body>
</html>

<div style="margin: 20px 0px 20px 0px; text-align: center;">
    <img src="<?php echo "/barcode/{$creditTransaction->id}"; ?>"/>
</div>