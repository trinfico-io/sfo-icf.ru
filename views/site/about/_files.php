<?php
use yii\grid\GridView;
use yii\helpers\Html;

use app\models\Files;
use app\models\FilesSearch;

$session = Yii::$app->session;
$site_id = $session->get('site_id');

$searchModel = new FilesSearch();
$dataProvider = $searchModel->search(['FilesSearch' => ['site_id' => $site_id, 'file_type' => $fileType[0],], 'order' => ['_file_date']]);

?>
<div width="500px">
    <h3 title="<?= $site_id.",".$fileType[0] ?>"><?= $titleBlock[0]; ?></h3>
    <p></p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'showHeader' => false,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'site_id',
            //'file_type',
            //'file_name',
            //'file_realname',
            //'file_description',
            [
                'label' => 'Файл для скачивания',
                'format' => 'raw',
                'headerOptions' => ['width' => '765px'],
                'value' => function($data) {
                    $fl = array_reverse (explode(".", $data->file_name));
                    switch($fl[0]) {
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
                            $bg = $fl[0].".gif";
                            break;
                        default:
                            $bg = "etc.gif";
                    };
                    $stile = "background-image: url(/img/i/".$bg."); background-repeat: no-repeat; background-position: left; padding-left: 20px;";
                    return Html::a($data->file_description, '/site/getfile?id='.$data->id, ['title' => $data->file_name, 'target' => '_blank', 'style' => $stile]);
                },
            ],
            //'file_loaddate',
            //'file_date',
            [
                'attribute' => 'file_date',
                'format' => ['date', 'd.MM.Y'],
                'headerOptions' => ['width' => '125px'],
                'enableSorting' => false,
            ],
            //'file_close',
            //'username',
            //'updateusername',
            //'updatedate',

            //['class' => 'yii\grid\ActionColumn'],
        ],
        'emptyText' => 'Файлов пока нет',
        'options' => ['width' => '900px'],
    ]); ?>
</div>

