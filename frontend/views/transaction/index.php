
<div class="container">
<?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$gridDataProvider,
        'template'=>"{items}",
        'columns'=>array(
            array('name'=>'transaction_id', 'header'=>'#'),
            array('name'=>'transaction_type', 'header'=>'Name'),
            array('name'=>'transaction_status', 'header'=>'Description'),
            array('name'=>'account_start_balance', 'header'=>'Start balance'),
            array('name'=>'currency.currency_name', 'header'=>'Currency'),
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
        'label'=>'Add new account',
        'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>array('create'),
    )); ?>
</div>
