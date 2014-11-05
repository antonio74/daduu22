<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NewrubricaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Newrubricas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newrubrica-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
                'modelClass' => 'Newrubrica', ]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cognome',
            'nome',
            'mobile',
            'email:email',
            /* This column has been added to display the category name and not its ID, and to create a link to contact category */
            ['attribute' => 'id_categoria',
             'format' => 'raw',
             'value' => function ($data) {
                        return Html::a($data->categoria->nome, ['/categoria/view', 'id' =>$data->categoria->id]);
                    },
            ],

            ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>

</div>
