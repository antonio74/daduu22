<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\Tenants */
/* @var $form yii\widgets\ActiveForm */
$tenantUsers = User::getUsers();

?>

<div class="tenants-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => 255]) ?>

    <!--  <?= $form->field($model, 'tenantUsers')->checkBoxList($tenantUsers) ?> -->


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    	<?= $model->isNewRecord ? null : Html::a(Yii::t('app', 'Create User'), ['createuser', 'tenantname' => $model->nome, 'tenantid' => $model->id], 
    		['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
