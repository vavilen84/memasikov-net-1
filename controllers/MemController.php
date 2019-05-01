<?php
namespace app\controllers;

use Yii;
use app\components\Base;

class MemController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index', [

        ]);
    }

    public function actionCreate($id)
    {
        $baseImageContainer = Yii::$app->base->getBaseImageContainer($id);
        if (empty($baseImageContainer)) {
            return $this->redirect('/index/error');
        }

        return $this->render('create', [
            'baseImageContainer' => $baseImageContainer
        ]);
    }
}