<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\DownloadsLog;
use yii\web\NotFoundHttpException;

use app\models\Files;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */

    private $zone;
    private $site;
    private $filesView;

    public function __construct($id, $module, $config = array()) {
        parent::__construct($id, $module, $config);

        $url = str_replace("www.", "", $_SERVER['SERVER_NAME']);
        $url = explode(".", $url);
        $this->layout = '@app/views/layouts/main.php';
        $this->site = $url[0];
        if (count($url) > 2)
        {
            $this->layout = '@app/views/layouts/' . $url[0] . '.php';
        }
        $this->zone = $url[count($url) - 1];
        
        $this->filesView = '_files';
        if (Yii::$app->user->isGuest == false && Yii::$app->user->identity->status == 20) $this->filesView = '_filesadm';
    }


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'messages-for-investors', 'accounting-and-financial-statements', 'emission', 'other-documents', 'constituent'],
                'rules' => [
                    [
                        'actions' => ['logout', 'messages-for-investors', 'accounting-and-financial-statements', 'emission', 'other-documents', 'constituent'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'logout' => ['post'],
                ],
            ],
        ];
    }
    
    public function beforeAction($action)
    {
        if ($action->id == 'upload') {
            $this->enableCsrfValidation = false;
        }
        
        return parent::beforeAction($action);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //$this->layout = '@app/views/layouts/' . $this->layout_name . '.php';
        //return $this->render('index');
        return $this->render($this->site);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        // Калугин Д.Е. 25.01.2018: админ будет в копии внутри отправки. отправляем на специальный ящик
        //if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['sfoEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about_' . $this->site);
    }
