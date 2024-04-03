<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property int $site_id Домен сайта, на котором размещен файл
 * @property int $file_type Тип раскрываемого файла (ссылка)
 * @property string $file_name Имя файла
 * @property string $file_realname Физическое имя файла
 * @property string $file_description Описание / комментарий к файлу
 * @property string $file_loaddate Дата/время загрузки файла
 * @property string $file_date Дата публикации
 * @property string $file_close Дата окончания публикации
 * @property string $username Пользователь, осуществивший публикацию
 * @property string $updateusername Пользователь, крайним изменявший запись
 * @property string $updatedate Дата и время крайнего изменения
 *
 * @property FileTypes $fileType
 * @property SfoSites $site
 */
class Files extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_id', 'file_type', 'file_name', 'file_realname', 'file_description', 'file_loaddate', 'file_date', 'username'], 'required'],
            [['site_id', 'file_type'], 'integer'],
            [['file_loaddate', 'file_date', 'file_close', 'updatedate', 'file'], 'safe'],
            [['file_name', 'file_realname', 'username', 'updateusername'], 'string', 'max' => 255],
            [['file_description'], 'string', 'max' => 1024],
            [['file_type'], 'exist', 'skipOnError' => true, 'targetClass' => FileTypes::className(), 'targetAttribute' => ['file_type' => 'id']],
            [['site_id'], 'exist', 'skipOnError' => true, 'targetClass' => SfoSites::className(), 'targetAttribute' => ['site_id' => 'id']],
            
            [['file'], 'file', 'skipOnEmpty' => false,], // 'minSize' => 10, 'maxSize' => (1024*1024*1024*160), 'tooBig' => 'Сликом большой файл!', 'tooSmall' => 'Слишком маленький файл!'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site_id' => 'Домен сайта, на котором размещен файл',
            'file_type' => 'Тип раскрываемого файла',
            'file_name' => 'Имя файла',
            'file_realname' => 'Физическое имя файла',
            'file_description' => 'Описание / комментарий к файлу',
            'file_loaddate' => 'Дата/время загрузки файла',
            'file_date' => 'Дата публикации',
            'file_close' => 'Дата окончания публикации',
            'username' => 'Пользователь, осуществивший публикацию',
            'updateusername' => 'Пользователь, крайним изменявший запись',
            'updatedate' => 'Дата и время крайнего изменения',
            
            'file' => 'Выберите файл',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileType()
    {
        return $this->hasOne(FileTypes::className(), ['id' => 'file_type']);
    }
    
    public function getFileTypeName()
    {
        return $this->getFileType()->type_name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(SfoSites::className(), ['id' => 'site_id']);
    }

    /**
     * @inheritdoc
     * @return FilesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FilesQuery(get_called_class());
    }
}
