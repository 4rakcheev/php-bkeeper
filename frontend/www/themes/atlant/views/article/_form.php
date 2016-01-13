<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'verticalForm',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>'well'),
    )); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'article_name', array('class'=>'span3')); ?>

<?php echo $form->dropDownListRow(
    $model,
    'article_group_id',
    CHtml::listData( ArticleGroup::model()->findAll(),'article_group_id','article_group_name' ),
    array('empty'=>'', 'class'=>'span3')
); ?>

<?php echo $form->dropDownListRow(
    $model,
    'article_type',
    ArticleEnum::getDataForDropDown(),
    array('class'=>'span3')
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
