<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 02.06.14
 * Time: 22:36
 */

class ArticleGroup extends CActiveRecord {

    public $article_group_id;
    public $article_group_name;

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function relations()
    {
        return array(
            'articles'=>array(self::HAS_MANY, 'Article', 'article_group_id'),
        );
    }
} 
