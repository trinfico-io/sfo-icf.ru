<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property int $site_id ����� �����, �� ������� �������� ����
 * @property int $file_type ��� ������������� ����� (������)
 * @property string $file_name ��� �����
 * @property string $file_realname ���������� ��� �����
 * @property string $file_description �������� / ����������� � �����
 * @property string $file_loaddate ����/����� �������� �����
 * @property string $file_date ���� ����������
 * @property string $file_close ���� ��������� ����������
 * @property string $username ������������, ������������� ����������
 * @property string $updateusername ������������, ������� ���������� ������
 * @property string $updatedate ���� � ����� �������� ���������
 *
 * @property FileTypes $fileType
 * @property SfoSites $site
 */
class FilesUpdate extends \yii\db\ActiveRecord
{
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
            [['site_id', 'file_type', 'file_name', 'file_realname', 'file_description', 'file_loaddate', 'file_date', 'username', 'updateusername', 'updatedate'], 'required'],
            [['site_id', 'file_type'], 'integer'],
            [['file_loaddate', 'file_date', 'file_close', 'updatedate', 'file'], 'safe'],
            [['file_name', 'file_realname', 'username', 'updateusername'], 'string', 'max' => 255],
            [['file_description'], 'string', 'max' => 1024],
            [['file_type'], 'exist', 'skipOnError' => true, 'targetClass' => FileTypes::className(), 'targetAttribute' => ['file_type' => 'id']],
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
            'site_id' => '����� �����, �� ������� �������� ����',
            'file_type' => '��� ������������� �����',
            'file_name' => '��� �����',
            'file_realname' => '���������� ��� �����',
            'file_description' => '�������� / ����������� � �����',
            'file_loaddate' => '����/����� �������� �����',
            'file_date' => '���� ����������',
            'file_close' => '���� ��������� ����������',
            'username' => '������������, ������������� ����������',
            'updateusername' => '������������, ������� ���������� ������',
            'updatedate' => '���� � ����� �������� ���������',
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
