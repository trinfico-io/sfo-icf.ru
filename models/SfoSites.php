<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sfo_sites".
 *
 * @property int $id ID сайта
 * @property string $domain Домен сайта
 * @property string $name Название сайта
 * @property int $enabled
 *
 * @property Files[] $files
 */
class SfoSites extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sfo_sites';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['domain', 'name'], 'required'],
            [['domain', 'name'], 'string', 'max' => 255],
            [['enabled'], 'string', 'max' => 4],
            [['domain'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID сайта',
            'domain' => 'Домен сайта',
            'name' => 'Название сайта',
            'enabled' => 'Enabled',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['site_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SfoSitesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SfoSitesQuery(get_called_class());
    }
}
