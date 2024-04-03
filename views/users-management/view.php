<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UsersManagement */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Управление пользователями', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


switch($model->status)
{
    case 0 : $st = 'Отключен (' . $model->status . ')'; break;
    case 10 : $st = 'Пользователь (' . $model->status . ')'; break;
    case 20 : $st = 'Менеджер (' . $model->status . ')'; break;
    case 30 : $st = 'Администратор (' . $model->status . ')'; break;
    default : $st = 'ОШИБКА! Статус ' . $model->status . ' не известен системе!'; break;
};
?>
<div class="users-management-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <? /* = Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить пользователя?',
                'method' => 'post',
            ],
        ]) */ ?>
    </p>
	<div class="user-list">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'email:email',
            'email:text',
            //'status',
            [
              'attribute' => 'status',
                'format' => 'text',
                'value' => $st,
            ],
            'created:text',
            //'created_at:date',
            /*
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y H:i:s'],
                'value' => $model->created_at,
            ],
            */
            //'updated_at:date',
            /*
            [
            'attribute' => 'updated_at',
            'format' => ['date', 'php:d.m.Y H:i:s'],
            'value' => $model->updated_at,
            ],
            */
        ],
    ]) ?>
	</div>
</div>
