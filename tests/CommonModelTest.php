<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 02.06.14
 * Time: 22:09
 */

class CommonModelTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var CActiveRecord[]
     */
    protected static $createdActiveModels;
    protected static $savedData;

    public static function setUpBeforeClass()
    {
        self::$savedData['group'] = array(
                'name'=>'Тестовая группа счетов',
            );
        self::$savedData['article'] = array(
                'name'=>'Тестовый счет',
            );
    }

    public function testArticleGroupModelCRUD()
    {

        // Create article
        $group = new ArticleGroup();
        $group->article_group_name = self::$savedData['group']['name'];
        $status = $group->save();
        $this->assertTrue($status);
        self::$createdActiveModels[] = $group;

        self::$savedData['group']['article_group_id'] = $group->article_group_id;

        // Load model by name
        $article_read = ArticleGroup::model()->findByAttributes(array('article_group_name'=>self::$savedData['group']['name']));
        $this->assertEquals($article_read->article_group_name, self::$savedData['group']['name']);

        // Update test
    }

    /**
     * @depends testArticleGroupModelCRUD
     */
    public function testArticleModelCRUD()
    {
        // Create article
        $article = new Article();
        $article->article_name = self::$savedData['article']['name'];;
        $article->article_group_id = self::$savedData['group']['article_group_id'];
        $status = $article->save();
        $this->assertTrue($status);
        self::$createdActiveModels[] = $article;

    }

    public function testCleanAll()
    {
        if (empty(self::$createdActiveModels)) {
            throw new CException("No model was created");
        }
        foreach (self::$createdActiveModels as $model) {
            $status = $model->delete();
            $this->assertTrue($status);
        }
    }
}
