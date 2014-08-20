<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 18.08.14
 * Time: 20:06
 */

class BudgetPlanSummary extends CModel {

    public $article_id;
    public $month;
    public $plan_amount=0;
    public $today_amount=0;

    public function attributeNames()
    {
        return array('article_id', 'month', 'plan_amount', 'today_amount');
    }

}
