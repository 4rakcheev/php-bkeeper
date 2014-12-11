<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'verticalForm',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>'well'),
    )); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'account_name', array('class'=>'span4')); ?>
<?php echo $form->textFieldRow($model, 'account_description', array('class'=>'span4')); ?>
<?php echo $form->textFieldRow($model, 'account_start_balance', array('class'=>'span2')); ?>
<?php echo $form->dropDownList(
    $model,
    'currency_id',
    CHtml::listData( Currency::model()->findAll(),'currency_id','currency_name' ),
    array('class'=>'span2')
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
