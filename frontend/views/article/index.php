
<?php
$this->sidebar=array(
    array('label'=>'Редактировать группы', 'icon'=>'pencil', 'url'=>array('articleGroup/index')),
);
?>

<div class="container">
<?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$gridDataProvider,
        'template'=>"{items}\n{pager}",
        'columns'=>array(
            array('name'=>'article_id', 'header'=>'#'),
            array('name'=>'article_name', 'header'=>'Name'),
            array('name'=>'articleGroup.article_group_name', 'header'=>'Group'),
            array('name'=>'article_type', 'header'=>'Type'),
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
        'label'=>'Add new article',
        'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>array('create'),
    )); ?>
</div>
