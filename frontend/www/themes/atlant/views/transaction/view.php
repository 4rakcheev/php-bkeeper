<?php

$this->sidebar=array(
    array('label'=>'Назад', 'icon'=>'backward', 'url'=>array('index')),
);
?>

<h1>View Transaction #<?php echo $model->transaction_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
        'data'=>$model,
        'attributes'=>array(
            'transaction_id',
            'transaction_type',
            'transaction_status',
            'transaction_amount',
            'accountIdDebet.account_name',
            'accountIdCredit.account_name',
            'article.article_name',
            'transaction_description',
        ),
    )); ?>
