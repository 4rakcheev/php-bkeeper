<?php

/**
 * This is the model class for table "account".
 *
 * The followings are the available columns in table 'account':
 * @property integer $account_id
 * @property string $account_name
 * @property string $account_description
 * @property integer $currency_id
 * @property string $account_start_balance
 *
 * The followings are the available model relations:
 * @property Debt $account
 * @property Transaction[] $transactions
 * @property Transaction[] $transactions1
 */
class Account extends CActiveRecord
{
    private $_balance;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'account';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('account_name, currency_id', 'required'),
            array('currency_id', 'numerical', 'integerOnly' => true),
            array('account_name', 'length', 'max' => 50),
            array('account_description', 'length', 'max' => 255),
            array('account_start_balance', 'length', 'max' => 20),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'account_id, account_name, account_description, currency_id, account_start_balance',
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
            'account' => array(self::BELONGS_TO, 'Debt', 'account_id'),
            'transactions' => array(
                self::HAS_MANY,
                'Transaction',
                'account_id_credit'
            ),
            'transactions1' => array(
                self::HAS_MANY,
                'Transaction',
                'account_id_debet'
            ),
            'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'account_id' => 'Account',
            'account_name' => 'Account Name',
            'account_description' => 'Account Description',
            'currency_id' => 'Currency',
            'account_start_balance' => 'Account Start Balance',
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

        $criteria->compare('account_id', $this->account_id);
        $criteria->compare('account_name', $this->account_name, true);
        $criteria->compare(
            'account_description',
            $this->account_description,
            true
        );
        $criteria->compare('currency_id', $this->currency_id);
        $criteria->compare(
            'account_start_balance',
            $this->account_start_balance,
            true
        );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Возвращает баланс счета на дату
     * @param null $date
     * @return int
     */
    public function getBalance($date=null)
    {
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        if (!empty($this->_balance)) {
            return $this->_balance;
        }
        $connection = Yii::app()->connMan->getConn('dbMySQL');
        $ret = $connection->query('getAccountBalanceInfo', array(
                'account_id' => $this->account_id,
                'date' => $date,
            ));
        if (!$ret[0]) {
            return 0;
        }
        $balInfo = $ret[1];
        return $balInfo['start_balance'] + $balInfo['coming'] - $balInfo['expense'];
    }

    /**
     * Возвращает общий баланс всех счетов
     *
     * @param null $date
     * @return int
     */
    public function getTotalBalance($date=null)
    {
        $accountList = Account::model()->findAll();
        if (empty($accountList)) {
            return 0;
        }
        $total_balance = 0;
        foreach ($accountList as $account) {
            $total_balance += $account->getBalance($date);
        }
        return $total_balance;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Account the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
