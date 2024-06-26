<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsersManagementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-management-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <? // = $form->field($model, 'auth_key') ?>

    <? // = $form->field($model, 'password_hash') ?>

    <? // = $form->field($model, 'password_reset_token') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'status'); ?>

    <? echo $form->field($model, 'created'); ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
