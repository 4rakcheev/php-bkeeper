<?php

class m140916_164116_budgetPlan_jan_rename extends CDbMigration
{
    public function safeUp()
    {
        $this->renameColumn('budget_plan', 'budget_plan_yan', 'budget_plan_jan');
    }

    public function safeDown()
    {
        echo "m140916_164116_budgetPlan_jan_rename does not support migration down.\n";
        return false;
    }
}
