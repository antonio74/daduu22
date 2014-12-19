<?php

namespace backend\controllers;

use Yii;
use common\models\Categoria;
use common\models\Newrubrica;
use common\models\NewrubricaSearch;
use common\models\Gruppicontatti;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\web\HttpException;

/**
 * NewrubricaController implements the CRUD actions for Newrubrica model.
 */
class NewrubricaController extends Controller
{
    public function behaviors()
    {
        return [
        'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
    
                    [
                        'actions' => ['logout', 'index', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                    [
                        'actions' => ['update', 'delete', 'create'],
                        'allow' => true,
                        //'matchCallback' => User::isAdmin()
                    ],
                ],
            ],
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
        $categorie = Categoria::getCategorie();   
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
        $categorie = Categoria::getCategorie();   

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            /* passage of parameter $categorie to 'create' view, and then to '_form' partial */
            return $this->render('create', [
                'model' => $model, 'categorie' => $categorie
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
        $categorie = Categoria::getCategorie();   

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            //$model->gruppi = $model->getGruppiContattis()->select('id_gruppo')->column(); //$model->getCheckedGroups();
            return $this->render('update', [
                'model' => $model, 'categorie' => $categorie,
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
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['index']);
    }



    public function beforeAction($action)
    {
        $parentAllowed = parent::beforeAction($action);
        if($action->id == 'update' || $action->id == 'delete')
        {
            $model = $this->findModel($_GET['id']);        
            if(!User::isAllowed($model))
                throw new HttpException(405, "You don't have request privileges to $action->id this contact.");
        }
        return $parentAllowed;

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
