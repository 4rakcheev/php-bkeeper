<?php

class m140601_154003_init extends CDbMigration
{
    public function up()
    {
        $this->createTable('account', array(
                'account_id' => 'pk',
                'account_name' => 'varchar(50) NOT NULL',
                'account_description' => 'varchar(255) DEFAULT NULL',
                'currency_id' => 'int not null',
                'account_start_balance' => 'bigint(20) DEFAULT 0',
            ));
        $this->createTable('article', array(
                'article_id' => 'pk',
                'article_name' => 'varchar(50) NOT NULL',
                'article_group_id' => 'int DEFAULT NULL',
            ));
        $this->createTable('article_group', array(
                'article_group_id' => 'pk',
                'article_group_name' => 'varchar(50) NOT NULL',
            ));
        $this->createTable('budget_plan', array(
                'budget_plan_id' => 'pk',
                'article_id' => 'int not null',
                'budget_plan_year' => 'int not null',
                'budget_plan_yan' => 'bigint(20) NOT NULL DEFAULT 0',
                'budget_plan_feb' => 'bigint(20) NOT NULL DEFAULT 0',
                'budget_plan_mar' => 'bigint(20) NOT NULL DEFAULT 0',
                'budget_plan_apr' => 'bigint(20) NOT NULL DEFAULT 0',
                'budget_plan_may' => 'bigint(20) NOT NULL DEFAULT 0',
                'budget_plan_jun' => 'bigint(20) NOT NULL DEFAULT 0',
                'budget_plan_jul' => 'bigint(20) NOT NULL DEFAULT 0',
                'budget_plan_aug' => 'bigint(20) NOT NULL DEFAULT 0',
                'budget_plan_sep' => 'bigint(20) NOT NULL DEFAULT 0',
                'budget_plan_oct' => 'bigint(20) NOT NULL DEFAULT 0',
                'budget_plan_nov' => 'bigint(20) NOT NULL DEFAULT 0',
                'budget_plan_dec' => 'bigint(20) NOT NULL DEFAULT 0',
            ));
        $this->createTable('currency', array(
                'currency_id' => 'pk',
                'currency_name' => 'varchar(50) NOT NULL',
                'currency_symbol' => 'varchar(4) NOT NULL',
            ));
        $this->createTable('debt', array(
                'debt_id' => 'pk',
                'account_id' => 'int not null',
                'debt_limit_date' => 'date NOT NULL',
            ));
        $this->createTable('transaction', array(
                'transaction_id' => 'pk',
                'transaction_type' => 'enum("TRANSFER", "COMING", "EXPENSE") not null',
                'transaction_status' => 'smallint(1) NOT NULL DEFAULT 1',
                'transaction_date' => 'date NOT NULL',
                'account_id_debet' => 'int DEFAULT NULL',
                'account_id_credit' => 'int DEFAULT NULL',
                'transaction_amount' => 'bigint(20) NOT NULL DEFAULT 0',
                'article_id' => 'int DEFAULT NULL',
                'transaction_description' => 'varchar(255) DEFAULT NULL',
            ));

        $this->addForeignKey('FK_transaction_debet_account_account_id', 'transaction', 'account_id_debet', 'account', 'account_id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('FK_transaction_credit_account_account_id', 'transaction', 'account_id_credit', 'account', 'account_id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('FK_transaction_article_id_article_article_id', 'transaction', 'article_id', 'article', 'article_id', 'SET NULL', 'CASCADE');

        $this->addForeignKey('FK_article_article_group_id_article_group_article_group_id', 'article', 'article_group_id', 'article_group', 'article_group_id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('FK_budget_plan_article_id_article_article_id', 'budget_plan', 'article_id', 'article', 'article_id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_account_account_id_currency_currency_id', 'account', 'account_id', 'currency', 'currency_id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_account_account_id_debt_debt_id', 'account', 'account_id', 'debt', 'debt_id', 'CASCADE', 'CASCADE');

        $this->insert('currency', array('currency_name' => 'RUB', 'currency_symbol' => 'р.'));
    }

    public function down()
    {
        echo "m140601_154003_init does not support migration down.\n";
        return false;
    }

}
