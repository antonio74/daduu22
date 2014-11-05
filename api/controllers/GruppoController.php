<?php

namespace api\controllers;

use yii;
use yii\rest\ActiveController;
use \common\model\Gruppo;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

class GruppoController extends ActiveController
{
  public $modelClass = 'common\models\Gruppo';


}