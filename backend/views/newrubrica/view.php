<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Newrubrica */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Newrubricas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$idg = $_GET['idg'];
?>
<div class="newrubrica-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <h1>idg: <?= Html::encode($idg[0]) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cognome',
            'nome',
            'mobile',
            'email:email',
            [ 'label' => 'Categoria', 'value' => $model->idCategoria->nome ]
        ],
    ]) ?>


</div>
