<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META SECTION -->
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/theme-default.css"/>
    <!-- EOF CSS INCLUDE -->
</head>
<body>
<!-- START PAGE CONTAINER -->
<div class="page-container">

<!-- START PAGE SIDEBAR -->
<div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <?php
    $this->widget('zii.widgets.CMenu', array(
            'encodeLabel'=>false,
            'htmlOptions'=>array('class'=>'x-navigation'),
            'activateParents'=>true,
            'items'=>array(
                // Logo
                array(
                    'label'=>'Atlant',
                    'url'=>'/',
                    'itemOptions'=>array('class'=>'xn-logo'),
                    'template'=>'{menu}<a href="#" class="x-navigation-control"></a>',
                ),
                // Profile
                array(
                    'label'=>'<img src="'.Yii::app()->theme->baseUrl.'/images/avatar.jpg" alt="John Doe"/>',
                    'url'=>'#',
                    'itemOptions'=>array('class'=>'xn-profile'),
                    'linkOptions'=>array('class'=>'profile-mini'),
                    'template'=>'{menu}<div class="profile">
                        <div class="profile-image">
                            <img src="'.Yii::app()->theme->baseUrl.'/images/avatar.jpg" alt="John Doe"/>
                        </div>
                        <div class="profile-data">
                            <div class="profile-data-name">John Doe</div>
                            <div class="profile-data-title">Web Developer/Designer</div>
                        </div>
                        <div class="profile-controls">
                            <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                            <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                        </div>
                    </div>',
                ),

                // Operation part
                array('label'=>'Операции', 'url'=>null, 'itemOptions'=>array('class'=>'xn-title'),),
                array(
                    'label'=>'<span class="fa fa-area-chart"></span> <span class="xn-text">Итог</span>',
                    'url'=>array('main/index'),
                ),
                array(
                    'label'=>'<span class="fa fa-barcode"></span> <span class="xn-text">Операции</span>',
                    'url'=>array('transaction/index'),
                ),
                array(
                    'label'=>'<span class="fa fa-calculator"></span> <span class="xn-text">Бюджет</span>',
                    'url'=>array('budgetPlan/index'),
                ),
                array(
                    'label'=>'<span class="fa fa-flag"></span> <span class="xn-text">Цели</span>',
                    'url'=>array('articleTarget/index'),
                ),

                // Settings part
                array('label'=>'Структура', 'url'=>null, 'itemOptions'=>array('class'=>'xn-title')),
                array(
                    'label'=>'<span class="fa fa-money"></span> <span class="xn-text">Счета</span>',
                    'url'=>array('account/index'),
                ),
                array(
                    'label'=>'<span class="fa fa-credit-card"></span> <span class="xn-text">Управление статьями</span>',
                    'url'=>'#',
                    'itemOptions'=>array('class'=>'xn-openable'),
                    'items'=>array(
                        array(
                            'label'=>'<span class="fa fa-credit-card"></span> <span class="xn-text">Статьи</span>',
                            'url'=>array('article/index'),
                        ),
                        array(
                            'label'=>'<span class="fa fa-inbox"></span> <span class="xn-text">Группы счетов</span>',
                            'url'=>array('articleGroup/index'),
                        ),
                    ),
                ),
                array(
                    'label'=>'<span class="fa fa-rub"></span> <span class="xn-text">Валюта</span>',
                    'url'=>array('currency/index'),
                ),

            ),
        ));
    ?>
    <!-- END X-NAVIGATION -->
</div>
<!-- END PAGE SIDEBAR -->

<!-- PAGE CONTENT -->
<div class="page-content">

<!-- START X-NAVIGATION VERTICAL -->
<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
    <!-- TOGGLE NAVIGATION -->
    <li class="xn-icon-button">
        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
    </li>
    <!-- END TOGGLE NAVIGATION -->
    <!-- POWER OFF -->
    <li class="xn-icon-button pull-right last">
        <a href="#"><span class="fa fa-power-off"></span></a>
        <ul class="xn-drop-left animated zoomIn">
            <li><a href="pages-lock-screen.html"><span class="fa fa-lock"></span> Lock Screen</a></li>
            <li><a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Sign Out</a></li>
        </ul>
    </li>
    <!-- END POWER OFF -->
</ul>
<!-- END X-NAVIGATION VERTICAL -->

<!-- START BREADCRUMB -->
    <?php if(isset($this->breadcrumbs)):?>
      <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'tagName'=>'ul',
                'separator'=>'',
                'htmlOptions'=>array('class'=>'breadcrumb'),
                'inactiveLinkTemplate'=>'<li class="active">{label}</li>',
                'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
                'links'=>$this->breadcrumbs,
                'homeLink'=>'<li>'.CHtml::link('Главная','/' ).'</li>',
      )); ?>
    <?php endif?>
    <!--
    <ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">Dashboard</li>
</ul>
-->
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

</div>
<!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
            <div class="mb-content">
                <p>Are you sure you want to log out?</p>
                <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a href="pages-login.html" class="btn btn-success btn-lg">Yes</a>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MESSAGE BOX-->

<!-- START SCRIPTS -->
<!-- START PLUGINS -->
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/bootstrap/bootstrap.min.js"></script>
<!-- END PLUGINS -->

<!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src='<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/scrolltotop/scrolltopcontrol.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/morris/morris.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/rickshaw/d3.v3.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/rickshaw/rickshaw.min.js"></script>
<script type='text/javascript' src='<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/bootstrap/bootstrap-datepicker.js'></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/owl/owl.carousel.min.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/daterangepicker/daterangepicker.js"></script>
<!-- END THIS PAGE PLUGINS-->

<!-- START TEMPLATE -->
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/settings.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/actions.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/demo_dashboard.js"></script>
<!-- END TEMPLATE -->
<!-- END SCRIPTS -->
</body>
</html>






