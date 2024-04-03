<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\UsersManagement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-management-form user-list">
    <?php $form = ActiveForm::begin(); ?>

    <?
        if (!$model->isNewRecord)
        {
            echo $form->field($model, 'id')->hiddenInput()->label('');
        };
    ?>

    <?= $form->field($model, 'username')->textInput(['disabled' => !$model->isNewRecord])->label('Логин пользователя') ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('E-mail пользователя') ?>

    <?php


    if (!$model->isNewRecord)
    {
        $items = [
            '0' => 'Отключен',
            //'10' => 'Пользователь',
            //'20' => 'Менеджер',
        ];
        if ($model->status == 10 || $model->status == 0) $items['10'] = 'Пользователь';
        if ($model->status == 20) $items['20'] = 'Менеджер';
        $params = [
            'disabled' => ($model->id == Yii::$app->user->id),
            'prompt' => 'Выберите статус...',
            $model->status => ['Selected' => true],
            'maxlength' => true,
            '20' => ['disabled' => true],
        ];
    }
    else
    {
        $items = [
            '0' => 'Отключен',
            '10' => 'Пользователь',
            '20' => 'Менеджер',
        ];
        $params = [
            'disabled' => ($model->id == Yii::$app->user->id),
            'prompt' => 'Выберите статус...',
            'maxlength' => true,
        ];
    }

    ?>
    <?= $form->field($model, 'status')->dropDownList($items,$params) ?>

    <?
        $tpl = '<div class="input-group">
                      {input}
                      <span class="input-group-btn">
                        ' . Html::Button('Сгенерировать', ['class' => 'btn btn-info', 'onClick' => 'javasctipt:pass();return false;']) . '
                      </span>
                    </div>
                ';
        if ($model->isNewRecord)
        {
            echo $form->field($model, 'password', ['template' => "{label}\n{hint}\n". $tpl . "\n{error}"])
                ->textInput([
                    'maxlength' => true,
                    'required' => true,
                    'value' => substr(Yii::$app->security->generateRandomString(), 0, 10),
            ])
                ->label('Пароль пользователя');
        }
        else
        {
            echo $form->field($model, 'password', ['template' => "{label}\n{hint}\n". $tpl . "\n{error}"])
                //->passwordInput()
                ->textInput()
                ->label('Пароль* <sup>не вводите, если не хотите изменить!</sup>');
        }

    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php echo "
<script>
function pass()
    {
        $.ajax({
            url: '/users-management/newpass',
            type: 'GET',
            data: {},
            success: function (data) {
                //alert(data);
                $('#usersmanagement-password').val(data);
            }
        })
    }
</script>
";
?>