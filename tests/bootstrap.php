<?php

#error_reporting("E_ALL");
#ini_set("display_errors", "On");

chdir(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..');
$yiit = 'common' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Yii' . DIRECTORY_SEPARATOR . 'yiit.php';
require_once($yiit);

$config = require('common' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php');
Yii::createWebApplication($config);


