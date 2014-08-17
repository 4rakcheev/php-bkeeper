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
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'transaction';
    }

    public function init()
    {
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
        );
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
            'transaction_id' => 'Transaction',
            'transaction_type' => 'Transaction Type',
            'transaction_status' => 'Transaction Status',
            'transaction_date' => 'Transaction Date',
            'account_id_debet' => 'Account Id Debet',
            'account_id_credit' => 'Account Id Credit',
            'transaction_amount' => 'Transaction Amount',
            'article_id' => 'Article',
            'transaction_description' => 'Transaction Description',
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
