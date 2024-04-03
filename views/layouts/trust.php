<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\TrustAsset;

use app\models\SfoSites;
use app\models\Backup;

TrustAsset::register($this);

$url = str_replace("www.", "", $_SERVER['SERVER_NAME']);
if (strpos($_SERVER['SERVER_NAME'], '.test') >= 0) $url = str_replace(".test", ".ru", $url);

$site = SfoSites::find()
-> where(['domain' => $url])
-> one();

$session = Yii::$app->session;
if (!$session->isActive) $session->open();

$session->set('site_id', $site->id);
$session->set('site_name', $site->name);
$session->set('site_url', $site->domain);
$session->set('site_parent', $site->subsite_of);

$this->title = $site->name;
Yii::$app->name = 'ООО &quot;СФО ИНВЕСТКРЕДИТ ФИНАНС&quot;';

$url = array_reverse(explode(".", str_replace("www.", "", $_SERVER['SERVER_NAME'])));
$url = "https://" . $url[1] . "." . $url[0];

$td = getdate();
$snow = (($td['mon'] == 1 && $td['mday'] <= 15) || ($td['mon'] == 12 && $td['mday'] >= 15)) ? '<script src="/scripts/snow.js"></script>' : '';

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <?= $snow."\n" ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => $url, //Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            // главная
            ['label' => 'Информация для заемщиков', 'url' => ['/site/index']],
            // закончилась главная
            // прием платежей
            ['label' => 'Прием платежей', 'url' => ['/site/about']],
            // закончился прием платежей
            ['label' => 'Уполномоченный агент', 'url' => ['/site/agent']],
            ['label' => 'Обратная связь', 'url' => ['/site/contact']],
            /*
            Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
            */
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?php 
        if ($_SERVER['SERVER_ADDR'] == '192.168.36.47')
        {
            $bkp = Backup::find()->One();
            if (isset($bkp->backup_date))
                $bkp_date = 'Дата резервной копии: ' . $bkp->backup_date;
            else 
                $bkp_date = 'Дата резервной копии не установлена!';
            $testSrv = "<h1 style=\"color:red;\">Тестовый сервер $bkp_date</h1>";
        }
        else 
            $testSrv = "";
        ?>
        <?= $testSrv . $content ?>
    </div>
    <?php 
        $acept_cookie = 'false';
        //echo "<hide>";
        foreach ($_COOKIE as $key => $value)
        {
            if ($key == 'accept_cookie') $acept_cookie = $value;
            //echo $key . ' => ' . $value . "\n";
        }
        //echo "</hide>";
        Yii::Debug($acept_cookie, 'acept_cookie');
        Yii::Debug(Yii::$app->getRequest()->getUserIP(), 'getUserIP');
        #Yii::Debug($_SERVER['HTTP_X_REAL_IP'], 'HTTP_X_REAL_IP');
        if ($acept_cookie != 'true') echo $this->render('_cookie-banner', ['domain' => $site->domain, 'name' => $site->name]); 
    ?>
</div>

<footer class="footer">
    <div class="container">
    <?php
        $age = date('Y');
        if ($age != 2018) $age = '2018 - ' . $age . ",";
    ?>
        <p class="pull-left">&copy; ООО &quot;СФО ИНВЕСТКРЕДИТ ФИНАНС&quot; <?= $age ?></p>

        <p class="pull-right">
        	<?= Html::a('Пользовательское соглашение', '/site/getfile?id=651', ['target' => '_blank']); ?> |
        	<?= Html::a('Политика в отношении обработки персональных данных', '/site/getfile?id=623', ['target' => '_blank']); ?>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
