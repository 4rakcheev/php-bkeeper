<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'verticalForm',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>'well'),
    )); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow(
    $model,
    'article_id',
    CHtml::listData( Article::model()->findAll(), 'article_id','article_name' ),
    array('class'=>'span3')
); ?>
<?php
echo $form->textFieldRow($model, 'budget_plan_yan', array('class'=>'span2'));
?>
<?php
echo $form->textFieldRow($model, 'budget_plan_feb', array('class'=>'span2'));
?>
<?php
echo $form->textFieldRow($model, 'budget_plan_mar', array('class'=>'span2'));
?>
<?php
echo $form->textFieldRow($model, 'budget_plan_apr', array('class'=>'span2'));
?>
<?php
echo $form->textFieldRow($model, 'budget_plan_may', array('class'=>'span2'));
?>
<?php
echo $form->textFieldRow($model, 'budget_plan_jun', array('class'=>'span2'));
?>
<?php
echo $form->textFieldRow($model, 'budget_plan_jul', array('class'=>'span2'));
?>
<?php
echo $form->textFieldRow($model, 'budget_plan_aug', array('class'=>'span2'));
?>
<?php
echo $form->textFieldRow($model, 'budget_plan_sep', array('class'=>'span2'));
?>
<?php
echo $form->textFieldRow($model, 'budget_plan_oct', array('class'=>'span2'));
?>
<?php
echo $form->textFieldRow($model, 'budget_plan_nov', array('class'=>'span2'));
?>
<?php
echo $form->textFieldRow($model, 'budget_plan_dec', array('class'=>'span2'));
?>

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
