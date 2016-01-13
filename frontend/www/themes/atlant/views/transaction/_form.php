
<div class="col-md-6">
    <?php
    $form=$this->beginWidget('frontend.extensions.widgets.AtlantActiveForm',array(
            'id'=>'transaction-form',
            'enableAjaxValidation'=>false,
            'enableClientValidation'=>false,
            'type'=>AtlantActiveForm::TYPE_ALANT,
            'focus'=>array($model,'transaction_amount'),
            'htmlOptions'=>array('class'=>'form-horizontal'),
        )); ?>
    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title"><strong><?php echo Yii::t(Transaction::I8LN_CAT, $model->isNewRecord ? 'Добавление' : 'Обновление') ?></strong> <?php echo Yii::t(Transaction::I8LN_CAT, 'операции') ?></h3>
        </div>

        <div class="panel-body">

            <?php echo $form->errorSummary($model); ?>

            <div class="row">
                <div class="block">

                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title"></h3>
                                </div>
                                <div class="panel-body">
                                    <p>
                                        <?php echo $form->dropDownListRow(
                                            $model,
                                            'transaction_type',
                                            TransactionEnum::getDataForDropDown()
                                        ); ?>
                                    </p>
                                    <p>
                                    <?php echo $form->textDateFieldRow($model, 'transaction_date',
                                        array(
                                            'dateOptions'=>array(
                                                'format'=>DateMonthHelper::getDateFormat(DateMonthHelper::DFT_JS),
                                                //'viewmode'=>'months',
                                                //'date'=>$model->transaction_date
                                            ),
                                        )); ?>
                                    </p>

                                    <p>
                                    <?php echo $form->checkboxRow($model, 'transaction_status'); ?>
                                    </p>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title"></h3>
                                </div>
                                <div class="panel-body">
                                    <?php echo $form->dropDownListRow(
                                        $model,
                                        'account_id_credit',
                                        CHtml::listData( Account::model()->findAll(), 'account_id','account_name' )
                                    ); ?>

                                    <?php echo $form->dropDownListRow(
                                        $model,
                                        'account_id_debet',
                                        CHtml::listData( Account::model()->findAll(), 'account_id','account_name' )
                                    ); ?>

                                    <?php echo $form->dropDownListRow(
                                        $model,
                                        'article_id',
                                        CHtml::listData( Article::model()->findAll(), 'article_id','article_name' )
                                    ); ?>
                                </div>

                            </div>
                        </div>

                        <?php echo $form->textFieldRow($model, 'transaction_amount',
                            array(
                                'widgetOptions'=>array(
                                    'prependText'=>Currency::RUB_SYMBOL_HTML,
                                    'appendText'=>'.00',
                                ),
                                'labelOptions'=>array(
                                    //'class'=>'col-md-8 control-label',
                                ),
                            )); ?>


                        <?php echo $form->textFieldRow($model, 'transaction_description',
                            array(
                                'placeholder'=>Yii::t(Transaction::I8LN_CAT, 'Описание'),
                            )); ?>





                    </div>

                </div>
            </div>
        </div>
        <div class="panel-footer">
            <?php echo CHtml::submitButton(
                $model->isNewRecord ? 'Создать' : 'Сохранить',
                array('class'=>'btn btn-primary')
            ); ?>
            <?php echo CHtml::submitButton(
                'Отмена',
                array('class'=>'btn btn-default')
            ); ?>
        </div>

    </div>
    <?php $this->endWidget(); ?>
</div>
