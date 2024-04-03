<?php
use yii\grid\GridView;
use yii\helpers\Html;

use app\models\Files;
use app\models\FilesSearch;

$session = Yii::$app->session;
$site_id = $session->get('site_id');

$searchModel = new FilesSearch();
$dataProvider = $searchModel->search_adm(['FilesSearch' => ['site_id' => $site_id, 'file_type' => $fileType[0],]]);
$dataProvider->pagination = ['pageSize' => 5];

$this->title = $titleBlock[0];

?>
<!-- <div width="500px"> -->
<div class="files-adm" style="width:90%; margin-bottom: 35px;">
    <h3 style="margin-top: 50px;"><?= $titleBlock[0]; ?></h3>
    
    <div class="row files-legend">
    	<div class="col-lg-2">
    		<?= Html::a('Загрузить новый файл', ['files/create?file_type='.$fileType[0]], ['class' => 'btn btn-success']) ?>
    	</div>
    	<div class="col-lg-1">
    		&nbsp;
    	</div>
    	<div class="col-lg-3" style="border: solid 1px white; text-align: center; vertical-align: middle;" title="Легенда таблицы">
    		Файл опубликован, доступен
    	</div>
    	<div class="col-lg-3" style="background-color: #ade4eb; border: solid 1px white; text-align: center; vertical-align: middle;" title="Легенда таблицы">
    		Файл не доступен: дата раскрытия не наступила
    	</div>
    	<div class="col-lg-3" style="background-color: #a19f84; border: solid 1px white; text-align: center; vertical-align: middle;" title="Легенда таблицы">
    		Файл не доступен: наступила дата скрытия
    	</div>
    </div>
    
    <div class="row files-list">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'showHeader' => false,
        //'rowOptions' => ['style' => 'background-color:transparent;'],
        'rowOptions' => function($model) {
            $return = ['style' => 'background-color:transparent;'];
            $public = strtotime($model->file_date);
            $close = strtotime($model->file_close);
            $now = time();
            if (!is_null($model->file_close) && $close < $now) 
                $return = [
                    'style' => 'background-color: #a19f84; text-decoration: line-through;',
                    'title' => 'Дата скрытия наступила',
                ];
                if ($public > $now)
                $return = [
                    'style' => 'background-color: #ade4eb;',
                    'title' => 'Дата раскрытия не наступила',
                ];
            return $return;
        },
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            //'site_id',
            //'file_type',
            //'file_name',
            //'file_realname',
            //'file_description',
            [
                'label' => 'Файл для скачивания',
                'format' => 'raw',
                'headerOptions' => ['width' => '600px'],
                'value' => function($data) {
                $fl = array_reverse (explode(".", strtolower($data->file_name)));
                    switch(strtolower($fl[0])) {
                        case "xml":
                        case "doc":
                        case "docx":
                        case "gif":
                        case "jpg":
                        case "jpeg":
                        case "pdf":
                        case "tif":
                        case "tiff":
                        case "xls":
                        case "xlsx":
                        case "zip":
                        case "rar":
                        case "7z":
                            $bg = strtolower($fl[0]).".gif";
                            break;
                        default:
                            $bg = "etc.gif";
                    };
                    $stile = "background-image: url(/img/i/".$bg."); background-repeat: no-repeat; background-position: left; padding-left: 30px;";
                    return Html::a($data->file_description, '/site/getfile?id='.$data->id, ['title' => $data->file_name, 'target' => '_blank', 'style' => $stile]);
                },
            ],
            //'file_loaddate',
            [
                'attribute' => 'file_loaddate',
                'label' => 'Загружен',
                //'format' => ['datetime', "php:d.m.Y H:i:s"],
                'format' => "text",
                'headerOptions' => ['width' => '125px'],
                'enableSorting' => false,
            ],
            //'file_date',
            [
                'attribute' => 'file_date',
                'label' => 'Дата раскрытия',
                'format' => ['date', 'dd.MM.YYYY'],
                'headerOptions' => ['width' => '125px'],
                'enableSorting' => false,
            ],
            //'file_close',
            [
                'attribute' => 'file_close',
                'label' => 'Дата скрытия',
                'format' => ['date', 'dd.MM.YYYY'],
                'headerOptions' => ['width' => '125px'],
                'enableSorting' => false,
            ],
            //'username',
            [
                'attribute' => 'username',
                'label' => 'Автор',
                'enableSorting' => false,
            ],
            //'updateusername',
            [
                'attribute' => 'updateusername',
                'label' => 'Изменил',
                'enableSorting' => false,
            ],
            //'updatedate',
            [
                'attribute' => 'updatedate',
                'label' => 'Изменено',
                'format' => ['datetime', "php:d.m.Y H:i:s"],
                'enableSorting' => false,
            ],

            ['class' => 'yii\grid\ActionColumn',
                //'header' => 'Действия',
                'headerOptions' => ['width' => '60px'],
                //'template' => '<p align="center">{view} {update} </p>',
                'template' => '{view} {update}',
                'buttons' => [
                    'view' => function ($url) {
                        $svg = '&#128270;';
                        $svg = '<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1.125em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M573 241C518 136 411 64 288 64S58 136 3 241a32 32 0 000 30c55 105 162 177 285 177s230-72 285-177a32 32 0 000-30zM288 400a144 144 0 11144-144 144 144 0 01-144 144zm0-240a95 95 0 00-25 4 48 48 0 01-67 67 96 96 0 1092-71z"></path></svg>';
                        return Html::a($svg, str_replace('site', 'files', $url));
                    },
                    'update' => function ($url) {
                        $svg = '&#9997;';
                        $svg = '<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M498 142l-46 46c-5 5-13 5-17 0L324 77c-5-5-5-12 0-17l46-46c19-19 49-19 68 0l60 60c19 19 19 49 0 68zm-214-42L22 362 0 484c-3 16 12 30 28 28l122-22 262-262c5-5 5-13 0-17L301 100c-4-5-12-5-17 0zM124 340c-5-6-5-14 0-20l154-154c6-5 14-5 20 0s5 14 0 20L144 340c-6 5-14 5-20 0zm-36 84h48v36l-64 12-32-31 12-65h36v48z"></path></svg>';
                        return Html::a($svg, str_replace('site', 'files', $url));
                    }
                ],
            ],
        ],
        'emptyText' => 'Файлов пока нет',
        //'options' => ['width' => '900px'],
    ]); ?>
    </div>
</div>

