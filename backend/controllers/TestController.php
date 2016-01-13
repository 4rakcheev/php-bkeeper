<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 08.06.14
 * Time: 13:00
 */

class TestController extends CController {

    public function actionIndex()
    {
        echo '<h1>Test controller action</h1>';
        echo date('Y-m-d'); 
    }

} 
