<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersManagementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление пользователями';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="users-management-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Регистрация пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="user-list">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'id',
                'headerOptions' => ['width' => '100'],
            ],
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            //'email:email',
            'email:text',
//             'status',
            [
              'attribute' => 'status',
                'format' => 'text',
                'content' => function($data)
                                {
                                    switch($data->status)
                                    {
                                        case 0 : $st = 'Отключен (' . $data->status . ')' ; break;
                                        case 10 : $st = 'Пользователь (' . $data->status . ')'; break;
                                        case 20 : $st = 'Менеджер (' . $data->status . ')'; break;
                                        case 30 : $st = 'Администратор (' . $data->status . ')'; break;
                                        default : $st = 'ОШИБКА! Статус ' . $data->status . ' не известен системе!'; break;
                                    };
                                    return $st;
                                },
            ],
            'created',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '<p align="center">{view} {update} {link}</p>',
            ],
        ],
    ]); ?>
    </div>
</div>
