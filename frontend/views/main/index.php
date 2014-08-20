<div class="container pull-right">
    <?php $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
            'heading'=>$budgetPlan->summaryComing->total_plan_amount,
        )); ?>
    <p>Ожидаемый доход</p>
    <h1><?php echo $budgetPlan->summaryComing->total_today_amount ?></h1>
    <p>Факт</p>

    <?php $this->endWidget(); ?>
</div>
<div class="container">
    <?php $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
            'heading'=>$budgetPlan->summaryExpense->total_plan_amount,
        )); ?>
    <p>Ожидаемый расход</p>
    <h1><?php echo $budgetPlan->summaryExpense->total_today_amount ?></h1>
    <p>Факт</p>
    <?php $this->endWidget(); ?>
</div>
