<?php
/**
 * @file ArticleGroupController.php
 *
 * @project bkeeper
 * @author tema 4tema2@gmail.com
 * @date 04.06.14 15:40
 */

class ArticleGroupController extends CController {

    public $sidebar=array();

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=ArticleGroup::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
                'model'=>$this->loadModel($id),
            ));
    }

    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('ArticleGroup', array(
            'pagination'=>array(
                'pageSize'=>5,
            ),
        ));

        $this->render('index',array(
                'gridDataProvider'=>$dataProvider,
            ));

    }

    public function actionCreate()
    {
        $model = new ArticleGroup();

        // collect user input data
        if (isset($_POST['ArticleGroup'])) {
            $model->attributes=$_POST['ArticleGroup'];
            if($model->save()) {
                $this->redirect(array('index'));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['ArticleGroup']))
        {
            $model->attributes=$_POST['ArticleGroup'];
            if($model->save()) {
                $this->redirect(array('index'));
            }
        }

        $this->render('update',array(
                'model'=>$model,
            ));
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        // collect user input data
        if ($model->delete()) {
            Yii::app()->user->setFlash('agent_msg','<div class="msgbar msg_Success hide_onC"><span class="iconsweet">*</span><p>Агент с ID='.$id.' успешно удален!</p></div>');
            $this->redirect(array('index'));
        }
        else {
            Yii::app()->user->setFlash('agent_msg','<div class="msgbar msg_Error hide_onC"><span class="iconsweet">*</span><p>Ошибка уделания Агента с ID='.$id.'</p></div>');
            $this->redirect(array('index'));
        }
    }

} 
