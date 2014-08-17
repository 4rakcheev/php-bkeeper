<?php

class m140817_164301_drop_column_budget_plan extends CDbMigration
{
    public function safeUp()
    {
        $this->dropColumn('budget_plan', 'budget_plan_year');
    }

    public function safeDown()
    {
        $this->addColumn('budget_plan', 'budget_plan_year', 'int not null');
    }
}
