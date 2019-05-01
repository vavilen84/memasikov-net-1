<?php
namespace app\controllers;

use Yii;
use yii\helpers\Json;
use app\components\Base;

class UploadController extends BaseController
{
    public function actionUploadVk()
    {
        $imageUrl = Yii::$app->request->getBodyParam('imageUrl');
        $hash = Yii::$app->request->getBodyParam('hash');
        if (!empty($imageUrl) && ($hash == Base::UPLOAD_HASH)) {
            $tags = Yii::$app->request->getBodyParam('tags');
            Yii::$app->base->saveImageByUrl($imageUrl, $tags);
        }
        echo Json::encode(['status' => 'success']);
        Yii::$app->end();
    }

    public function actionUploadVasyaLozkin()
    {
        $imageUrl = Yii::$app->request->getBodyParam('imageUrl');
        $hash = Yii::$app->request->getBodyParam('hash');
        if (!empty($imageUrl) && ($hash == Base::UPLOAD_HASH)) {
            $author = Yii::$app->base->getAuthorContainer(Base::AUTHOR_VASYA_LOZKIN);
            $params = [
                'image_url' => $author->domen . $imageUrl,
                'tags' => Yii::$app->request->getBodyParam('tags'),
                'title' => Yii::$app->request->getBodyParam('title'),
                'created_text' => Yii::$app->request->getBodyParam('created'),
                'page_url' => $pageUrl = Yii::$app->request->getBodyParam('pageUrl')
            ];
            Yii::$app->base->createVasyaLozkinImage($params);

        }
        echo Json::encode(['status' => 'success']);
        Yii::$app->end();
    }

    public function actionUploadNewMem()
    {
        $result = [
            'status' => 'error',
            'uid' => null,
            'errorMessage' => 'Ошибка. Что то поломалось и не работает :-('
        ];
        $hash = Yii::$app->request->getBodyParam('hash');
        $json = Yii::$app->request->getBodyParam('json');
        $baseImageId = Yii::$app->request->getBodyParam('baseImageId');
        if (Yii::$app->base->isUploadNemMemDataValid($hash, $json, $baseImageId)) {
            if (Yii::$app->base->validateUserImageText($json)) {
                if ($model = Yii::$app->base->createUserImage($json, $baseImageId)) {
                    $result['uid'] = $model->uid;
                    $result['status'] = 'success';
                }
            } else {
                $result['errorMessage'] = 'Матюкаться очень некрасиво.... Не надо так :-(';
            }

        }
        echo Json::encode($result);
        Yii::$app->end();
    }
}
