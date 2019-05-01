<?php
namespace app\models\form;

use app\models\db as Models;
use yii\base\Model;

class ProfileForm extends Model
{
    public $nickname;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['nickname', 'email', 'password'], 'required'],
            [['email'], 'email'],
            [['email'], 'isEmailUnique'],
            [['password'], 'string', 'length' => [6, 12]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'nickname' => 'Nick name'
        ];
    }

    public function isEmailUnique()
    {
        $user = Models\User::find()->where(['email' => $this->email])->one();
        if ($user) {
            $this->addError('email', 'Email already exists!');
        }
    }

    public function register()
    {
        $user = new Models\User();
        $user->nickname = $this->nickname;
        $user->email = $this->email;
        $user->password = $this->password;;
        return $user->save() ? $user : null;
    }
}