<?php

namespace backend\controllers;

use Yii;
use common\models\Categoria;
use common\models\Newrubrica;
use common\models\NewrubricaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\ArrayHelper;


/**
 * NewrubricaController implements the CRUD actions for Newrubrica model.
 */
class NewrubricaController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Newrubrica models.
     * @return mixed
     */
    public function actionIndex()
    {
        $categorie2 = Categoria::find()->asArray()->all(); 
        $categorie = ArrayHelper::map($categorie2, 'id', 'nome'); 
        $searchModel = new NewrubricaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 'categorie' => $categorie
        ]);
    }

    /**
     * Displays a single Newrubrica model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Newrubrica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Newrubrica();

        /* First solution: Database connection and query execution */
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand('SELECT nome FROM categoria');
        $categorie1 = $sql->queryColumn(); 

        /* Second solution: Using methods of Model Categoria and Yii2 ArrayHelper
           to map attributes 'id' abd 'nome' into an array */ 
        $categorie2 = Categoria::find()->asArray()->all(); 
        $categorie = ArrayHelper::map($categorie2, 'id', 'nome'); 

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            /* passage of parameter $categorie to 'create' view, and then to '_form' partial */
            return $this->render('create', [
                'model' => $model, 'categorie1' => $categorie1, 'categorie' => $categorie
            ]);
        }
    }

    /**
     * Updates an existing Newrubrica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categorie2 = Categoria::find()->asArray()->all(); 
        $categorie = ArrayHelper::map($categorie2, 'id', 'nome'); 

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model, 'categorie' => $categorie
            ]);
        }
    }

    /**
     * Deletes an existing Newrubrica model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Newrubrica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Newrubrica the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Newrubrica::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
