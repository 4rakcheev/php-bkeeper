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

        $this->render('index',array(
                'budgetPlan'=>$budgetPlan,
            ));

    }

}
