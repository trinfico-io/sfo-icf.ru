<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Files $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="files-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'site_id')->textInput() ?>

    <?= $form->field($model, 'file_type')->textInput() ?>

    <?= $form->field($model, 'file_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_realname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_loaddate')->textInput() ?>

    <?= $form->field($model, 'file_date')->textInput() ?>

    <?= $form->field($model, 'file_close')->textInput() ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updateusername')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updatedate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
