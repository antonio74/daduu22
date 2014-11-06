<?php

namespace api\controllers;

use yii;
use yii\rest\ActiveController;
use \common\model\NewRubrica;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

class NewrubricaController extends ActiveController
{
  public $modelClass = 'api\models\Newrubrica';

}