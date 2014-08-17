<?php

$this->sidebar=array(
    array('label'=>'Назад', 'icon'=>'backward', 'url'=>array('index')),
);
?>

<h1>View ArticleGroup #<?php echo $model->account_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
        'data'=>$model,
        'attributes'=>array(
            'account_id',
            'account_name',
            'account_description',
            'account_start_balance',
            'currency.currency_name',
        ),
    )); ?>
