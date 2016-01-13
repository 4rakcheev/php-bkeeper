<?php

class m141212_124039_account_available_calculate_flag extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('account', 'account_available_calculate_flag', 'TINYINT(1) NOT NULL DEFAULT 1');
    }

    public function safeDown()
    {
        $this->dropColumn('account', 'account_available_calculate_flag');
    }
}
