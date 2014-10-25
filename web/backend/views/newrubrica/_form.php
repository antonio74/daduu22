<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \backend\models\Categoria;

/* @var $this yii\web\View */
/* @var $model common\models\Newrubrica */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="newrubrica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cognome')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?php /* = $form->field($model, 'id_categoria')->dropDownList($categorie1, ['prompt'=>'scegli la categoria']) */ ?> 
    
    <?= $form->field($model, 'id_categoria')->dropDownList($categorie) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
