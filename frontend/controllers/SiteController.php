<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 02.06.14
 * Time: 22:32
 */

class SiteController extends CController {

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error) {
            switch ($error['code']) {
                case 400:
                case 403:
                case 404:
                case 500:
                case 503:
                    $this->render('error'.$error['code'], array('data'=>$error));
                break;
                default:
                    $this->render('error', array('data'=>$error));
            }
        }
    }

} 
