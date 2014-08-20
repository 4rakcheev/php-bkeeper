<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 18.08.14
 * Time: 20:19
 */

class MainController extends CController {

    public $sidebar = array();

    public function actionIndex()
    {
        $budgetPlan = new BudgetPlan();
        $budgetPlan->date = date('Y-m-d');

        $accountsTotalBalance = Account::model()->getTotalBalance();

        // @todo Move to BudgetModel
        $endAmount = $accountsTotalBalance + $budgetPlan->summaryExpense->total_today_amount - $budgetPlan->summaryExpense->total_plan_amount;

        $this->render('index',array(
                'budgetPlan'=>$budgetPlan,
                'accountsTotalBalance'=>$accountsTotalBalance,
                'endAmount'=>$endAmount,
            ));

    }

}
