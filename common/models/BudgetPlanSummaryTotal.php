<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 18.08.14
 * Time: 20:06
 */

class BudgetPlanSummaryTotal extends CModel {

    public $month;
    public $total_plan_amount=0;
    public $total_today_amount=0;

    public function attributeNames()
    {
        return array('month', 'total_plan_amount', 'total_today_amount');
    }

}
