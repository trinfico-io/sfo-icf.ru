<?php

// Калугин Д.Е, 23.10.2018 файл переименован по письму Ольги. Старое название 1ae82ac.php

use kartik\tabs\TabsX;

$session = Yii::$app->session;
$site_id = $session->get('site_id');

/* @var $this yii\web\View */
if (isset($test))
    $test = " - тестовая страница";
else
    $test = ".";

$this->title = 'Информация о компании'.$test;
?>
<div class="site-index">
    <div class="body-content">
<?


// иконки: http://getbootstrap.ru/docs/3.3.7/components/
$tab_options = ['style' => 'margin-left:50px; margin-right:20px; max-width:1200px; padding-left: 20px;'];
$items = [
//     Информация для заемщиков
    [
        'label'=>'<i class="glyphicon glyphicon-info-sign"></i> Информация для заемщиков',
        'content'=>$this->render('about/_index'),
        'options' => $tab_options,
        'active'=>true
    ],
//     Учредительные документы
        [
        'label'=>'<i class="glyphicon glyphicon-registration-mark"></i> Учредительные документы',
        'content'=>$this->render('about/_files', ['titleBlock' => ['Учредительные документы'], 'fileType' => ['1']]),
        'options' => $tab_options,
        ],
    //     Внутренние документы
        [
        'label'=>'<i class="glyphicon glyphicon-lock"></i> Внутренние документы',
        'content'=>$this->render('about/_files', ['titleBlock' => ['Внутренние документы'], 'fileType' => ['2']]),
        'options' => $tab_options,
        ],
    //     Бухгалтерская отчетность
        [
        'label'=>'<i class="glyphicon glyphicon-calendar"></i> Бухгалтерская отчетность',
        'content'=>$this->render('about/_files', ['titleBlock' => ['Бухгалтерская отчетность'], 'fileType' => ['3']]),
        'options' => $tab_options,
        ],
    //     Эмиссионная документация
        [
        'label'=>'<i class="glyphicon glyphicon-new-window"></i> Эмиссионная документация',
        'content'=>$this->render('about/_files', ['titleBlock' => ['Эмиссионная документация'], 'fileType' => ['4']]),
        'options' => $tab_options,
        ],
    //     Ежеквартальные отчеты
        [
        'label'=>'<i class="glyphicon glyphicon-th-list"></i> <span style="font-size:small;">Ежеквартальные отчеты',
        'content'=>$this->render('about/_files', ['titleBlock' => ['Ежеквартальные отчеты'], 'fileType' => ['5']]),
        'options' => $tab_options,
        ],
    //     Аффилированные лица
        [
        'label'=>'<i class="glyphicon glyphicon-user"></i> <span style="font-size:smaller;">Аффилированные лица</span>',
        'content'=>$this->render('about/_files', ['titleBlock' => ['Аффилированные лица'], 'fileType' => ['6']]),
        'options' => $tab_options,
        ],
    //     Существенные факты
        [
        'label'=>'<i class="glyphicon glyphicon-check"></i> Существенные факты',
        'content'=>$this->render('about/_files', ['titleBlock' => ['Существенные факты'], 'fileType' => ['7']]),
        'options' => $tab_options,
        ],
//     Прочие файлы
    [
    'label'=>'<i class="glyphicon glyphicon-tree-deciduous"></i> Прочие файлы',
    'content'=>$this->render('about/_files', ['titleBlock' => ['Прочие документы'], 'fileType' => ['8']]),
    'options' => $tab_options,
    ],
];

echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_LEFT,
    //'position'=>TabsX::POS_RIGHT,
    'bordered'=>true,
    'encodeLabels'=>false
]);
?>
    </div>
</div>