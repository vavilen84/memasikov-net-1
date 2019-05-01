<?php

namespace app\models\form;

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
    public $hidden;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body', 'hidden'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [

        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            $body = $this->email . '\n' .
                $this->name . '\n' .
                $this->subject . '\n'  .
                $this->body;
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom(['no-reply@example.com' => 'Contact Form'])
                ->setSubject($this->subject)
                ->setTextBody($body)
                ->send();

            return true;
        }
        return false;
    }
}
