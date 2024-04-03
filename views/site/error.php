<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
    	<img border=0 align="middle" src="/img/404.png">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <!--
        <? /*=$_SERVER['HTTP_X_REAL_IP']."\n";?>
        <?=$_SERVER['REMOTE_ADDR']."\n";?>
        <?=Yii::$app->session->get('site_id')."\n"; */?>
    -->
</div>
