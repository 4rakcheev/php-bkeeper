<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 08.06.14
 * Time: 13:29
 */

class ArticleForm extends CFormModel {

    public $article_id;
    public $article_name;
    public $article_group_id;

    /**
     * Model rules
     * @return array
     */
    public function rules() {
        return array(
            array('article_id, article_name', 'required'),
        );
    }

    /**
     * Returns attribute labels
     * @return array
     */
    public function attributeLabels() {
        return array(
            'article_group_id' => Yii::t('labels', 'Группа'),
            'article_name' => Yii::t('labels', 'Название статьи'),
        );
    }

    public function add()
    {
        $article = new Article();
        $article->article_name = $this->article_name;
        $article->article_group_id = $this->article_group_id;
        return $article->save();
    }

    public function update()
    {
        $article = Article::model()->findByPk($this->article_id);
        $article->article_name = $this->article_name;
        $article->article_group_id = $this->article_group_id;
        return $article->save();
    }
} 
