<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon"/>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css"
          media="screen, projection"/>
    <![endif]-->

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>


<div class="container" id="page">
    <div class="row">
        <!-- mainmenu -->
        <div class="span12">
            <div class="container" id="main-menu">
                <?php $this->widget('bootstrap.widgets.TbNavbar', array(
                        'type' => 'null', // null or 'inverse'
                        'brand' => 'bKeeper',
                        'brandUrl' => '/',
                        'collapse' => true,
                        'items' => array(

                            array(
                                'class' => 'bootstrap.widgets.TbMenu',
                                'htmlOptions' => array('class' => 'pull-left'),
                                'items' => array(
                                    array('label' => 'Главная', 'url' => array('/main/index'), 'visible' => Yii::app()->user->isGuest),
                                ),
                            ),

                            array(
                                'class' => 'bootstrap.widgets.TbMenu',
                                'htmlOptions' => array('class' => 'pull-left'),
                                'items' => array(
                                    array('label' => 'Бюджет', 'url' => array('/budgetPlan/index'), 'visible' => Yii::app()->user->isGuest),
                                ),
                            ),

                            array(
                                'class' => 'bootstrap.widgets.TbMenu',
                                'htmlOptions' => array('class' => 'pull-left'),
                                'items' => array(
                                    array('label' => 'Операции', 'url' => array('/transaction/index'), 'visible' => Yii::app()->user->isGuest),
                                ),
                            ),

                            array(
                                'class' => 'bootstrap.widgets.TbMenu',
                                'htmlOptions' => array('class' => 'pull-left'),
                                'items' => array(
                                    array('label' => 'Статьи', 'url' => array('/article/index'), 'visible' => Yii::app()->user->isGuest),
                                ),
                            ),

                            array(
                                'class' => 'bootstrap.widgets.TbMenu',
                                'htmlOptions' => array('class' => 'pull-left'),
                                'items' => array(
                                    array('label' => 'Цели', 'url' => array('/articleTarget/index'), 'visible' => Yii::app()->user->isGuest),
                                ),
                            ),

                            array(
                                'class' => 'bootstrap.widgets.TbMenu',
                                'htmlOptions' => array('class' => 'pull-left'),
                                'items' => array(
                                    array('label' => 'Счета', 'url' => array('/account/index'), 'visible' => Yii::app()->user->isGuest),
                                ),
                            ),

                        ),
                    )); ?>

            </div>
        </div>
    </div>
    <!-- mainmenu -->

    <div class="row">

        <div class="span3">
            <!--Sidebar content-->
            <div style="margin-top:80px" id="sidebar">
                <?php if (property_exists($this, 'sidebar')): ?>
                <?php $this->widget('bootstrap.widgets.TbMenu', array(
                        'type'=>'list',
                        'items'=>$this->sidebar,
                    )); ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="span9">
            <!--Body content-->
            <div class="container" style="margin-top:80px" id="content">

                <!-- content -->
                <?php $this->widget('bootstrap.widgets.TbAlert', array(
                        'block'=>true, // display a larger alert block?
                        'fade'=>true, // use transitions?
                        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
                        'alerts'=>array( // configurations per alert type
                            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
                            'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),
                            'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),
                            'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),
                            'danger'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),
                        ),
                    )); ?>

                <?php echo $content; ?>
                <!-- content -->

                <!-- footer -->
                <hr/>
                <div id="footer">
                    &copy; <?php echo date('Y'); ?> <a href="#">.tema</a><br/>
                </div>
                <!-- footer -->
            </div>
            <!--Body content-->
        </div>
    </div>

</div>
<!-- page -->
</body>
</html>
