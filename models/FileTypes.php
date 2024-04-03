<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file_types".
 *
 * @property int $id ID
 * @property string $type_name Тип раскрываемого файла
 *
 * @property Files[] $files
 */
class FileTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_name'], 'required'],
            [['type_name'], 'string', 'max' => 255],
            [['type_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_name' => 'Тип раскрываемого файла',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['file_type' => 'id']);
    }

    /**
     * @inheritdoc
     * @return FileTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FileTypesQuery(get_called_class());
    }
}
