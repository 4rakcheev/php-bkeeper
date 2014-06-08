<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'verticalForm',
        'htmlOptions'=>array('class'=>'well'),
    )); ?>


<?php echo $form->textFieldRow($model, 'article_name', array('class'=>'span3')); ?>
<?php echo $form->textFieldRow($model, 'article_group_id', array('class'=>'span3')); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Save')); ?>

<?php $this->endWidget(); ?>
