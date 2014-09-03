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

        $this->render('index',array(
                'budgetPlan'=>$budgetPlan,
                'accountsTotalBalance'=>Account::model()->getTotalBalance(date('Y-m-d', strtotime($date))),
                'endAmount'=>$budgetPlan->getAmountAtTheEnd(),
            ));

    }

}
