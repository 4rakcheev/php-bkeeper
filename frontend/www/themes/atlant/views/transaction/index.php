<div class="container">
    <?php
    $this->widget('frontend.extensions.widgets.YearMonthPager', array(
            'urlRoute'=>'transaction/index',
            'dateVar'=>'date',
        ));
    ?>
</div>

<div class="container">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Add new transaction',
            'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'large', // null, 'large', 'small' or 'mini'
            'url'=>array('create'),
        )); ?>
</div>

<div class="container">
<?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$gridDataProvider,
        'template'=>"{items}\n{pager}",
        'columns'=>array(
            array('name'=>'transaction_id', 'header'=>'#'),
            array('name'=>'transaction_type', 'header'=>'Type'),
            array('name'=>'transaction_status', 'header'=>'Status'),
            array('name'=>'transaction_amount', 'header'=>'Amount'),
            array('name'=>'transaction_date', 'header'=>'Date'),
            array('name'=>'accountIdDebet.account_name', 'header'=>'Debet'),
            array('name'=>'accountIdCredit.account_name', 'header'=>'Credit'),
            array('name'=>'article.article_name', 'header'=>'Article'),
            array('name'=>'transaction_description', 'header'=>'Description'),
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
        'label'=>'Add new transaction',
        'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>array('create'),
    )); ?>
</div>
