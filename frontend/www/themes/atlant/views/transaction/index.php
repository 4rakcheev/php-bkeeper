<?php
$this->breadcrumbs=array(
    Yii::t('strings', 'Операции')=>array('transaction/index'),
);
?>
<?php
$this->actionMenuItems=array(
    array(
        'label'=>'<span class="fa fa-plus-square"></span>',
        'url'=>array('create'),
        'itemOptions'=>array('class'=>'xn-icon-button', 'title'=>Yii::t('strings', 'Добавить новую операцию')),
    ),
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('strings', 'Отчет операций'); ?></h3>
        <?php $this->widget('frontend.extensions.widgets.YearMonthPager', array(
            'urlRoute'=>'transaction/index',
            'dateVar'=>'date',
            'skin'=>'atlant',
        )); ?>
    </div>
    <div class="panel-body">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider'=>$gridDataProvider,
            'skin'=>'atlant-action',
            'pager'=>array(
                'class'=>'CLinkPager',
                'header' => '',
                'footer' => '',
                'htmlOptions' => array('class' => 'pagination pagination-sm pull-left',),
                'selectedPageCssClass'=>'active',
            ),
            'rowCssClassExpression'=>function ($row, $data) {
                  switch ($data->transaction_type) {
                      case TransactionEnum::TYPE_COMING:
                           return 'success';
                      case TransactionEnum::TYPE_EXPENSE:
                          return 'warning';
                      case TransactionEnum::TYPE_TRANSFER:
                          return 'info';
                      default:
                          return '';
                  }
              },
            'columns'=>array(
                array('name'=>'transaction_date', 'header'=>'Date'),
                array('name'=>'transaction_amount', 'header'=>'Amount'),
                array(
                    'name'=>'transaction_type',
                    'class'=>'frontend.extensions.widgets.TransactionDataColumn',
                ),
                array('name'=>'article.article_name', 'header'=>'Article'),
                array('name'=>'transaction_description', 'header'=>'Description'),
                //array('name'=>'transaction_status', 'header'=>'Status'),
                array(
                    'class'=>'zii.widgets.grid.CButtonColumn',
                    'template'=>'{update} {delete}',
                    'htmlOptions'=>array('class'=>''),
                    'updateButtonOptions'=>array(
                        'class'=>'btn btn-default btn-rounded btn-condensed btn-sm',
                        'title'=>Yii::t('strings', 'Редактировать'),
                    ),
                    'updateButtonImageUrl'=>false,
                    'updateButtonLabel'=>'<span class="fa fa-pencil"></span>',
                    'deleteButtonOptions'=>array(
                        'class'=>'btn btn-danger btn-rounded btn-condensed btn-sm',
                        'title'=>Yii::t('strings', 'Удалить'),
                    ),
                    'deleteButtonImageUrl'=>false,
                    'deleteButtonLabel'=>'<span class="fa fa-times"></span>',
                ),
            ),
        )); ?>
    </div>
    <div class="panel-footer">
    </div>
</div>

