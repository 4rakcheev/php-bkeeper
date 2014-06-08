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
    <?php $this->widget('bootstrap.widgets.TbNavbar', array(
        'type' => 'null', // null or 'inverse'
        'brand' => 'CommnAPI',
        'brandUrl' => '/',
        'collapse' => true,
        'items' => array(

            array(
                'class' => 'bootstrap.widgets.TbMenu',
                'htmlOptions' => array('class' => 'pull-left'),
                'items' => array(
                    array('label' => 'SMPP',
                        'visible' => Yii::app()->user->isGuest,
                        'url' => '#',
                        'items' => array(
                            array('label' => 'Настройки', 'url' => '/smpp/index'),
                        )
                    ),
                ),
            ),

            array(
                'class' => 'bootstrap.widgets.TbMenu',
                'htmlOptions' => array('class' => 'pull-left'),
                'items' => array(
                    array('label' => 'CC',
                        'visible' => Yii::app()->user->isGuest,
                        'url' => '#',
                        'items' => array(
                            array('label' => 'Настройки', 'url' => '/congestion/index'),
                        )
                    ),
                ),
            ),

            /*
            array(
                'class' => 'bootstrap.widgets.TbMenu',
                'htmlOptions' => array('class' => 'pull-right'),
                'items' => array(
                    array('label' => 'Вход', 'url' => array('/user/login'), 'visible' => Yii::app()->user->isGuest),
                ),
            ),
            */
            /*
            array(
                'class' => 'bootstrap.widgets.TbMenu',
                'htmlOptions' => array('class' => 'pull-right', 'style' => 'font-weight:bold;'),
                'items' => array(
                    array(
                        'label' => (!Yii::app()->user->isGuest) ? Yii::app()->user->name : '',
                        'visible' => !Yii::app()->user->isGuest,
                        'url' => '#',
                        'items' => array(
                            array('label' => 'Выход', 'url' => '/user/logout'),
                        )
                    ),
                ),
            ),
            */
        ),
    )); ?>
    <!-- mainmenu -->

    <div class="container" style="margin-top:80px">

        <?php $this->widget('bootstrap.widgets.TbAlert', array(
            'block'=>true, // display a larger alert block?
            'fade'=>true, // use transitions?
            'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
            'alerts'=>array( // configurations per alert type
                'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
            ),
        )); ?>

        <?php echo $content; ?>

        <hr/>

        <div id="footer">
            &copy; <?php echo date('Y'); ?> <a href="http://www.mtt.ru">MTT</a><br/>
        </div>
        <!-- footer -->
    </div>
</div>
<!-- page -->
</body>
</html>
