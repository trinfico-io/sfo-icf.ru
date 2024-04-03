<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "downloads".
 *
 * @property int $id
 * @property int $site_id
 * @property string $download_date
 * @property string $filename
 * @property string $user_ip
 * @property string $user_info
 * @property string $result
 *
 * @property SfoSites $site
 */
class DownloadsLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'downloads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_id', 'filename', 'user_ip', 'user_info', 'result'], 'required'],
            [['site_id'], 'integer'],
            [['download_date'], 'safe'],
            [['filename'], 'string', 'max' => 255],
            [['user_ip'], 'string', 'max' => 20],
            [['user_info'], 'string', 'max' => 1000],
            [['result'], 'string', 'max' => 100],
            [['site_id'], 'exist', 'skipOnError' => true, 'targetClass' => SfoSites::className(), 'targetAttribute' => ['site_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site_id' => 'Site ID',
            'download_date' => 'Download Date',
            'filename' => 'Filename',
            'user_ip' => 'User Ip',
            'user_info' => 'User Info',
            'result' => 'Result',
        ];
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
     * @return DownloadsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DownloadsQuery(get_called_class());
    }
}
