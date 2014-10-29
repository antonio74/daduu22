<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use common\models\Gruppo;

/* @var $this yii\web\View */
/* @var $model common\models\Newrubrica */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Newrubricas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$model->gruppi = $model->getCheckedGroups();
$nomiGruppi = Gruppo::getGruppi();
$gruppi = "";
foreach ($model->gruppi as $key => $value) {
    if ($gruppi!==""){
        $gruppi = $gruppi.", ";
    }
    $gruppi = $gruppi.$nomiGruppi[$value];
}
?>

<div class="newrubrica-view">

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
            'cognome',
            'nome',
            'mobile',
            'email:email',
            [ 'label' => 'Categoria', 'value' => $model->idCategoria->nome ],
            [ 'label' =>'Gruppi', 'value' => $gruppi],
        ],
    ]) ?>


</div>
