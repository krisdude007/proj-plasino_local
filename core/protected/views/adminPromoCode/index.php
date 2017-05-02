<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery-ui-1.10.0.css');

$cs = Yii::app()->clientScript;
$cs->registerCssFile('/core/webassets/css/adminAffidavit/index.css');
$cs->registerScriptFile('/core/webassets/js/jquery.dataTables.min.js', CClientScript::POS_END);
$cs->registerCssFile('/core/webassets/css/jquery.dataTables_themeroller.css');
$cs->registerScriptFile('/core/webassets/js/adminAffidavit/index.js', CClientScript::POS_END);
$this->renderPartial('/admin/_csrfToken');
?>

<div class="fab-page-content">
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <?php
  $flashMessages = Yii::app()->user->getFlashes();
  if ($flashMessages) {
    $messageFormat = '<div class="flashes"><div class="flash-%s">%s</div></div>';
    foreach ($flashMessages as $key => $message) {
      echo sprintf($messageFormat, $key, $message);
    }
  }
  ?>

    <div id="fab-top">
        <h4 class="fab-title"><img class="floatLeft marginRight10" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/dashboard-icon.png"/>Promo Code Admin</h4>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- BEGIN PAGE CONTAINER-->
    <div class="fab-container-fluid">
        <!-- BEGIN PAGE HEADER-->

        <!-- END PAGE HEADER-->
        <div id="fab-dashboard">
            <div style="padding:0px 20px 0px 20px;">
                <div>
                    <h2>Create/Edit Promo Code:</h2>
                    <?php
                    $arr = array(
                        'promo' => $promo,
                        'promos' => $promos,
                        //'userPermissions' => $userPermissions,
                        //'permissions' => $permissions,
                    );

                    $this->renderPartial('_formPromoCode', $arr);
                    ?>
                    <?php //var_dump($programs);exit; ?>
                </div>
                <?php if (isset(Yii::app()->params['promocode']['showPromoCodeData']) && Yii::app()->params['promocode']['showPromoCodeData'] == true): ?>

                <div style="padding-top:40px;clear:both;">
                    <h2>Edit Promo Code:</h2>
                    <div style="margin-bottom:20px">
                        Click on the column title to sort by that column.<br>
                        Click on any Promo Code to edit them.
                    </div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'admin-promocode-grid',
    'dataProvider' => $promos->search(),
    'filter' => $promos,
    'columns' => array(
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("/adminPromoCode/index", array("id"=>$data->id))',
                ),
            ),
        ),
        'freecredit_key',
        'freecredit_price',
        'start_date',
        'end_date',
        'user_email',
        'code_used_by',
        array(
            'class' => 'CButtonColumn',
            'template' => '{delete}',
            'buttons' => array(
                'delete' => array(
                    //'click'=>'function(){alert("Delete button");}',
                    'url' => 'Yii::app()->createUrl("/adminPromoCode/delete", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));
?>


                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTAINER-->
</div>
    <!-- VIDEO UPLOAD OVERLAY -->
            <?php
            $this->renderPartial('/adminPromoCode/_overlayPromoCode', array(
                'formPromo' => $formPromo,
                    )
            );
            ?>
    <!-- VIDEO UPLOAD OVERLAY -->
