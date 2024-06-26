<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsersManagement */

$this->title = 'Изменение пользователя: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Управление пользователями', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="users-management-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
