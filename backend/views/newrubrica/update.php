<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Newrubrica */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Newrubrica',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Newrubricas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="newrubrica-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'categorie' => $categorie,
    ]) ?>

</div>
