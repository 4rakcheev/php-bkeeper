<?php

$this->sidebar=array(
    array('label'=>'Назад', 'icon'=>'backward', 'url'=>array('index')),
);
?>

<h1>View Currency #<?php echo $model->currency_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
        'data'=>$model,
        'attributes'=>array(
            'currency_id',
            'currency_name',
            'currency_symbol',
        ),
    )); ?>
