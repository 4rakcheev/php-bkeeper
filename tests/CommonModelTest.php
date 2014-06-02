<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 02.06.14
 * Time: 22:09
 */

class CommonModelTest extends PHPUnit_Framework_TestCase
{

    public function testArticleGroupModelCRUD()
    {
        $name = 'Тестовая группа счетов';

        // Create article
        $article = ArticleGroup::model();
        $article->name = $name;
        $status = $article->save();
        $this->assertEquals($status, true);

        // Load model
        $article_read = ArticleGroup::model()->findByName($name);
        $this->assertNotEmpty($article_read);

        // Update test
    }

    public function testArticleModelCRUD()
    {
        // Create article
        $article = Article::model();
        $article->name = 'Тестовый счет';
        $status = $article->save();
        $this->assertEquals($status, true);


    }

}
