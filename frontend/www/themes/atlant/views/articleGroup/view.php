<?php

$this->sidebar=array(
    array('label'=>'Назад', 'icon'=>'backward', 'url'=>array('index')),
);
?>

<h1>View ArticleGroup #<?php echo $model->article_group_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
        'data'=>$model,
        'attributes'=>array(
            'article_group_id',
            'article_group_name',
        ),
    )); ?>
