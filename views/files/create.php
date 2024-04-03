<?php

use yii\helpers\Html;
use app\models\FileTypes;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var app\models\Files $model */

$param = Yii::$app->request->get();
if (isset($param['file_type'])) $model->file_type = $param['file_type'];

$session = Yii::$app->session;
$model->site_id = $session->get('site_id');

$model->username = /*$model->updateusername =*/ Yii::$app->user->identity->username;

$model->file_date = date("Y-m-d");
$model->file_loaddate = /*$model->updatedate =*/ date("Y-m-d H:i:s");

$this->title = 'Загрузка файла в раздел "' . FileTypes::findOne($model->file_type)->type_name . '"';
$this->params['breadcrumbs'][] = ['label' => 'Файлы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="files-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?/*= $this->render('_form', [
        'model' => $model,
    ])  */?>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'site_id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'file_type')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'username')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'updateusername')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'file_loaddate')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'updatedate')->hiddenInput()->label(false) ?>
    
    <?= $form->field($model, 'file')->fileinput() ?>
    
    <?= $form->field($model, 'file_description')->textInput() ?>
    <div class="row">
    	<div class="col-lg-6">
    		<?= $form->field($model, 'file_date')->textInput(['type' => 'date']) ?>
		</div>
		<div class="col-lg-6">
    		<?= $form->field($model, 'file_close')->textInput(['type' => 'date']) ?>
    	</div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
