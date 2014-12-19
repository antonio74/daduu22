<?php

namespace api\controllers;

use yii;
use yii\rest\ActiveController;
use \api\models\Gruppo;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use \common\models\GruppoSearch;


class GruppoController extends ActiveController
{
  public $modelClass = 'api\models\Gruppo';

  public function actions()
  {
    $actions = parent::actions();
    // personalizza il data provider preparation con il metodo "prepareDataProvider()"
    $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

    return $actions;
  }

  public function prepareDataProvider()
  {
    $searchModel = new GruppoSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    return $dataProvider; 
  }


}