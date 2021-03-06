<?php
$cs = Yii::app()->clientScript;
$cs->registerScriptFile('/core/webassets/js/adminEntity/index.js', CClientScript::POS_END);
$cs->registerCssFile('/core/webassets/css/adminEntity/index.css');
$cs->registerScriptFile('/core/webassets/js/jquery.dataTables.min.js', CClientScript::POS_END);
$cs->registerCssFile('/core/webassets/css/jquery.dataTables_themeroller.css');
$this->renderPartial('/admin/_csrfToken');
?>

<div class="fab-page-content">
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <div id="fab-top">
        <?php if(Yii::app()->params['entityContestant']): ?>
        <h2 class="fab-title"><img class="floatLeft marginRight10" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/dashboard-icon.png"/>Contestant Editor</h2>
        <?php else: ?>
        <h2 class="fab-title"><img class="floatLeft marginRight10" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/dashboard-icon.png"/>Advertiser Editor</h2>
        <?php endif; ?>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- BEGIN PAGE CONTAINER-->
    <div class="fab-container-fluid">
        <!-- BEGIN PAGE HEADER-->

        <!-- END PAGE HEADER-->
        <div id="fab-dashboard">
            <div style="padding:0px 20px 0px 20px;">
                <div>
                    <?php if(Yii::app()->params['entityContestant']): ?>
                    <h2>Create New Contestant:</h2>
                    <?php else: ?>
                    <h2>Create New Advertiser:</h2>
                    <?php endif; ?>
                    <div class="form">
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'admin-entity-form',
                            'enableAjaxValidation' => true,
                            'htmlOptions' => array('enctype' => 'multipart/form-data'),
                                ));
                        ?>
                        <?php echo $form->errorSummary($entity); ?>
                        <div class="clearfix">
                            <?php echo $form->labelEx($entity, 'type'); ?>
                            <?php echo $form->textField($entity, 'type'); ?>
                            <?php echo $form->error($entity, 'type'); ?>
                        </div>
                        <div class="clearfix">
                            <?php echo $form->labelEx($entity, 'name'); ?>
                            <?php echo $form->textField($entity, 'name'); ?>
                            <?php echo $form->error($entity, 'name'); ?>
                        </div>
                        <div class="clearfix">
                            <?php echo $form->labelEx($entity, 'link'); ?>
                            <?php echo $form->textField($entity, 'link'); ?>
                            <?php echo $form->error($entity, 'link'); ?>
                        </div>
                        <div class="clearfix">
                            <?php echo $form->labelEx($twitter, 'twitter_user_id'); ?>
                            <?php echo $form->textField($twitter, 'twitter_user_id'); ?>
                            <?php echo $form->error($twitter, 'twitter_user_id'); ?>
                        </div>
                        <div class="clearfix">
                            <?php echo $form->labelEx($facebook, 'facebook_page_id'); ?>
                            <?php echo $form->textField($facebook, 'facebook_page_id'); ?>
                            <?php echo $form->error($facebook, 'facebook_page_id'); ?>
                        </div>
                        <div class="clearfix">
                            <?php echo $form->labelEx($entity, 'description'); ?>
                            <?php echo $form->textArea($entity, 'description'); ?>
                            <?php echo $form->error($entity, 'description'); ?>
                        </div>
                        <div>
                            <?php echo $form->labelEx($image, 'image'); ?>
                            <?php foreach($entity->images as $k=>$v): ?>
                            <a href="#" class="ajaxSetEntityAvatar" rel="<?php echo $entity->id; ?>" rev="<?php echo $v->id; ?>">
                                <img class="<?php echo ($v->is_avatar) ? 'avatar' : ''; ?>" style='height:60px;width:60px;border:1px solid black;margin-left:5px;' src="<?php echo Yii::app()->params['paths']['image'].'/'.$v->filename; ?>"></img>
                            </a>
                            <?php endforeach; ?>
                            <br />
                            <?php if(Yii::app()->params['entityContestant']): ?>
                            Click on an avatar to set it as the default avatar for the contestant, or upload a new avatar: <br>
                            <?php else: ?>
                            Click on an avatar to set it as the default avatar for the advertiser, or upload a new avatar: <br>
                            <?php endif; ?>
                            <?php echo $form->fileField($image, 'image'); ?>
                            <?php echo $form->error($image, 'image'); ?>
                        </div>
                        <div class="clearfix" style="margin-top:20px">
                            <?php echo CHtml::submitButton('Submit'); ?>
                            <?php echo CHtml::Button('Clear',Array('onclick'=>'window.location = "/admin/entity"')); ?>
                        </div>

                        <?php $this->endWidget(); ?>

                    </div>

                </div>
                <div style="margin-top:40px;">
                   <?php if(Yii::app()->params['entityContestant']): ?>
                    <h2>Edit Contestant:</h2>
                    <?php else: ?>
                    <h2>Edit Advertiser:</h2>
                    <?php endif; ?>
                    <div style="margin-bottom:20px">
                        <?php if(Yii::app()->params['entityContestant']): ?>
                        Click on the column title to sort by that column.<br>
                        Click on the contestant image or name to edit it.<br>
                        Click on the contestant link to preview that link.<br>
                        <?php else: ?>
                        Click on the column title to sort by that column.<br>
                        Click on the advertiser image or name to edit it.<br>
                        Click on the advertiser link to preview that link.<br>
                        <?php endif; ?>
                    </div>
                    <table id="entityTable">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Type</th>
                                <th style="width:80px">Image</th>
                                <th>Name</th>
                                <th>Link</th>
                                <th>Description</th>
                                <th>Twitter User Id</th>
                                <th>Facebook Page Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rowFormat = "
                                <tr>
                                    <td style='text-align:center;width:50px' class='%s'>
                                        <button type='button' class='setEntityState' rel='%s' rev='%s'>%s</button>
                                    </td>
                                    <td>%s</td>
                                    <td><a href='/admin/entity/%s'><img style='height:60px;width:60px;border:1px solid white;margin-left:5px;' src='%s' /></a></td>
                                    <td><a href='/admin/entity/%s'>%s</a></td>
                                    <td><a href='%s' target='_blank'>%s</a></td>
                                    <td>%s</td>
                                    <td>%s</td>
                                    <td>%s</td>
                                </tr>
                            ";
                            foreach ($entities as $k => $v) {
                                echo sprintf($rowFormat,
                                    ($v->active == 1) ? 'active' : 'inactive',
                                    $v->id,($v->active == 1) ? 0 : 1,($v->active == 1) ? 'deactivate' : 'activate',
                                    $v->type,
                                    $v->id,
                                    isset($v->images[0]) ? Yii::app()->params['paths']['image'].'/'.$v->images[0]->filename : '',
                                    $v->id, $v->name,
                                    $v->link, $v->link,
                                    $v->description,
                                    !empty($v['entityTwitters'][0]->twitter_user_id)?$v['entityTwitters'][0]->twitter_user_id:'',
                                    !empty($v['entityFacebooks'][0]->facebook_page_id)?$v['entityFacebooks'][0]->facebook_page_id:''
                                );
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTAINER-->
</div>