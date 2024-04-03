<?php

namespace app\controllers;

use Yii;
use app\models\SfoSites;
use app\models\SfoSitesQuery;
use app\models\Files;
use app\models\FilesUpdate;
use app\models\FilesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\VarDumper;

/**
 * FilesController implements the CRUD actions for Files model.
 */
class FilesController extends Controller
{
    public function __construct($id, $module, $config = array()) {
        parent::__construct($id, $module, $config);
        
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
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'upload' => ['POST'],
                    'unlink' => ['POST'],
                ],
            ],
        ];
    }
    
    private function checkRights()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->status != 20 || $_SERVER['HTTP_X_REAL_IP'] != '195.68.154.162')
        {
            throw new ForbiddenHttpException('У Вас нет прав на просмотр данной страницы.');
        }
        
    }
    
    public function beforeAction($action)
    {
        if ($action->id == 'upload' || $action->id == 'unlink') {
            $this->enableCsrfValidation = false;
        }
        if ($action->id != 'upload' && $action->id != 'unlink') {
            $this->checkRights();
        }
        //$this->layout = '@app/views/layouts/files.php';
        return parent::beforeAction($action);
    }

    /**
     * Lists all Files models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->redirect('/site/index');
        
        $searchModel = new FilesSearch();
        $dataProvider = $searchModel->search_adm(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Files model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Files model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $docs = __DIR__ . "/../docs/";
        $model = new Files();
        $model ->file_realname = Yii::$app->security->generateRandomString();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model ->file_realname .= "." . $model->file->extension;
            $model->file_name = $model->site_id . "_" . $model->file_type;
            $model->file_name .= "_" . str_replace(".", "-", $model->file_date);
            if (isset($model->file_close) && $model->file_close != "") $model->file_name .= "_to_" . str_replace(".", "-", $model->file_close);
            $model->file_name .= "_" . str_replace(" ", "", $model->file->baseName) . "." . $model->file->extension;
            if ($model->save()) {
                $model->file->saveAs($docs . $model->file_realname);
                Yii::$app->session->setFlash('fileUploadSuccess');
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Files model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = FilesUpdate::findOne($id);//$this->findModel($id);
        $model->updatedate = date("Y-m-d H:i:s");
        $model->updateusername = Yii::$app->user->identity->username;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('fileUpdateSuccess');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Files model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Files model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Files the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Files::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionUpload()
    {
        $docs = __DIR__ . "/../docs/";
        $get = Yii::$app->request->get();
        $post = Yii::$app->request->post();
        // проверка что это alefsupport а не кто-то еще левый
        if (md5($get['access']) != '7c69fffb0c71210f92af3d7016e7b4c5') die ('access deny');
        // и еще одна проверка
        // if ($_SERVER['HTTP_X_REAL_IP'] != '195.68.154.162') die ('access only for TRINFICO');
        // а есть ли имя?
        if (!isset($post['Files']['file_name'])) die('Error file name');
        $file_name = $post['Files']['file_name'];
        // а есть ли файл?
        if (!isset($_FILES)) die("Error file upload! No files!");
        // а нет ли ошибки?
        if ($_FILES['Files']['error']['file'] != 0) die("Error file upload! Error code " . $_FILES['Files']['error']['file']);
        // пробуем сохранить
        if (!move_uploaded_file($_FILES['Files']['tmp_name']['file'], $docs . $file_name))
            die("Error uploaded file move!");
            // всё
            echo 'ok';
    }
    
    public function actionUnlink()
    {
        $docs = __DIR__ . "/../docs/";
        $get = Yii::$app->request->get();
        $post = Yii::$app->request->post();
        // проверка что это alefsupport а не кто-то еще левый
        if (md5($get['access']) != '7c69fffb0c71210f92af3d7016e7b4c5') die ('access deny');
        // и еще одна проверка
        if ($_SERVER['HTTP_X_REAL_IP'] != '195.68.154.162') die ('access only for TRINFICO');
        // имя-то есть?
        if (!isset($post['Files']['file_name'])) die('Error file name');
        $file_name = $post['Files']['file_name'];
        // а сам-то файл есть? если нет, говорим, что удалили ))
        if (!file_exists($docs . $file_name)) die('ok');
        // пробуем удалить
        if (!unlink($docs . $file_name))
            die("Delete file problem!");
            // всё
            echo 'ok';
    }
}
