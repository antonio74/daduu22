<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Gruppo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gruppos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if($model->visibilita!='privato')
    $visibilita=$visibilita=ucfirst($model->visibilita) . ' ' . $model->autorizzati;
else $visibilita=$model->visibilita;

if($model->permessi=='RW')
    $permessi='Read/Write';
else $permessi='Read';


?>
<div class="gruppo-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'nome',
            'descrizione:ntext',
            [ 'label' => 'Visibilità', 'value' => $visibilita ],
            [ 'label' => 'Permessi', 'value' => $permessi ]
        ],
    ]) ?>

</div>
