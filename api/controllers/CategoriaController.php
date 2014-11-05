<?php

namespace api\controllers;

use yii;
use yii\rest\ActiveController;
use \common\model\Categoria;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

class CategoriaController extends ActiveController
{
  public $modelClass = 'common\models\Categoria';


}