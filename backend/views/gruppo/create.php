<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Gruppo */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Gruppo',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gruppos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gruppo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
