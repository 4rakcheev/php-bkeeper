<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 11.12.14
 * Time: 22:07
 */

class TransactionDataColumn extends CDataColumn {

    public $expenseTemplate='<span class="label label-warning label-form">{creditArticle}</span>';
    public $transferTemplate='<span class="label label-info label-form">{creditArticle}</span> <i class="fa fa-arrow-right"></i> <span class="label label-info label-form">{debetArticle}</span>';
    public $comingTemplate='<span class="label label-success label-form">{debetArticle}</span>';

    protected function renderDataCellContent($row, $data)
    {
        $value=null;
        switch ($data->transaction_type) {
            case TransactionEnum::TYPE_COMING:
                $value=strtr($this->comingTemplate,array('{debetArticle}'=>$data->accountIdDebet->account_name));
                break;
            case TransactionEnum::TYPE_EXPENSE:
                $value=strtr($this->expenseTemplate,array('{creditArticle}'=>$data->accountIdCredit->account_name));
                break;
            case TransactionEnum::TYPE_TRANSFER:
                $value=strtr($this->transferTemplate,array(
                        '{debetArticle}'=>$data->accountIdDebet->account_name,
                        '{creditArticle}'=>$data->accountIdCredit->account_name,
                    ));
                break;
        }

        echo $value === null ? $this->grid->nullDisplay : $value;
    }

}
