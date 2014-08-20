<?php

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $article_id
 * @property string $article_name
 * @property integer $article_group_id
 * @property string $article_type
 *
 * The followings are the available model relations:
 * @property ArticleGroup $articleGroup
 * @property BudgetPlanRecord[] $budgetPlans
 * @property Transaction[] $transactions
 */
class Article extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'article';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('article_name, article_type', 'required'),
            array('article_group_id', 'numerical', 'integerOnly'=>true),
            array('article_name', 'length', 'max'=>50),
            array('article_type', 'length', 'max'=>7),
            array('article_type', 'in', 'range'=> ArticleEnum::getValidValues()),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('article_id, article_name, article_group_id, article_type', 'safe', 'on'=>'search'),
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
            'articleGroup' => array(self::BELONGS_TO, 'ArticleGroup', 'article_group_id'),
            'budgetPlans' => array(self::HAS_MANY, 'BudgetPlanRecord', 'article_id'),
            'transactions' => array(self::HAS_MANY, 'Transaction', 'article_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'article_id' => 'Article',
            'article_name' => 'Article Name',
            'article_group_id' => 'Article Group',
            'article_type' => 'Article Type',
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

        $criteria->compare('article_id',$this->article_id);
        $criteria->compare('article_name',$this->article_name,true);
        $criteria->compare('article_group_id',$this->article_group_id);
        $criteria->compare('article_type',$this->article_type,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Article the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
