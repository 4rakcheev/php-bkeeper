<?php

class m140817_145119_fix_fk_account_currency extends CDbMigration
{
    public function up()
    {
        $this->dropForeignKey('FK_account_account_id_currency_currency_id', 'account');
        $this->addForeignKey('FK_account_account_id_currency_currency_id', 'account', 'currency_id', 'currency', 'currency_id', 'RESTRICT', 'RESTRICT');

        $this->dropForeignKey('FK_account_account_id_debt_debt_id', 'account');
        $this->addForeignKey('FK_account_account_id_debt_debt_id', 'debt', 'account_id', 'account', 'account_id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        echo "m140817_145119_fix_fk_account_currency does not support migration down.\n";
        return false;
    }

}
