<?php
namespace app\controllers;

use Yii;
use app\components\Base;

class IndexController extends BaseController
{
    public function actionIndex()
    {
        $params = Yii::$app->base->getImagesPagesParams();
        $this->heading = 'Все мемы , картинки , фото . ' . Yii::$app->base->getPageNumberText();
        $this->ogImage = Yii::$app->base->getImageUrl($params['currentImageContainer']);
        $params['imageContainers'] = Yii::$app->base->setImagesNumbers(
            $params['imageContainers'],
            Yii::$app->request->getQueryParam('page', 1)
        );
        $currentImageNumber = Yii::$app->request->getQueryParam('currentImageNumber', 1);
        if(!empty($currentImageNumber) && !empty($params['imageContainers'][$currentImageNumber])){
            $params['currentImageContainer'] = $params['imageContainers'][$currentImageNumber];
        }

        return $this->render('index', $params);
    }

    public function actionTag($tag)
    {
        $this->redirect('/', 301);
        Yii::$app->base->checkActualUrls($tag);
        $this->description .= ' . ' . Yii::$app->base->getTagDescription($tag);
        $this->heading = 'Мемы , картинки , фото по тегу: ' . ucfirst($tag) . ' . ' . Yii::$app->base->getPageNumberText();
        $params = Yii::$app->base->getImagesPagesParams($tag);
        if (empty($params['imageContainers'])) {
            return $this->render('error');
        }
        $this->ogImage = Yii::$app->base->getImageUrl($params['currentImageContainer']);

        return $this->render('index', $params);
    }

    public function actionImage($uid)
    {
        $this->redirect('/', 301);
        $imageContainer = Yii::$app->base->getImageByUid($uid);
        if (empty($imageContainer)) {
            return $this->render('error');
        }
        $this->heading = $this->description;
        $this->ogImage = Yii::$app->base->getImageUrl($imageContainer);

        return $this->render('image', [
            'imageContainer' => $imageContainer
        ]);
    }

    public function actionAuthor($author)
    {
        $author = Yii::$app->base->getAuthorByUrl($author);
        if (empty($author)) {
            return $this->render('error');
        }
        $lastImageActive = Yii::$app->request->getQueryParam('lastImageActive');
        $query = Yii::$app->base->getAuthorImagesBaseQuery($author);
        $imageContainers = Yii::$app->base->getAuthorImages($query);
        if (empty($imageContainers)) {
            return $this->render('error');
        }
        $pages = Yii::$app->base->getPages($query);
        $currentImageUid = Yii::$app->request->getQueryParam('image', null);
        if(!empty($currentImageUid) && !empty($imageContainers[$currentImageUid])){
            $currentImageContainer = $imageContainers[$currentImageUid];
        } else {
            $currentImageContainer = !empty($lastImageActive) ? end($imageContainers) : current($imageContainers);
        }

        $this->heading = $this->description;
        $this->ogImage = Yii::$app->base->getAuthorImageUrl($currentImageContainer);

        $currentImageNumber = Yii::$app->request->getQueryParam('currentImageNumber', 1);
        if(!empty($currentImageNumber) && !empty($imageContainers[$currentImageNumber])){
            $params['currentImageContainer'] = $imageContainers[$currentImageNumber];
        }

        return $this->render('author', [
            'tag' => null,
            'lastImageActive' => $lastImageActive,
            'showControls' => Yii::$app->request->getQueryParam('showControls'),
            'imageContainers' => $imageContainers,
            'pages' => $pages,
            'lastPageNumber' => ceil($pages->totalCount / $pages->defaultPageSize),
            'currentImageContainer' => $currentImageContainer
        ]);
    }


    public function actionUserImage($uid)
    {
        $userImageContainer = Yii::$app->base->getUserImageByUid($uid);
        if (empty($userImageContainer) || empty($userImageContainer->baseImageId)) {
            return $this->render('error');
        }
        $baseImageContainer = Yii::$app->base->getBaseImageContainer($userImageContainer->baseImageId);
        if (empty($baseImageContainer)) {
            return $this->render('error');
        }
        $this->heading = $this->description;
        $this->ogImage = Yii::$app->base->getBaseImageUrl($baseImageContainer);

        return $this->render('user_image', [
            'userImageContainer' => $userImageContainer,
            'baseImageContainer' => $baseImageContainer
        ]);
    }

    public function actionError()
    {
        return $this->render('error');
    }
}
