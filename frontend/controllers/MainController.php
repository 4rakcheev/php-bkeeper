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

        // @todo Refactor
        if ($date < date('Y-m')) {
            $dateAccount=date('Y-m-01', strtotime($date));
        }
        else {
            $dateAccount=date('Y-m-d');
        }
        $this->render('index',array(
                'budgetPlan'=>$budgetPlan,
                'accountsTotalBalance'=>Account::model()->getTotalBalance($dateAccount),
                'endAmount'=>$budgetPlan->getAmountAtTheEnd(),
            ));

    }

}
