<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class UsersManagement extends \yii\db\ActiveRecord
{
    public $password;
    //public $selections;
    //public $selections_reports;
    //public $notify_user = true;

    private $site_id;

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const STATUS_MANAGER = 20;
    //const STATUS_ADMIN = 30;

    public function __construct($config = [])
    {
        $session = Yii::$app->session;
        $this->site_id = $session->get('site_id');

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['username', 'auth_key', 'password_hash', 'email', 'created', 'status', 'site_id'], 'required'],
            [['status'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'created'], 'string', 'min' => 6, 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            //[['username', 'site_id'], 'unique'],
            //[['email', 'site_id'], 'unique'],
            [['password_reset_token'], 'unique'],
            //['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED, self::STATUS_MANAGER/*, self::STATUS_ADMIN*/]],
            ['site_id', 'default', 'value' => $this->site_id],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин пользователя',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'E-mail пользователя',
            'status' => 'Статус пользователя',
            'password' => 'Пароль',
            'created' => 'Создан Менеджером',
        ];
    }

    public function afterFind()
    {
        parent::afterFind();
        //$this->selections = explode("::", $this->rights);
        //$this->selections_reports = explode("::", $this->reports);
        return true;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            /*
            if (is_array($this->selections) && count($this->selections) > 0)
                $this->rights = implode("::", $this->selections);
            else
                $this->rights = $this->selections;

            if (is_array($this->selections_reports) && count($this->selections_reports) > 0)
                $this->reports = implode("::", $this->selections_reports);
            else
                $this->reports = $this->selections_reports;
            */
            return true;
        }
        else
            return false;
    }

//     public function beforeValidate()
//     {
//         if ($this->isNewRecord)
//         {
//             $this->password_hash = setPassword($this->password);
//             $this->auth_key = generateAuthKey();
//         }
//         else
//         {
//             if ($this->password) $this->password_hash = setPassword($this->password);
//         };
//     }
}
