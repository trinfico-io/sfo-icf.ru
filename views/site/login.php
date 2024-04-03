<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
$session = Yii::$app->session;

function CheckIE()
{
    
    if( strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')!==false ||
        strpos($_SERVER['HTTP_USER_AGENT'],'rv:11.0')!==false ||
        strpos($_SERVER['HTTP_USER_AGENT'],'Trident')!==false
        )
    {
        return true;
    }else{
        return false;
    }
    return false;
}

?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Для получения авторизационных данных Вам следует обратиться к своему менеджеру в <a href="https://<?=$session->get('site_url') ?>"><?=$session->get('site_name') ?></a> </p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-3\">{label}\n{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Имя&nbsp;пользователя') ?>

        <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

        <? if (CheckIE()) echo  $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-6">{image}</div><div class="col-lg-5">{input}</div></div>',
        ])->label('Код проверки'); ?>

        <?
        if (!CheckIE())
        {
            $zone = array_reverse(explode(".", $_SERVER['HTTP_HOST']));
            if ($zone[0] != 'local')
            {
                echo $form->field($model, 'reCaptcha')->widget(
                        \himiklab\yii2\recaptcha\ReCaptcha::className(),
                        ['siteKey' => '6Ldsm0wUAAAAAPkiE-DGD8zHilNhTfOuP6xkdH8G']
                    )->label('Проверка');
            };
        };
        ?>

        <br><br>
        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ])->label('Входить автоматически') ?>


        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
