<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 02.06.14
 * Time: 22:33
 */

class Article extends CActiveRecord {

    public $article_id;
    public $article_name;
    public $article_group_id;

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'article';
    }

    public function relations()
    {
        return array(
            'article_group' => array(self::BELONGS_TO, 'ArticleGroup', 'article_group_id'),
        );
    }

}
