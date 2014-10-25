<?php

namespace api\controllers;

use yii;
use yii\rest\ActiveController;
use \common\model\User;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

class UserController extends ActiveController
{
	public $modelClass = 'api\models\User';

  

}