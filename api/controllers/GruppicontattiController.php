<?php

namespace api\controllers;

use yii;
use yii\rest\ActiveController;
use \common\model\Gruppicontatti;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

class GruppicontattiController extends ActiveController
{
  public $modelClass = 'api\models\Gruppicontatti';


}