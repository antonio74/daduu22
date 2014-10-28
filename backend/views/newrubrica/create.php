<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Newrubrica */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Newrubrica',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Newrubricas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newrubrica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'categorie' => $categorie
    ]) ?>

</div>
