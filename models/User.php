<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const STATUS_MANAGER = 20;
    //const STATUS_ADMIN = 30;

    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'username' => 'Имя пользователя',
            'email' => 'Адрес электронной почты',
            'password' => 'Пароль',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            //['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED, self::STATUS_MANAGER/*, self::STATUS_ADMIN*/]],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        //return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
        return static::findOne(['id' => $id, 'status' => [self::STATUS_ACTIVE, self::STATUS_DELETED, self::STATUS_MANAGER/*, self::STATUS_ADMIN*/]]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        //return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
        //return static::findOne(['username' => $username, 'status' => [self::STATUS_ACTIVE, self::STATUS_MANAGER, self::STATUS_ADMIN]]);
        $session = Yii::$app->session;
        $site_id = $session->get('site_id');
        //return static::find()->where('username=:username OR email=:username', [":username"=>$username])->one();
        return static::find()->where('(username=:username OR email=:username) AND site_id=:site_id AND status IN (10, 20)', [":username"=>$username, ":site_id"=>$site_id])->one();
    }

    public static function findByEmail($email)
    {
        $session = Yii::$app->session;
        $site_id = $session->get('site_id');
        //return static::findOne(['email' => $email, 'status' => [self::STATUS_ACTIVE/*, self::STATUS_MANAGER, self::STATUS_ADMIN*/]]);
        return static::findOne(['email' => $email, 'status' => [self::STATUS_ACTIVE, self::STATUS_MANAGER], 'site_id' => $site_id]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

}