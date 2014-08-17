<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'verticalForm',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>'well'),
    )); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->radioButtonListInlineRow($model, 'transaction_type',
    TransactionEnum::getDataForRadioButtonList()
); ?>

<?php
echo $form->textFieldRow($model, 'transaction_date', array('class'=>'span4'));
?>
<fieldset>
    <legend> </legend>

<?php echo $form->dropDownListRow(
    $model,
    'account_id_debet',
    CHtml::listData( Account::model()->findAll(), 'account_id','account_name' ),
    array('empty'=>'', 'class'=>'span3')
); ?>
<?php echo $form->dropDownListRow(
    $model,
    'account_id_credit',
    CHtml::listData( Account::model()->findAll(), 'account_id','account_name' ),
    array('empty'=>'', 'class'=>'span3')
); ?>
<?php echo $form->dropDownListRow(
    $model,
    'article_id',
    CHtml::listData( Article::model()->findAll(), 'article_id','article_name' ),
    array('empty'=>'', 'class'=>'span3')
); ?>
    </fieldset>
<fieldset>
    <legend> </legend>

<?php
echo $form->textFieldRow($model, 'transaction_description', array('class'=>'span4'));
?>
<?php
echo $form->textFieldRow($model, 'transaction_amount', array('class'=>'span4'));
?>
<?php echo $form->checkboxRow($model, 'transaction_status'); ?>
</fieldset>

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
