<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Tenants;
use common\models\Groups;


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$tenantName = $_REQUEST['tenantname'];
$tenantId = $_REQUEST['tenantid'];
$this->title = 'Create a new user for ' . $tenantName . ' tenant';
$this->params['breadcrumbs'][] = $this->title;
$model->id_tenant = $tenantId;
$groups = Groups::getGroups();
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to create a new user:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'id_tenant')->hiddenInput()->label('') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'groups')->radioList($groups) ?>

                <div class="form-group">
                    <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
