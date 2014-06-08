<?php
/**
 * @file ArticleController.php
 *
 * @project bkeeper
 * @author tema 4tema2@gmail.com
 * @date 04.06.14 15:40
 */

class ArticleController extends CController {

    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Article', array(
            'pagination'=>array(
                'pageSize'=>5,
            ),
        ));

        $this->render('index',array(
            'gridDataProvider'=>$dataProvider,
        ));
    }

    public function actionAdd()
    {
        $model = new ArticleForm();
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'Agent-Form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['ArticleForm'])) {
            $model->attributes = $_POST['ArticleForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->add()) {
                Yii::app()->user->setFlash('agent_msg','<div class="msgbar msg_Success hide_onC"><span class="iconsweet">*</span><p>Новый Агент успешно добавлен!</p></div>');
                $this->redirect('/article');
            }
        }

        $this->render('add', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = new ArticleForm();
        $article = Article::model()->findByPk($id);
        $model->attributes = $article->attributes;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'Agent-Form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['ArticleForm'])) {
            $model->attributes = $_POST['ArticleForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->update()) {
                Yii::app()->user->setFlash('agent_msg','<div class="msgbar msg_Success hide_onC"><span class="iconsweet">*</span><p>Агент с ID='.$id.' успешно изменён!</p></div>');
                $this->redirect('/article');
            }
        }

        $this->render('update', array('model' => $model));
    }


} 
