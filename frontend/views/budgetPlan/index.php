<?php
if ($overrun > 0) {
  $this->sidebar=array(
    array('label'=>"Учесть перерасход ($overrun)", 'icon'=>'ok', 'url'=>array('budgetPlan/applyOverrun')),
  );
}
?>

<div class="container">
    <?php
    $this->widget('frontend.extensions.widgets.YearMonthPager', array(
            'urlRoute'=>'budgetPlan/index',
            'dateVar'=>'date',
        ));
    ?>
</div>

<?php
$this->widget('bootstrap.widgets.TbAlert');
?>

<div class="container">
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'budget_plan_id',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$expGridDataProvider,
            'template'=>"{items}\n{pager}",
            'columns'=>array(
                array('name'=>'budget_plan_id', 'header'=>'#'),
                array('name'=>'article_name', 'header'=>'Article name'),
                array('name'=>'budget_plan_amount', 'header'=>'Ожидается'),
                array('name'=>'budget_today_amount', 'header'=>'Факт'),
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                    'viewButtonUrl'=>'Yii::app()->controller->createUrl("view",array("id"=>$data["budget_plan_id"]))',
                    'updateButtonUrl'=>'Yii::app()->controller->createUrl("update",array("id"=>$data["budget_plan_id"]))',
                    'deleteButtonUrl'=>'Yii::app()->controller->createUrl("delete",array("id"=>$data["budget_plan_id"]))',
                ),
            ),
        ));
    ?>
    <div class="container">
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
                'type'=>'striped bordered condensed',
                'dataProvider'=>$comGridDataProvider,
                'template'=>"{items}\n{pager}",
                'columns'=>array(
                    array('name'=>'budget_plan_id', 'header'=>'#'),
                    array('name'=>'article_name', 'header'=>'Article name'),
                    array('name'=>'budget_plan_amount', 'header'=>'Ожидается'),
                    array('name'=>'budget_today_amount', 'header'=>'Факт'),
                    array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'htmlOptions'=>array('style'=>'width: 50px'),
                        'viewButtonUrl'=>'Yii::app()->controller->createUrl("view",array("id"=>$data["budget_plan_id"]))',
                        'updateButtonUrl'=>'Yii::app()->controller->createUrl("update",array("id"=>$data["budget_plan_id"]))',
                        'deleteButtonUrl'=>'Yii::app()->controller->createUrl("delete",array("id"=>$data["budget_plan_id"]))',
                    ),
                ),
            ));
        ?>
</div>
<div class="container">
<?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Add new plan record',
        'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>array('create'),
    )); ?>
</div>
