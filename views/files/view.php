<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\FileTypes;

/** @var yii\web\View $this */
/** @var app\models\Files $model */

$this->title = $model->file_description;
$this->params['breadcrumbs'][] = ['label' => 'Файлы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="files-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if (Yii::$app->session->hasFlash('fileUploadSuccess')): ?>
    <div class="alert alert-success">
        Файл успешно загружен.
    </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('fileUpdateSuccess')): ?>
    <div class="alert alert-success">
        Файл успешно изменен.
    </div>
    <?php endif; ?>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?/*= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */ ?>
    </p>
	<div class='files-list'>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'site_id',
            //'file_type',
            [
                'attribute' => 'file_type',
                'format' => 'text',
                'value' => function($model) {
                    return FileTypes::findOne($model->file_type)->type_name;
                }
            ],
            'file_name',
            'file_realname',
            'file_description',
            'file_loaddate',
            //'file_date',
            [
                'attribute' => 'file_date',
                //'format' => 'text',
                'format' => 'html',
                'value' => function($model) {
                    $public = strtotime($model->file_date);
                    $now = time();
                    $return = $model->file_date;
                    if ($public > $now) $return .= ' <span style="color:#F3F00E;">Дата раскрытия не наступила!</span>';
                    return $return;
                }
                ],
            //'file_close',
            [
                'attribute' => 'file_close',
                //'format' => 'text',
                'format' => 'html',
                'value' => function($model) {
                    $close = strtotime($model->file_close);
                    $now = time();
                    $return = $model->file_close;
                    if (!is_null($model->file_close) && $close < $now) $return .= ' <span style="color:red;">Дата скрытия наступила!</span>';
                    return $return;
                }
            ],
            'username',
            'updateusername',
            'updatedate',
        ],
    ]) ?>
	</div>
</div>
