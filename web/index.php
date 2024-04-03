<?php
$access_arr = array(
    '195.68.154.162' // trinfico
, '62.105.149.18', '62.105.149.19', '62.105.149.20', '62.105.149.21', '62.105.149.22', '62.105.149.23', '62.105.149.24', '62.105.149.25', '5.164.28.23' // fasp
);
$debug_arr = array(
    '195.68.154.162' // trinfico
);
/**
 * еcли надо отобразить дебагбар приходит параметр d === '1'
 * ставим куку, чтобы при обращениях самого дебагбара он мог получить данные на фронт
 */
if (isset($_REQUEST['d']) && $_REQUEST['d'] === '1') {
    setcookie("DEBUG", 1, time() + 3600);
} else {
    setcookie("DEBUG", 0, time() - 3600);
}
/**
 * дефолтные проверки IP + проверка куки для включения дебагмода,
 * иначе - врубаем прод мод
 */
if (in_array($_SERVER['HTTP_X_REAL_IP'], $access_arr)
    && in_array($_SERVER['HTTP_X_REAL_IP'], $debug_arr)
    && isset($_COOKIE["DEBUG"]) && $_COOKIE["DEBUG"] == 1
) {
    // comment out the following two lines when deployed to production
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
} else {
    defined('YII_DEBUG') or define('YII_DEBUG', false);
    defined('YII_ENV') or define('YII_ENV', 'prod');
}

// comment out the following two lines when deployed to production
if (strpos($_SERVER['SERVER_NAME'], '.test') !== false) {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
};

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
