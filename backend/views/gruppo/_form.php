<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Gruppo */
/* @var $form yii\widgets\ActiveForm */
$visibilita = array();
$visibilita['privato']='Privato';
$visibilita['gruppo']='Gruppo';
$visibilita['tenant']='Tenant';

$permessi = array();
$permessi['R']='Read';
$permessi['RW']='Read/Write';


?>

<div class="gruppo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'descrizione')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'visibilita')->dropDownList($visibilita) ?>

    <?= $form->field($model, 'permessi')->radioList($permessi) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
