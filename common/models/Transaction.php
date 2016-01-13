<?php

/**
 * This is the model class for table "transaction".
 *
 * The followings are the available columns in table 'transaction':
 * @property integer $transaction_id
 * @property string $transaction_type
 * @property integer $transaction_status
 * @property string $transaction_date
 * @property integer $account_id_debet
 * @property integer $account_id_credit
 * @property string $transaction_amount
 * @property integer $article_id
 * @property string $transaction_description
 *
 * The followings are the available model relations:
 * @property Article $article
 * @property Account $accountIdCredit
 * @property Account $accountIdDebet
 */
class Transaction extends CActiveRecord
{
    const I8LN_CAT='strings';

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'transaction';
    }

    public function init()
    {
        parent::init();
        $this->transaction_date = date('Y-m-d');
        $this->transaction_type = TransactionEnum::TYPE_EXPENSE;
        $this->transaction_status = 1;
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('transaction_type, transaction_date', 'required'),
            array(
                'transaction_status, account_id_debet, account_id_credit, article_id',
                'numerical',
                'integerOnly' => true
            ),
            array('transaction_type', 'length', 'max' => 8),
            array('transaction_amount', 'length', 'max' => 20),
            array('transaction_description', 'length', 'max' => 255),
            array('transaction_type', 'in', 'range'=>TransactionEnum::getValidValues()),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'transaction_id, transaction_type, transaction_status, transaction_date, account_id_debet, account_id_credit, transaction_amount, article_id, transaction_description',
                'safe',
                'on' => 'search'
            ),
            array('transaction_type', 'typeValidate'),
        );
    }

    public function typeValidate($attribute)
    {
        $value = $this->{$attribute};
        switch ($value) {
            case TransactionEnum::TYPE_EXPENSE:
                if (!empty($this->account_id_debet)) {
                    $this->addError($attribute, 'Debet account must be empty for '.TransactionEnum::TYPE_EXPENSE.' type');
                }
                if (empty($this->account_id_credit)) {
                    $this->addError($attribute, 'Credit account must be set for '.TransactionEnum::TYPE_EXPENSE.' type');
                }
                break;
            case TransactionEnum::TYPE_COMING:
                if (!empty($this->account_id_credit)) {
                    $this->addError($attribute, 'Credit account must be empty for '.TransactionEnum::TYPE_COMING.' type');
                }
                if (empty($this->account_id_debet)) {
                    $this->addError($attribute, 'Debet account must be set for '.TransactionEnum::TYPE_COMING.' type');
                }
                break;
            case TransactionEnum::TYPE_TRANSFER:
                if (empty($this->account_id_credit) || empty($this->account_id_debet)) {
                    $this->addError($attribute, 'Credit and Debet account must be set for '.TransactionEnum::TYPE_TRANSFER.' type');
                }
                if (!empty($this->article)) {
                    $this->addError($attribute, 'Article cannot be set for '.TransactionEnum::TYPE_TRANSFER.' type');
                }
                break;
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'article' => array(self::BELONGS_TO, 'Article', 'article_id'),
            'accountIdCredit' => array(
                self::BELONGS_TO,
                'Account',
                'account_id_credit'
            ),
            'accountIdDebet' => array(
                self::BELONGS_TO,
                'Account',
                'account_id_debet'
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'transaction_id' => Yii::t(self::I8LN_CAT, 'Transaction'),
            'transaction_type' => Yii::t(self::I8LN_CAT, 'Тип операции'),
            'transaction_status' => Yii::t(self::I8LN_CAT, 'Состояние'),
            'transaction_date' => Yii::t(self::I8LN_CAT, 'Дата операции'),
            'account_id_debet' => Yii::t(self::I8LN_CAT, 'Дебет'),
            'account_id_credit' => Yii::t(self::I8LN_CAT, 'Кредит'),
            'transaction_amount' => Yii::t(self::I8LN_CAT, 'Сумма'),
            'article_id' => Yii::t(self::I8LN_CAT, 'Статья'),
            'transaction_description' => Yii::t(self::I8LN_CAT, 'Описание'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('transaction_id', $this->transaction_id);
        $criteria->compare('transaction_type', $this->transaction_type, true);
        $criteria->compare('transaction_status', $this->transaction_status);
        $criteria->compare('transaction_date', $this->transaction_date, true);
        $criteria->compare('account_id_debet', $this->account_id_debet);
        $criteria->compare('account_id_credit', $this->account_id_credit);
        $criteria->compare(
            'transaction_amount',
            $this->transaction_amount,
            true
        );
        $criteria->compare('article_id', $this->article_id);
        $criteria->compare(
            'transaction_description',
            $this->transaction_description,
            true
        );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Transaction the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
