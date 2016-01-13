<?php
    $this->sidebar=array(
        array('label'=>'Статьи', 'icon'=>'backward', 'url'=>array('article/index')),
    );
?>

<div class="container">
<?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$gridDataProvider,
        'template'=>"{items}\n{pager}",
        'columns'=>array(
            array('name'=>'article_target_id', 'header'=>'#'),
            array('name'=>'article.article_name', 'header'=>'Article'),
            array('name'=>'article_target_amount', 'header'=>'Amount'),
            array('name'=>'article_target_date', 'header'=>'Date'),
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
        'label'=>'Add new target',
        'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>array('create'),
    )); ?>
</div>
