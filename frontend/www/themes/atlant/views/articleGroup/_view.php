<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('article_id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->article_id),array('view','id'=>$data->article_id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('article_name')); ?>:</b>
    <?php echo CHtml::encode($data->article_name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('article_group_id')); ?>:</b>
    <?php echo CHtml::encode($data->article_group_id); ?>
    <br />


</div>
