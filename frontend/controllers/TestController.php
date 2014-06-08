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
        echo '<pre>';

        /*
        $article=new Article();
        //var_dump($article);
        $article->article_name='sadasd';
        var_dump($article->save());
        $article=Article::model()->findAll();
        var_dump($article);
        // */
        $article=new Article();
        //var_dump($article);
        $article->article_name='sadasd';
        var_dump($article->save());

        var_dump($article->delete());
        /*
        $articles = ArticleGroup::model()->deleteAll();
        $article=ArticleGroup::model()->findAll();
        var_dump($article);
            //*/
    }

} 
