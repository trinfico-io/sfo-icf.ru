<?php
$access_arr = array(
    '195.68.154.162' // trinfico
    , '62.105.149.18', '62.105.149.19', '62.105.149.20', '62.105.149.21', '62.105.149.22', '62.105.149.23', '62.105.149.24', '62.105.149.25', '5.164.28.23' // fasp
);
$debug_arr = array(
    '195.68.154.162' // trinfico
);
if (in_array($_SERVER['HTTP_X_REAL_IP'], $access_arr))
{
    if (in_array($_SERVER['HTTP_X_REAL_IP'], $debug_arr))
    {
        // comment out the following two lines when deployed to production
        defined('YII_DEBUG') or define('YII_DEBUG', true);
        defined('YII_ENV') or define('YII_ENV', 'dev');
    };
}
// comment out the following two lines when deployed to production
if (strpos($_SERVER['SERVER_NAME'], '.test') >= 0)
{
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
};

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
