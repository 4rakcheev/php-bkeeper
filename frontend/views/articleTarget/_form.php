<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'verticalForm',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>'well'),
    )); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'article_target_date', array('class'=>'span3')); ?>

<?php echo $form->textFieldRow($model, 'article_target_amount', array('class'=>'span3')); ?>

<?php echo $form->dropDownListRow(
    $model,
    'article_target_article_id',
    CHtml::listData( Article::model()->findAll(),'article_id','article_name' ),
    array('empty'=>'', 'class'=>'span3')
); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'type'=>'primary',
                'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
            )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'link',
                'label'=>'Отмена',
                'url'=>array('index'),
            )); ?>
    </div>

<?php $this->endWidget(); ?>
