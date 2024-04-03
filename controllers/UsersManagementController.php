<?php

namespace app\controllers;

use Yii;
use app\models\UsersManagement;
use app\models\UsersManagementSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use app\models\Log;
use yii\filters\AccessControl;

/**
 * UsersManagementController implements the CRUD actions for UsersManagement model.
 */
class UsersManagementController extends Controller
{
    private $site_id;
    private $site_url;
    private $site_name;

    public function __construct($id, $module, $config = [])
    {
        $session = Yii::$app->session;
        $this->site_id = $session->get('site_id');
        $this->site_url = $session->get('site_url');
        $this->site_name = $session->get('site_name');

        parent::__construct($id, $module, $config);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'view'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    private function checkRights()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->status != 20 || $_SERVER['HTTP_X_REAL_IP'] != '195.68.154.162')
        {
            /*
            $log = new Log();
            $log->user = (!Yii::$app->user->isGuest) ? Yii::$app->user->identity->username : 'anonnymous';
            $log->date_act = time();
            $log->action = "Попытка не санкционированного доступа к разделу 'Управление пользователями' ";
            (!Yii::$app->user->isGuest) ? $log->action .= "пользователем ".Yii::$app->user->identity->username : $log->action .= "не авторизованным пользователем";
            $log->action .= ' с IP '.@$_SERVER['REMOTE_ADDR'];
            $log->Save();
            */
            throw new ForbiddenHttpException('У Вас нет прав на просмотр данной страницы.');
        }

    }

    /**
     * Lists all UsersManagement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->checkRights();

        $searchModel = new UsersManagementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsersManagement model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->checkRights();

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UsersManagement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->checkRights();

        $model = new UsersManagement();

        if ($model->load(Yii::$app->request->post())) {
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
            $model->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
            $model->auth_key = Yii::$app->security->generateRandomString();
            $model->created = Yii::$app->user->identity->username;
            $model->site_id = $this->site_id;

            if ($model->save()) {
                if (1==1)
                {
                    $message = "Вы зарегистрированы на сайте <a href='https://" . $this->site_url . "'>" . $this->site_name . "</a>\n";
                    if($model->status == 20) $message .= "Ваш статус: Менеджер. Вы можете просматривать раскрытие информации и управлять пользователями.\n";
                    $message .= "Ваши регистрационные данные:\n";
                    $message .= "<b>Логин:</b> ".$model->username."\n";
                    $message .= "<b>Пароль:</b> ".$model->password."\n";
                    $message .= "Пожалуйста, не сообщайте Ваш пароль третьим лицам.\nПри утрате пароля или подозрении о его компрометаци, обратитесь";
                    $message .= ($model->status == 10) ? (" к своему менеджеру в " . $this->site_name) : (" в alefsupport") . " для генерации нового пароля.\n";
                    $message .= "\n";
                    $message .= "\n";
                    $message .= "Пожалуйста, не отвечайте на данное письмо, оно сгенерировано автоматически и отправлено с технического e-mail.\n";

                    Yii::$app->mailer->compose()
                    ->setTo($model->email)
                    ->setFrom([Yii::$app->params['fromEmail'] => $this->site_name]) // Коптелов К.В. 24.11.2022: настройка отправки через SendPulse
                    // ->setFrom([Yii::$app->params['fromEmail'] . $this->site_url => $this->site_name])
                    ->setSubject("Сообщение о регистрации пользователя")
                    ->setTextBody($message)
                    ->setHtmlBody(nl2br($message))
                    ->send();
                }
                switch ($model->status)
                {
                    case 0: $status_name = 'Пользователь отключен'; break;
                    case 10: $status_name = 'Пользователь'; break;
                    case 20: $status_name = 'Менеджер'; break;
                    case 30: $status_name = 'Администратор'; break;
                }
                $message = "Произведена регистрация нового пользователя\n";
                $message .= "<b>Логин:</b> ".$model->username."\n";
                $message .= "<b>Пароль:</b> ".$model->password."\n";
                $message .= "<b>E-mail:</b> ".$model->email."\n";
                $message .= "Статус пользователя: ".$model->status." -> ".$status_name."\n";
                $message .= "Сообщение о регистрации на почту пользователя отправлено\n";
                $message .= "\n";
                $message .= "Регистрация пользователя произведена Менеджером <b>".Yii::$app->user->identity->username."</b>\n";

                Yii::$app->mailer->compose()
                ->setTo(Yii::$app->params['adminEmail'])
                ->setCc(Yii::$app->user->identity->email)
                ->setFrom([Yii::$app->params['fromEmail'] => $this->site_name]) // Коптелов К.В. 24.11.2022: настройка отправки через SendPulse
                //->setFrom([Yii::$app->params['fromEmail'] . $this->site_url => $this->site_name])
                ->setSubject("Сообщение о регистрации пользователя на сайте ". $this->site_name)
                ->setTextBody($message)
                ->setHtmlBody(nl2br($message))
                ->send();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UsersManagement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->checkRights();

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()))
        {
            //return var_dump($model->selections);
            if ($model->password)
            {
                $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
                $model->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
            };
            if ($model->status == 0)
            {
                $model->password_hash = Yii::$app->security->generatePasswordHash(Yii::$app->security->generateRandomString());
                $model->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
            };
            if ($model->save())
            {
                if ($model->status != 0)
                {
                    // уведомляем пользователя об изменениях
                    $message = "Для Вашей учетной записи на сайте <a href='https://" . $this->site_url . "'>" . $this->site_name . "</a> были внесены изменения\n";
                    $message .= "Ваши регистрационные данные:\n";
                    $message .= "<b>Логин:</b> ".$model->username."\n";
                    if ($model->password) $message .= "<b>Новый пароль:</b> ".$model->password."\n";
                    $message .= "Пожалуйста, не сообщайте Ваш пароль третьим лицам.\nПри утрате пароля или подозрении о его компрометаци, обратитесь";
                    $message .= " к своему менеджеру в " . $this->site_name . " для генерации нового пароля.\n";
                    $message .= "\n";
                    $message .= "\n";
                    $message .= "Пожалуйста, не отвечайте на данное письмо, оно сгенерировано автоматически и отправлено с технического e-mail.\n";

                    Yii::$app->mailer->compose()
                    ->setTo($model->email)
                    ->setFrom([Yii::$app->params['fromEmail'] => $this->site_name]) // Коптелов К.В. 24.11.2022: настройка отправки через SendPulse
                    // ->setFrom([Yii::$app->params['fromEmail'] . $this->site_url => $this->site_name])
                    ->setSubject("Сообщение о смене пароля")
                    ->setTextBody($message)
                    ->setHtmlBody(nl2br($message))
                    ->send();
                }

                switch ($model->status)
                {
                    case 0: $status_name = 'Пользователь отключен'; break;
                    case 10: $status_name = 'Пользователь'; break;
                    case 20: $status_name = 'Менеджер'; break;
                    case 30: $status_name = 'Администратор'; break;
                }
                $message = "Произведено изменение учетной записи пользователя\n";
                $message .= "<b>Логин:</b> ".$model->username."\n";
                if ($model->password) $message .= "<b>Новый пароль:</b> ".$model->password."\n";
                $message .= "<b>E-mail:</b> ".$model->email."\n";
                $message .= "Статус пользователя: ".$model->status." -> ".$status_name."\n";
                if ($model->status != 0)$message .= "Сообщение о смене пароля на почту пользователя отправлено\n";
                $message .= "\n";
                $message .= "Изменения произведены Менеджером <b>".Yii::$app->user->identity->username."</b>\n";

                Yii::$app->mailer->compose()
                ->setTo(Yii::$app->params['adminEmail'])
                ->setCc(Yii::$app->user->identity->email)
                ->setFrom([Yii::$app->params['fromEmail'] => $this->site_name]) // Коптелов К.В. 24.11.2022: настройка отправки через SendPulse
                // ->setFrom([Yii::$app->params['fromEmail'] . $this->site_url => $this->site_name])
                ->setSubject("Сообщение об изменении учетной записи пользователя на сайте ". $this->site_name)
                ->setTextBody($message)
                ->setHtmlBody(nl2br($message))
                ->send();

                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                return $this->render('update', [
                    'model' => $model,
                ]);
            };
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UsersManagement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->checkRights();

        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionNewpass()
    {
        return str_replace(array('-', '_', '+', '='), "", substr(Yii::$app->security->generateRandomString(), 0, 10));
    }

    /**
     * Finds the UsersManagement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UsersManagement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $this->checkRights();

        if (($model = UsersManagement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Страница не существует.');
        }
    }
}

