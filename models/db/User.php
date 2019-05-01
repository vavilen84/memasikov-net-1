<?php

namespace app\models\db;

use app\models\gii as Models;
use Yii;

class User extends Models\UserGii implements \yii\web\IdentityInterface
{
    const SALT = 'bwP6FDW}!$J+7.GM';
    public $authKey;

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(!empty($this->password)){
                $this->password = md5($this->password . self::SALT);
            }

            return true;
        }
        return false;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function findByUsername($username)
    {
        $user = static::findOne(['email' => $username]);
        if (empty($user)) {
            $user = static::findOne(['nickname' => $username]);
        }

        return $user;
    }

    public function validatePassword($user, $password)
    {
        return $user->password === md5($password . self::SALT) ? true : false;
    }
}
