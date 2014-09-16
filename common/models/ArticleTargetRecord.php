<?php

/**
 * This is the model class for table "article_target".
 *
 * The followings are the available columns in table 'article_target':
 * @property integer $article_target_id
 * @property integer $article_target_article_id
 * @property string $article_target_date
 * @property integer $article_target_amount
 *
 * The followings are the available model relations:
 * @property Article $articleTargetArticle
 */
class ArticleTargetRecord extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'article_target';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(
                'article_target_article_id, article_target_date, article_target_amount',
                'required'
            ),
            array('article_target_date', 'date', 'format'=>'yyyy-MM-dd'),
            array(
                'article_target_article_id, article_target_amount',
                'numerical',
                'integerOnly' => true
            ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'article_target_id, article_target_article_id, article_target_date, article_target_amount',
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
        return array(
            'article' => array(self::BELONGS_TO, 'Article', 'article_target_article_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'article_target_id' => 'Article Target',
            'article_target_article_id' => 'Article Target Article',
            'article_target_date' => 'Article Target Date',
            'article_target_amount' => 'Article Target Amount',
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

        $criteria->compare('article_target_id', $this->article_target_id);
        $criteria->compare(
            'article_target_article_id',
            $this->article_target_article_id
        );
        $criteria->compare(
            'article_target_date',
            $this->article_target_date,
            true
        );
        $criteria->compare(
            'article_target_amount',
            $this->article_target_amount
        );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ArticleTargetRecord the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    protected function beforeSave()
    {
        if (!parent::beforeSave()) {
            return false;
        }
        if (empty($this->article->budgetPlans)) {

        }
        return true;
    }

    public function getAverageAmount($fromDate=null, $targetedAmount=0)
    {
        if (empty($fromDate)) {
            $fromDate = date('Y-m-d');
        }
        $month_count = DateMonthHelper::getDifferenceMonthCount($fromDate, $this->article_target_date);
        return round(($this->article_target_amount - $targetedAmount) / $month_count);
    }

}
