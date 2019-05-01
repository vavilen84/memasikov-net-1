<?php
namespace app\controllers;

use Yii;

class AdminController extends BaseController
{
    public $pageTitle = 'Admin';

    public function beforeAction($action)
    {
        parent::beforeAction($action);
        $this->setDefaultParams();
        if (!Yii::$app->rolesControl->isAdminUser()) {
            echo 'You are not allowed to perform this action';
            Yii::$app->end();
        }

        return true;
    }

    protected function setDefaultParams()
    {
        $this->layout = 'admin';
    }

    public function actionDeleteLast()
    {
        Yii::$app->base->removeLastImage();

        return $this->redirect('/');
    }

    public function actionAddImageUrl()
    {
        Yii::app()->end();
        $this->pageTitle .= ' / Add Image URL';
        $model = new AddImageUrlForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Success!');
                $model = new AddImageUrlForm();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Error!');
            }
        }

        return $this->render('addImageUrl', [
            'addImageUrlForm' => $model
        ]);
    }
}
