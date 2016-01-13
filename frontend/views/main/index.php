<div class="container">
    <?php
    $this->widget('frontend.extensions.widgets.YearMonthPager', array(
            'urlRoute'=>'main/index',
            'dateVar'=>'date',
        ));
    ?>
</div>

<div class="container">
    <table>
        <tr>
            <td colspan="2">
                <h2>Прогноз</h2>
                <?php $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
                        'heading'=>$accountsTotalBalance,
                        'htmlOptions' => array('style'=>'margin-left:20px'),
                        'headingOptions' => array('style'=>'color:green'),
                    )); ?>
                <p>В наличии на текущий момент</p>
                <h1>
                    <span style="color:<?php echo $endAmount >= 0 ? 'green' : 'red' ?>"><?php echo $endAmount; ?></span>
                </h1>
                <p>Остаток на конец месяца</p>
                <?php $this->endWidget(); ?>
            </td>
        </tr>

        <tr>
            <td>
                <h2>Доход</h2>
                <?php $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
                        'heading'=>$budgetPlan->summaryComing->total_plan_amount,
                        'htmlOptions' => array('style'=>'margin-left:20px'),
                    )); ?>
                <p>Ожидаемый доход</p>
                <h1><?php echo $budgetPlan->summaryComing->total_today_amount?></h1>
                <p>Факт</p>
                <?php $this->endWidget(); ?>
            </td>
            <td>
                <h2>Расход</h2>
                <?php $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
                        'heading'=>$budgetPlan->summaryExpense->total_plan_amount,
                        'htmlOptions' => array('style'=>'margin-left:20px'),
                    )); ?>
                <p>Ожидаемый расход</p>
                <h1><?php echo $budgetPlan->summaryExpense->total_today_amount ?></h1>
                <p>Факт</p>
                <?php $this->endWidget(); ?>
            </td>
        </tr>
    </table>
</div>
