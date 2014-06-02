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
        $article=Article::model();
        var_dump($article);
        $article->article_name='sadasd';
        var_dump($article->save());
        $article=Article::model()->findByPk(15);
        var_dump($article);
    }

} 
