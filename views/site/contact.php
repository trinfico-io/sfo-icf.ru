<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Связаться с ООО «СФО ИнвестКредит Финанс»';
$this->params['breadcrumbs'][] = $this->title;

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
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Спасибо за Ваше сообщение! Менеджер постарается ответить Вам в ближайшее время.
        </div>

    <?php else: ?>

        <p>
            Для отправки электронного сообщения, пожалуйста, заполните все поля формы.<br>
            Спасибо!
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Ваше имя') ?>

                    <?= $form->field($model, 'email')->label('Ваш электронный адрес, на который будет отправлен ответ') ?>

                    <?= $form->field($model, 'subject')->label('Тема сообщения') ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6])->label('Текст сообщения') ?>

                    <? if (CheckIE()) echo  $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
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

                    <div class="form-group">
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
