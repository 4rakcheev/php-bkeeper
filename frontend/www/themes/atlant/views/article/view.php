<?php

$this->sidebar=array(
    array('label'=>'Назад', 'icon'=>'backward', 'url'=>array('index')),
);
?>

<h1>View Article #<?php echo $model->article_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
        'data'=>$model,
        'attributes'=>array(
            'article_id',
            'article_name',
            'articleGroup.article_group_name',
        ),
    )); ?>
