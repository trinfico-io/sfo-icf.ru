<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    public $verifyCode;
    public $reCaptcha;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],

            // verifyCode needs to be entered correctly
            // ['verifyCode', 'captcha'],
            ['verifyCode', 'captcha', 'when' => function() {
                    if( strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')!==false ||
                        strpos($_SERVER['HTTP_USER_AGENT'],'rv:11.0')!==false ||
                        strpos($_SERVER['HTTP_USER_AGENT'],'Trident')!==false
                    ) return true;
                    return false;
                }
            ],
            // reCaptcha
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6Ldsm0wUAAAAAM2mduLpeOoVInnRKBH7D_HwmFxB',
                'uncheckedMessage' => 'Пожалуйста, пройдите анти-спам проверку',
                'when' => function() {
                    if( strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')!==false ||
                        strpos($_SERVER['HTTP_USER_AGENT'],'rv:11.0')!==false ||
                        strpos($_SERVER['HTTP_USER_AGENT'],'Trident')!==false
                    ) return false;
                    return true;
                }
            ],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Не правильное имя пользователя или пароль.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
