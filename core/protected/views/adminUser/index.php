<?php
$cs = Yii::app()->clientScript;
$cs->registerScriptFile('/core/webassets/js/adminUser/index.js', CClientScript::POS_END);
$cs->registerCssFile('/core/webassets/css/adminUser/index.css');
$cs->registerScriptFile('/core/webassets/js/jquery.dataTables.min.js', CClientScript::POS_END);
$cs->registerCssFile('/core/webassets/css/jquery.dataTables_themeroller.css');
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
    <h2 class="fab-title"><img class="floatLeft marginRight10" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/dashboard-icon.png"/>User Administration</h2>
  </div>
  <!-- END PAGE TITLE & BREADCRUMB-->
  <!-- BEGIN PAGE CONTAINER-->
  <div class="fab-container-fluid">
    <!-- BEGIN PAGE HEADER-->

    <!-- END PAGE HEADER-->
    <div id="fab-dashboard">
      <div style="padding:0px 20px 0px 20px;">
        <div>
            <?php if(Yii::app()->user->isSuperAdmin()): ?>
          <div style="margin: -10px 0px 30px 0px;">
            <a style='color: #000000;' target='_blank' href="/admin/loginreport">User Login Report</a>
        </div>
          <?php endif; ?>
          <h2>Create/Edit User:</h2>
          <?php

          $arr = array(
              'user' => $user,
              'userEmail' => $userEmail,
              'userPhoto' => $userPhoto,
              'userLocation' => $userLocation,
              'userPermissions' => $userPermissions,
              'permissions' => $permissions,

          );

          if (Yii::app()->params['enableUserFunctionality']) {
          $arr['imageId'] = $imageId;
          }

          $this->renderPartial('_formUser', $arr);
          ?>

        </div>
        <div style="padding-top:40px;clear:both;">
          <h2>Edit Users:</h2>
          <div style="margin-bottom:20px">
            Click on the column title to sort by that column.<br>
            Click on any user to edit them.
          </div>

          <?php
          $this->widget('zii.widgets.grid.CGridView', array(
              'id' => 'admin-user-grid',
              'dataProvider' => $users->search(),
              'filter' => $users,
              'columns'=>array(
                  array(
                      'class' => 'CButtonColumn',
                      'template'=>'{view}',
                      'buttons'=>array(
                        'view' => array(
                          'url'=>'Yii::app()->createUrl("/adminUser/index", array("id"=>$data->id))',
                        ),
                    ),
                  ),
                  'username',
                  array(
                      'name' => 'role',
                      'value' => 'CHtml::encode($data->role)',
                      'filter'=> array('super admin' => 'super admin',
                                'site admin'=>'site admin',
                                'producer admin'=>'producer admin',
                                'user' => 'user'
                      ),
                  ),
                  array(
                      'name' => 'userPermissions',
                      'type' => 'raw',
                      'filter'=>array('Yes'=>'Yes',
                                'No'=>'No',
                      ),
                  ),
                  'first_name',
                  'last_name',
                  array(
                      'name' => 'userEmails.email',
                      'type' => 'raw',
                      'value' => 'isset($data->userEmails[0]->email)? $data->userEmails[0]->email : ""',
                      'filter'=>CHtml::activeTextField($users,'email'),
                  ),
              ),
          ));

          ?>

        </div>
      </div>
    </div>
  </div>
  <!-- END PAGE CONTAINER-->
</div>