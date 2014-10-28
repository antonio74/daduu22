<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Gruppo;
use common\models\Gruppicontatti;

/* @var $this yii\web\View */
/* @var $model common\models\Newrubrica */
/* @var $form yii\widgets\ActiveForm */

$gruppi = Gruppo::getGruppi();
?>

<div class="newrubrica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cognome')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
    
    <?= $form->field($model, 'id_categoria')->dropDownList($categorie) ?>

    <?= $form->field($model, 'gruppi')->checkBoxList($gruppi) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
