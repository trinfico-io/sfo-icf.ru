<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Files $model */

$this->title = 'Изменение файла: ' . $model->id . " " . $model->file_description;
$this->params['breadcrumbs'][] = ['label' => 'Файлы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение файла';
?>
<div class="files-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <? /*= $this->render('_form', [
        'model' => $model,
    ]) */ ?>
    
    <?php $form = ActiveForm::begin(); ?>

    
    <?= $form->field($model, 'file_description')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'file_date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'file_close')->textInput(['type' => 'date']) ?>
    
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div><br/>
    
    <?php ActiveForm::end(); ?>

</div>
