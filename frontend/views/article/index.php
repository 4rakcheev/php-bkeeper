
<?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Add new article',
        'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>'article/add',
    )); ?>

<?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$gridDataProvider,
        'template'=>"{items}",
        'columns'=>array(
            array('name'=>'article_id', 'header'=>'#'),
            array('name'=>'article_name', 'header'=>'Name'),
            array('name'=>'article_group', 'header'=>'Group'),
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'htmlOptions'=>array('style'=>'width: 50px'),
            ),
        ),
    ));
?>
