<?php

class m140823_134016_add_ArticleTarget_table extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('article_target', array(
                'article_target_id' => 'pk',
                'article_target_article_id' => 'int NOT NULL',
                'article_target_date' => 'date NOT NULL',
                'article_target_amount' => 'int NOT NULL'
            ));
        $this->addForeignKey('FK_article_target_article_id', 'article_target', 'article_target_article_id', 'article', 'article_id', 'CASCADE', 'CASCADE');
        $this->createIndex('article_target_article_id', 'article_target', 'article_target_article_id', true);
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_article_target_article_id', 'article_target');
        $this->dropTable('article_target');
    }
}
