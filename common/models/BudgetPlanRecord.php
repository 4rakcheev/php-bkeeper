<?php

/**
 * This is the model class for table "budget_plan".
 *
 * The followings are the available columns in table 'budget_plan':
 * @property integer $budget_plan_id
 * @property integer $article_id
 * @property string $budget_plan_yan
 * @property string $budget_plan_feb
 * @property string $budget_plan_mar
 * @property string $budget_plan_apr
 * @property string $budget_plan_may
 * @property string $budget_plan_jun
 * @property string $budget_plan_jul
 * @property string $budget_plan_aug
 * @property string $budget_plan_sep
 * @property string $budget_plan_oct
 * @property string $budget_plan_nov
 * @property string $budget_plan_dec
 * @property integer $budget_plan_year
 *
 * The followings are the available model relations:
 * @property Article $article
 */
class BudgetPlanRecord extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'budget_plan';
    }

    public function init()
    {
        parent::init();
        $this->budget_plan_year = date('Y');
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('article_id, budget_plan_year', 'required'),
            array('article_id, budget_plan_year', 'numerical', 'integerOnly'=>true),
            array('budget_plan_year', 'default', 'value'=>date('Y')),
            array('budget_plan_yan, budget_plan_feb, budget_plan_mar, budget_plan_apr, budget_plan_may, budget_plan_jun, budget_plan_jul, budget_plan_aug, budget_plan_sep, budget_plan_oct, budget_plan_nov, budget_plan_dec', 'length', 'max'=>20),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('budget_plan_id, article_id, budget_plan_yan, budget_plan_feb, budget_plan_mar, budget_plan_apr, budget_plan_may, budget_plan_jun, budget_plan_jul, budget_plan_aug, budget_plan_sep, budget_plan_oct, budget_plan_nov, budget_plan_dec, budget_plan_year', 'safe', 'on'=>'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'budget_plan_id' => 'Budget Plan',
            'article_id' => 'Article',
            'budget_plan_yan' => 'Budget Plan Yan',
            'budget_plan_feb' => 'Budget Plan Feb',
            'budget_plan_mar' => 'Budget Plan Mar',
            'budget_plan_apr' => 'Budget Plan Apr',
            'budget_plan_may' => 'Budget Plan May',
            'budget_plan_jun' => 'Budget Plan Jun',
            'budget_plan_jul' => 'Budget Plan Jul',
            'budget_plan_aug' => 'Budget Plan Aug',
            'budget_plan_sep' => 'Budget Plan Sep',
            'budget_plan_oct' => 'Budget Plan Oct',
            'budget_plan_nov' => 'Budget Plan Nov',
            'budget_plan_dec' => 'Budget Plan Dec',
            'budget_plan_year' => 'Budget Plan Year',
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

        $criteria=new CDbCriteria;

        $criteria->compare('budget_plan_id',$this->budget_plan_id);
        $criteria->compare('article_id',$this->article_id);
        $criteria->compare('budget_plan_yan',$this->budget_plan_yan,true);
        $criteria->compare('budget_plan_feb',$this->budget_plan_feb,true);
        $criteria->compare('budget_plan_mar',$this->budget_plan_mar,true);
        $criteria->compare('budget_plan_apr',$this->budget_plan_apr,true);
        $criteria->compare('budget_plan_may',$this->budget_plan_may,true);
        $criteria->compare('budget_plan_jun',$this->budget_plan_jun,true);
        $criteria->compare('budget_plan_jul',$this->budget_plan_jul,true);
        $criteria->compare('budget_plan_aug',$this->budget_plan_aug,true);
        $criteria->compare('budget_plan_sep',$this->budget_plan_sep,true);
        $criteria->compare('budget_plan_oct',$this->budget_plan_oct,true);
        $criteria->compare('budget_plan_nov',$this->budget_plan_nov,true);
        $criteria->compare('budget_plan_dec',$this->budget_plan_dec,true);
        $criteria->compare('budget_plan_year',$this->budget_plan_year);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return BudgetPlanRecord the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
