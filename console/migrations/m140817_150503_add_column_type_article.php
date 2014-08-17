<?php

class m140817_150503_add_column_type_article extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('article', 'article_type', 'enum("COMING", "EXPENSE") not null');
    }

    public function safeDown()
    {
        $this->dropColumn('article', 'article_type');
    }
}
