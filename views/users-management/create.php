<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UsersManagement */

$this->title = 'Регистрация пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Управление пользователями', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-management-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
