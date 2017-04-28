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
        <h4 class="fab-title"><img class="floatLeft marginRight10" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/dashboard-icon.png"/>Affidavit Reports</h4>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- BEGIN PAGE CONTAINER-->
    <div class="fab-container-fluid">
        <!-- BEGIN PAGE HEADER-->

        <!-- END PAGE HEADER-->
        <div id="fab-dashboard">
            <div style="padding:0px 20px 0px 20px;">
                <h4><a class="floatLeft" id="fab-affidavit-reportbymonth-button" style="font-weight: 700; font-size: 14px; min-width: 130px; min-height: 30px;" href=""><img src="/webassets/images/Excel-icon.png" style="width: 25px;"/> Report By Month</a></h4>
                <br/>
                <br/>
                <h4><a class="floatLeft" id="fab-affidavit-reportbystation-button" style="font-weight: 700; font-size: 14px; min-width: 130px; min-height: 30px;" href=""><img src="/webassets/images/Excel-icon.png" style="width: 25px;"/> Report By Station</a></h4>
                <br/>
                <br/>
                <h4><a class="floatLeft" id="fab-affidavit-reportbymonthandstation-button" style="font-weight: 700; font-size: 14px; min-width: 130px; min-height: 30px;" href=""><img src="/webassets/images/Excel-icon.png" style="width: 25px;"/> Report By Month And Station</a></h4>
                <br/>
                <br/>
                <a class="floatLeft" style="font-weight: 700; font-size: 14px; min-width: 130px; min-height: 30px;margin-top: 10px;" href="/adminAffidavitReport/getreportall"><img src="/webassets/images/Excel-icon.png" style="width: 25px;"/> Get Complete Report</a>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<?php
            $this->renderPartial('/adminAffidavitReport/_overlayAffidavitReportByMonth', array(
                'formProgramMonth' => $formProgramMonth,
                    )
            );
            ?>
<?php
            $this->renderPartial('/adminAffidavitReport/_overlayAffidavitReportByStation', array(

                    )
            );
            ?>
<?php
            $this->renderPartial('/adminAffidavitReport/_overlayAffidavitReportByMonthAndStation', array(
                'formProgramMonth' => $formProgramMonth,
                    )
            );
            ?>