#####################################################################################
## тестирование страниц
## закончилось тестирование страниц
#####################################################################################
    public function actionAgent()
    {
        return $this->render('agent_' . $this->site);
    }

    public function actionPayment()
    {
        return $this->redirect('https://payment.sfo-icf.ru');
    }

    public function actionTrust()
    {
        return $this->redirect('https://trust.sfo-icf.' . $this->zone);
    }

    public function actionSvyaznoy()
    {
        return $this->redirect('https://svyaznoy.sfo-icf.' . $this->zone);
    }

    public function actionGetfile()
    {
        $session = Yii::$app->session;
        $site_id = $session->get('site_id');
        $site_parent = $session->get('site_parent');

        $log = new DownloadsLog();
        $log->result = 'Скачивание файла';
        $log->user_info = @$_SERVER['HTTP_USER_AGENT'];
        $log->user_ip = @$_SERVER['REMOTE_ADDR'];
        $log->site_id = $site_id;

        $params = Yii::$app->request->get();
        if (isset($params['id']))
        {
            $filename = $params['id'];
            $log->filename = $filename;
        }
        else
        {
            $log->result = 'Ошибка. Запрос с пустым именем файла';
            $log->Save();
            throw new NotFoundHttpException("Ошибка чтения файла ".$filename.". Обратитесь к администратору системы!");
        };
        // Калугин Д.Е, 16.04.2018 файллы переехали в БД
        $Files = Files::find()
            ->where(['file_name' => $filename, 'site_id' => $site_id])
            ->orwhere(['id' => $filename, 'site_id' => $site_id])
            ->orwhere(['file_name' => $filename, 'site_id' => $site_parent, 'file_type' => 8])
            ->orwhere(['id' => $filename, 'site_id' => $site_parent, 'file_type' => 8])
            ->one();
        if (!$Files)
        {
            $log->result = 'Ошибка. Файл не найден. Передан ID '.$filename;
            $log->Save();
            throw new NotFoundHttpException("Ошибка поиска файла ".$filename.". Обратитесь к администратору системы!");
        }

        if ($Files->site_id != $site_id && $Files->site_id != $site_parent)
        {
            $log->filename = $Files->file_name;
            $log->result = 'Ошибка. Файл не относится к текущему сайту. Передан ID '.$filename.', принадлежит сайту '.$Files->site_id;
            $log->Save();
            throw new NotFoundHttpException("Ошибка поиска файла ".$filename." на сайте. Обратитесь к администратору системы!");
        }
        // end of Калугин Д.Е, 16.04.2018
        //$file = "/var/www/sfo-icf/data/www/docs/".$filename;
        //$file = "/var/www/sfo-icf/data/www/docs/".$Files->file_realname;
        $file = __DIR__ . "/../docs/".$Files->file_realname;
        if (file_exists($file))
        {
            // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
            // если этого не сделать файл будет читаться в память полностью!
            if (ob_get_level())
            {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            //header('Content-Disposition: attachment; filename=' . basename($file));
            //header('Content-Disposition: attachment; filename=' . $filename);
            header('Content-Disposition: attachment; filename=' . $this->replace_rus($Files->file_name));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            // читаем файл и отправляем его пользователю
            if ($fd = fopen($file, 'rb'))
            {
                while (!feof($fd))
                {
                    print fread($fd, 1024);
                }
                fclose($fd);
            }

            if (!$log->Save())
            {
                //                 echo "<pre>";
                //                 var_dump($log);
                //                 echo "</pre>";
            }

            exit;
        }
        else
        {
            $log->result = "Ошибка. Запрашиваемый файл не существует!";
            if (!$log->Save())
            {
                //                 echo "<pre>";
                //                 var_dump($log);
                //                 echo "</pre>";
            }
            throw new NotFoundHttpException("Ошибка выдачи файла ".$filename.". Обратитесь к администратору системы!");
        }
    }
    
    
    // is #2343
    public function actionMessagesForInvestors()
    {
        return $this->render($this->filesView, ['titleBlock' => ['Сообщения для владельцев облигаций'], 'fileType' => ['10']]);
        //return $this->render('_files', ['titleBlock' => ['Сообщения для владельцев облигаций'], 'fileType' => ['10']]);
    }
    
    public function actionAccountingAndFinancialStatements()
    {
        return $this->render($this->filesView, ['titleBlock' => ['Бухгалтерская и финансовая отчетность'], 'fileType' => ['11']]);
        //return $this->render('_files', ['titleBlock' => ['Бухгалтерская и финансовая отчетность'], 'fileType' => ['11']]);
    }
    
    public function actionEmission()
    {
        return $this->render($this->filesView, ['titleBlock' => ['Эмиссионная документация'], 'fileType' => ['4']]);
        //return $this->render('_files', ['titleBlock' => ['Эмиссионная документация'], 'fileType' => ['4']]);
    }
    
    public function actionOtherDocuments()
    {
        return $this->render($this->filesView, ['titleBlock' => ['Иные документы'], 'fileType' => ['8']]);
        //return $this->render('_files', ['titleBlock' => ['Иные документы'], 'fileType' => ['8']]);
    }
    
    public function actionConstituent()
    {
        return $this->render($this->filesView, ['titleBlock' => ['Учредительные документы'], 'fileType' => ['1']]);
        //return $this->render('_files', ['titleBlock' => ['Учредительные документы'], 'fileType' => ['1']]);
    }
    
    public function actionPvoInform()
    {
        return $this->render($this->filesView, ['titleBlock' => ['Информация для ПВО и инвесторов'], 'fileType' => ['12']]);
        //return $this->render('_files', ['titleBlock' => ['Информация для ПВО и инвесторов'], 'fileType' => ['12']]);
    }

    
    
    function replace_rus($msg)
    {
        $rus = array(' ','А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О',
            'П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','а','б',
            'в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у',
            'ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я', '.', "*");

        $lat = array('_','a','b','v','g','d','e','jo','zh','z','i','j','k','l','m','n','o',
            'p','r','s','t','u','f','h','c','ch','sh','shh','', 'y','', 'je','ju','ja','a',
            'b','v','g','d','e','jo','zh','z','i','j','k','l','m','n','o','p','r','s','t',
            'u','f','h','c','ch','sh','shh','', 'y','', 'je','ju','ja', '.', "");

        return $msg  = str_replace( $rus, $lat, $msg );
    }
}
