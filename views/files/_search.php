<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\FilesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="files-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'site_id') ?>

    <?= $form->field($model, 'file_type') ?>

    <?= $form->field($model, 'file_name') ?>

    <?= $form->field($model, 'file_realname') ?>

    <?php // echo $form->field($model, 'file_description') ?>

    <?php // echo $form->field($model, 'file_loaddate') ?>

    <?php // echo $form->field($model, 'file_date') ?>

    <?php // echo $form->field($model, 'file_close') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'updateusername') ?>

    <?php // echo $form->field($model, 'updatedate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
