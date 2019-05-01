<?php
namespace app\controllers;

use app\models\form as Models;
use Yii;

class UserController extends BaseController
{
    public function actionLogin()
    {
        $model = new Models\LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->login()) {
                return $this->goHome();
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        if (Yii::$app->user->logout()) {
            return $this->goHome();
        }
    }
}