
<div class="container">
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'budget_plan_id',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$expGridDataProvider,
            'template'=>"{items}",
            'columns'=>array(
                array('name'=>'budget_plan_id', 'header'=>'#'),
                array('name'=>'article_name', 'header'=>'Article name'),
                array('name'=>'budget_plan_amount', 'header'=>'Ожидается'),
                array('name'=>'budget_today_amount', 'header'=>'Факт'),
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                ),
            ),
        ));
    ?>
    <div class="container">
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
                'type'=>'striped bordered condensed',
                'dataProvider'=>$comGridDataProvider,
                'template'=>"{items}",
                'columns'=>array(
                    array('name'=>'budget_plan_id', 'header'=>'#'),
                    array('name'=>'article_name', 'header'=>'Article name'),
                    array('name'=>'budget_plan_amount', 'header'=>'Ожидается'),
                    array('name'=>'budget_today_amount', 'header'=>'Факт'),
                    array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'htmlOptions'=>array('style'=>'width: 50px'),
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
