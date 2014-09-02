<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 18.08.14
 * Time: 20:19
 */

class MainController extends CController {

    public $sidebar = array();

    public function actionIndex($date=null)
    {
        if (empty($date)) {
            $date = date('Y-m');
        }
        $budgetPlan = new BudgetPlan();
        $budgetPlan->date = $date;

        $accountsTotalBalance = Account::model()->getTotalBalance(date('Y-m-d', strtotime($date)));

        // @todo Move to BudgetModel
        ///*
        $endAmount =
          $budgetPlan->summaryComing->total_plan_amount
            +
          ($accountsTotalBalance - $budgetPlan->summaryComing->total_today_amount)
            -
          ($budgetPlan->summaryExpense->total_plan_amount - $budgetPlan->summaryExpense->total_today_amount);
         //*/
        // $endAmount = $budgetPlan->summaryComing->total_plan_amount - $budgetPlan->summaryExpense->total_plan_amount;
        $this->render('index',array(
                'budgetPlan'=>$budgetPlan,
                'accountsTotalBalance'=>$accountsTotalBalance,
                'endAmount'=>$endAmount,
            ));

    }

}
