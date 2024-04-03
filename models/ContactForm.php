<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    public $reCaptcha;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
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
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'email' => 'Адрес электронной почты',
            'subject' => 'Тема сообщения',
            'body' => 'Текст сообщения',
            'verifyCode' => 'Код подтверждения',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        $session = Yii::$app->session;
        $site_name = $session->get('site_name');
        if (!$site_name) $site_name = "СФО-ИКФ";
        $subject = 'Письмо с сайта ' . $site_name . ': '.$this->subject;
        $from = 'Посетитель, представившийся "' . $this->name . '" с e-mail ' . $this->email . ' отправил через форму обратной связи следующее сообщение:' . "\n\n"; // Коптелов К.В. 24.11.2022: настройка отправки через SendPulse
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom(Yii::$app->params['fromEmail']) // Коптелов К.В. 24.11.2022: настройка отправки через SendPulse
                ->setReplyTo($this->email)
                //->setFrom([$this->email => $this->name])
                //->setSubject($this->subject)
                ->setSubject($subject)
                ->setTextBody($from . $this->body)
                //->setTextBody($this->body)
                ->send();
        //  + добавляем отправку копии сообщения админу
            Yii::$app->mailer->compose()
                ->setTo(Yii::$app->params['adminEmail'])
                ->setFrom(Yii::$app->params['fromEmail']) // Коптелов К.В. 24.11.2022: настройка отправки через SendPulse
                ->setReplyTo($this->email)
                // ->setFrom([$this->email => $this->name])
                //->setSubject($this->subject)
                ->setSubject($subject)
                ->setTextBody($from . $this->body)
                // ->setTextBody($this->body)
                ->send();
            return true;
        }
        return false;
    }

}
