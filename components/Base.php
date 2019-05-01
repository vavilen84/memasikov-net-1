<?php
namespace app\components;

use app\components\BaseComponentaData;
use app\containers\BaseImageContainer;
use app\containers\AuthorContainer;
use app\containers\AuthorImageContainer;
use app\containers\UserImageContainer;
use app\containers\ImageContainer;
use app\containers\FileContainer;
use Yii;
use app\models\db as Models;
use yii\sphinx\Query;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\helpers\Json;
use  yii\helpers\Html;

class Base extends BaseComponentData
{
    protected $totalImagesCount;

    /**
     * @param $userId
     * @return string
     */
    public function getUserNickname($userId)
    {
        $user = Models\User::findIdentity($userId);

        return $user ? $user->nickname : '';
    }

    /**
     * @param $url
     * @param $tags
     * @return ImageContainer|void
     */
    public function saveImageByUrl($url, $tags)
    {
        if ($result = $this->downloadFileByUrl($url)) {
            $params = [
                'tags' => $tags,
                'uid' => $result->uid,
                'ext' => $result->ext
            ];
            $model = $this->saveImageModel($params);
            if (!empty($model)) {
                return $this->getImageContainerFromModel($model);
            }
        }
    }

    /**
     * @param $params
     * @return AuthorImageContainer|void
     */
    public function createVasyaLozkinImage($params)
    {
        if ($fileContainer = $this->downloadAuthorFile($params)) {
            $params['uid'] = $fileContainer->uid;
            $model = $this->saveAuthorImageModel($params);
            if (!empty($model)) {
                return $this->getAuthorImageContainerFromModel($model);
            }
        }
    }

    /**
     * @return string
     */
    public function getImageUploadFolder()
    {
        $folder = self::BASE_FOLDER
            . self::WEB_FOLDER
            . self::IMAGE_UPLOAD_FOLDER . '/'
            . date('Y') . '/'
            . date('n') . '/'
            . date('j') . '/';
        if (!is_dir($folder)) {
            mkdir($folder, 0775, true);
            system('chown -R www-data:www-data ' . $folder);
        }

        return $folder;
    }

    /**
     * @return string
     */
    public function getAuthorImageUploadFolder()
    {
        $folder = self::BASE_FOLDER
            . self::WEB_FOLDER
            . self::AUTHOR_IMAGE_UPLOAD_FOLDER . '/'
            . date('Y') . '/'
            . date('n') . '/'
            . date('j') . '/';
        if (!is_dir($folder)) {
            mkdir($folder, 0775, true);
            system('chown -R www-data:www-data ' . $folder);
        }

        return $folder;
    }

    /**
     * @param $url
     * @return string
     */
    public function getExtensionByUrl($url)
    {
        $pathinfo = pathinfo($url);
        if (!empty($pathinfo['extension'])) {
            return $pathinfo['extension'];
        }
    }

    /**
     * @param $url
     * @return FileContainer|void
     */
    public function downloadFileByUrl($url)
    {
        $ext = $this->getExtensionByUrl($url);
        if (empty($ext)) {
            return;
        }
        $uploadFolder = $this->getImageUploadFolder();
        $uid = $this->getUniqueName();
        $filename = $uploadFolder . $uid . '.' . $ext;
        $image = file_get_contents($url);
        if (file_put_contents($filename, $image)) {
            $params = [
                'uid' => $uid,
                'ext' => $ext
            ];
            return $this->getFileContainer($params);
        }
    }

    /**
     * @param $params
     * @return FileContainer|void
     */
    public function downloadAuthorFile($params)
    {
        $ext = $this->getExtensionByUrl($params['image_url']);
        if (empty($ext)) {
            return;
        }
        $uploadFolder = $this->getAuthorImageUploadFolder();
        $uid = $this->getUniqueName();
        $filename = $uploadFolder . $uid . '.' . $ext;
        $image = file_get_contents($params['image_url']);
        if (file_put_contents($filename, $image)) {
            $params = [
                'uid' => $uid,
                'ext' => $ext
            ];
            return $this->getFileContainer($params);
        }
    }

    /**
     * @param $json
     * @param $baseImageId
     * @return UserImageContainer|void
     */
    public function createUserImage($json, $baseImageId)
    {
        $params = [
            'json' => $json,
            'base_image_id' => $baseImageId
        ];
        $model = $this->saveUserImageModel($params);
        if (!empty($model)) {
            return $this->getUserImageContainerFromModel($model);
        }
    }

    /**
     * @param $hash
     * @param $json
     * @param $baseImageId
     * @return bool
     */
    public function isUploadNemMemDataValid($hash, $json, $baseImageId)
    {
        if (
            !empty($hash)
            && ($hash == Base::UPLOAD_MEM_HASH)
            && !empty($json)
            && !empty($baseImageId)
            && !empty(self::BASE_IMAGES[$baseImageId])
        ) {
            return true;
        }

        return false;
    }

    public function getUploadedImageUrl($created, $uid, $ext, $uploadFolder)
    {
        return $this->getSelfDomen() . $uploadFolder
        . '/' . date('Y', $created)
        . '/' . date('n', $created)
        . '/' . date('j', $created)
        . '/' . $uid . '.' . $ext;
    }

    /**
     * @param ImageContainer $container
     * @return string
     */
    public function getImageUrl(ImageContainer $container)
    {
        return $this->getUploadedImageUrl($container->created, $container->uid, $container->ext, self::IMAGE_UPLOAD_FOLDER);
    }

    public function getDefaultOgImageUrl()
    {
        return $this->getSelfDomen() . '/img/k4.jpg';
    }

    /**
     * @param AuthorImageContainer $container
     * @return string
     */
    public function getAuthorImageUrl(AuthorImageContainer $container)
    {
        return $this->getUploadedImageUrl($container->created, $container->uid, $container->ext, self::AUTHOR_IMAGE_UPLOAD_FOLDER);
    }

    /**
     * @return string
     */
    public function getTotalImagesText()
    {
        return $this->getTotalImagesCount() . ' мемасиков и картинок';
    }

    /**
     * @return mixed
     */
    public function getTotalImagesCount()
    {
        return $this->totalImagesCount;
    }

    /**
     * @return void
     */
    public function setTotalImagesCount()
    {
        $query = new Query();
        $count = $query->from(self::IMAGE_INDEX)->count();

        $authorImageModel = new Models\AuthorImage();
        $count += $authorImageModel::find()->count();

        $this->totalImagesCount = $count;
    }

    /**
     * @return string
     */
    public function getImagePageUrl()
    {
        if(!empty(Yii::$app->request->queryString)){
            return $this->getSelfDomen() . '/?' . Yii::$app->request->queryString;
        } else {
            return $this->getSelfDomen();
        }
    }

    /**
     * @param UserImageContainer $container
     * @return string
     */
    public function getUserImagePageUrl(UserImageContainer $container)
    {
        return $this->getSelfDomen() . '/user-image/' . $container->uid;
    }

    /**
     * @param $tag
     * @return string|void
     */
    public function getCirillicTag($tag)
    {
        if (!empty($tag)) {
            $tags = $this->getTagsList();
            if (array_key_exists($tag, $tags)) {
                return $tag;
            } else if (in_array($tag, $tags)) {
                return array_search($tag, $tags);
            }
        }
    }

    /**
     * @param null $tag
     * @return Query
     */
    public function getImagesBaseQuery($tag = null)
    {
        $query = new Query();
        $tag = $this->getCirillicTag($tag);
        if (!empty($tag) && ($tag != Base::ALL_TAG)) {
            $query->match($tag);
        }
        $query->addOptions(['max_matches' => self::MAX_MATCHES]);

        return $query->from(self::IMAGE_INDEX)->orderBy('created desc');
    }

    /**
     * @param AuthorContainer $author
     * @return $this
     */
    public function getAuthorImagesBaseQuery(AuthorContainer $author)
    {
        $model = new Models\AuthorImage();
        $page = Yii::$app->request->getQueryParam('page', 1);
        $offset = ($page > 1) ? ($page - 1) * self::PAGE_SIZE : 0;

        return $model::find()
            ->where(['author_id' => $author->id])
            ->orderBy('id DESC')
            ->limit(self::PAGE_SIZE)
            ->offset($offset);
    }

    public function getAuthorPageUrl($authorId)
    {
        return $this->getPageUrlByAuthorId($authorId);
    }

    /**
     * @param $query
     * @return Pagination
     */
    public function getPages($query)
    {
        $cloned = $query;

        return new Pagination(
            [
                'totalCount' => $cloned->count(),
                'pageSize' => self::PAGE_SIZE,
                'defaultPageSize' => self::PAGE_SIZE
            ]
        );
    }

    /**
     * @param Query $query
     * @return ActiveDataProvider
     */
    public function getProvider(Query $query)
    {
        return new ActiveDataProvider(
            [
                'query' => $query,
                'pagination' => [
                    'pageSize' => self::PAGE_SIZE,
                ]
            ]
        );
    }

    /**
     * @param Query $query
     * @return ImageContainer[]|void
     */
    public function getImagesContainers(Query $query)
    {
        $provider = $this->getProvider($query);
        $data = $provider->getModels();
        $result = [];
        if (!empty($data)) {
            foreach ($data as $v) {
                $result[] = $this->getImageContainerFromSphinxResult($v);
            }

            return $result;
        }
    }

    /**
     * @param $uid
     * @return ImageContainer|void
     */
    public function getImageByUid($uid)
    {
        $query = new Query();
        $result = $query->from(self::IMAGE_INDEX)->match($uid)->one();
        if (!empty($result)) {
            return $this->getImageContainerFromSphinxResult($result);
        }
    }

    /**
     * @param $uid
     * @return UserImageContainer|void
     */
    public function getUserImageByUid($uid)
    {
        $query = new Query();
        $image = $query->from(self::USER_IMAGE_INDEX)->match($uid)->one();
        if (!empty($image)) {
            return $this->getUserImageContainerFromSphinxResult($image);
        } else {
            $model = $this->getUserImageModelByUid($uid);
            if (!empty($model)) {
                return $this->getUserImageContainerFromModel($model);
            }
        }
    }

    /**
     * @param $uid
     * @return Models\UserImage|null
     */
    public function getUserImageModelByUid($uid)
    {
        $model = new Models\UserImage();

        return $model::findOne(['uid' => $uid]);
    }

    /**
     * @param $tags
     * @return string
     */
    public function getTagsDescription($tags)
    {
        $tags = trim($tags);
        if (empty($tags)) {
            return '';
        }
        $tags = explode(',', $tags);
        if (empty($tags)) {
            return '';
        }
        $result = '';
        foreach ($tags as $tag) {
            $tag = trim($tag);
            if (!empty($tag)) {
                $result .= ucfirst($tag) . ' , ';
            }
        }
        $result = rtrim($result, ', ');

        return $result ?? '';
    }

    /**
     * @return void
     */
    public function removeLastImage()
    {
        $model = new Models\Image();
        $model::find()->orderBy('id DESC')->one()->delete();
    }

    /**
     * @param ImageContainer $container
     * @return string
     */
    public function getImageHtml(ImageContainer $container)
    {
        return Html::img($this->getImageUrl($container), [
            'data-uid' => $container->uid,
            'data-number' => $container->number,
            'alt' => $container->tags
        ]);
    }

    /**
     * @param AuthorImageContainer $container
     * @return string
     */
    public function getAuthorImageHtml(AuthorImageContainer $container)
    {
        return Html::img($this->getAuthorImageUrl($container), [
            'class' => 'author-image',
            'data-uid' => $container->uid,
            'data-page_url' => $this->getPageUrlByAuthorId($container->authorId) . '?image=' . $container->uid,
            'data-author_page_url' => $this->getDomenByAuthorId($container->authorId) . $container->pageUrl,
            'data-title' => $container->title,
            'data-created_text' => $container->createdText,
            'alt' => $container->tags
        ]);
    }

    public function getDomenByAuthorId($authorId)
    {
        $author = $this->getAuthorContainer($authorId);

        return $author->domen ?? null;
    }

    /**
     * @return string
     */
    public function getCopyLinkButtonHtml()
    {
        return Html::button('Скопировать ссылку', [
            'class' => 'copy-image-link btn btn-primary',
            'id' => 'copy-link-button'
        ]);
    }

    /**
     * @param AuthorImageContainer $container
     * @return string
     */
    public function getAuthorLinkPageHtml(AuthorImageContainer $container)
    {
        return Html::a('Страница автора', $this->getAuthorImagePageUrl($container), [
            'class' => 'author-page-link btn btn-primary',
            'target' => '_blank'
        ]);
    }

    /**
     * @param ImageContainer $container
     * @return string
     */
    public function getCopyLinkInputHtml(ImageContainer $container)
    {
        return Html::textInput('image-link', Yii::$app->base->getImagePageUrl($container), ['id' => 'image-link']);
    }

    /**
     * @param $lastImageActive
     * @return string
     */
    public function getLastImageActiveInputHtml($lastImageActive)
    {
        return Html::hiddenInput('lastImageActive', !empty($lastImageActive) ? 1 : 0, ['id' => 'lastImageActive']);
    }

    /**
     * @param AuthorImageContainer $container
     * @return string
     */
    public function getAuthorImagePageUrl(AuthorImageContainer $container)
    {
        $author = $this->getAuthorContainer($container->authorId);
        if (!empty($author)) {
            return $author->domen . $container->pageUrl;
        }
    }

    /**
     * @param null $tag
     * @return array
     */
    public function getImagesPagesParams($tag = null)
    {
        $lastImageActive = Yii::$app->request->getQueryParam('lastImageActive');
        $query = $this->getImagesBaseQuery($tag);
        $imageContainers = $this->getImagesContainers($query);
        $pages = $this->getPages($query);

        return [
            'tag' => $tag,
            'lastImageActive' => $lastImageActive,
            'imageContainers' => $imageContainers,
            'pages' => $pages,
            'lastPageNumber' => ceil($pages->totalCount / $pages->defaultPageSize),
            'currentImageContainer' => !empty($lastImageActive) ? end($imageContainers) : current($imageContainers)
        ];
    }

    /**
     * @return BaseImageContainer[]
     */
    public function getBaseImages()
    {
        $result = [];
        foreach (self::BASE_IMAGES as $v) {
            $container = $this->getBaseImageContainer($v['id']);
            if (!empty($container)) {
                $result[] = $container;
            }
        }

        return $result;
    }

    /**
     * @param BaseImageContainer $container
     * @return string
     */
    public function getBaseImageHtml(BaseImageContainer $container)
    {
        return Html::img($this->getBaseImageUrl($container), [
            'data-base_image_id' => $container->id,
            'alt' => 'сделать мем ' . $container->description
        ]);
    }

    /**
     * @param BaseImageContainer $data
     * @return string
     */
    public function getBaseImageUrl(BaseImageContainer $data)
    {
        return self::BASE_IMAGE_URL . '/' . $data->filename;
    }

    /**
     * @param $tag
     * @return void
     */
    public function checkActualUrls($tag)
    {
        $tagsList = $this->getTagsList();
        foreach ($tagsList as $cirillic => $english) {
            if ($tag == $cirillic) {
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: /" . $english . Yii::$app->request->getQueryString());
                Yii::$app->end();
            }
        }
    }

    /**
     * @param $json
     * @return bool
     */
    public function validateUserImageText($json)
    {
        if (empty($json)) {
            return false;
        }
        $data = Json::decode($json);
        if (empty($data)) {
            return false;
        }
        $badWords = $this->getBadWords();
        foreach ($data as $v) {
            foreach ($badWords as $word) {
                $pattern = $this->getBadWordsPattern($word);
                $string = mb_strtolower($v['text'], 'UTF-8');
                $pattern = mb_strtolower($pattern, 'UTF-8');
                if (preg_match($pattern, $string)) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @param $url
     * @return AuthorContainer|null|void
     */
    public function getAuthorByUrl($url)
    {
        $url = trim($url);
        if (empty($url)) {
            return;
        }
        foreach (self::AUTHORES as $id => $data) {
            if ($url == $data['url']) {
                return $this->getAuthorContainer($id);
            }
        }
    }

    /**
     * @param $query
     * @return array
     */
    public function getAuthorImages($query)
    {
        $models = $query->all();
        if (!empty($models)) {
            $result = [];
            foreach ($models as $model) {
                $result[$model->uid] = $this->getAuthorImageContainerFromModel($model);
            }

            return $result;
        }
    }

    /**
     * @param $imageContainers
     * @param $currentPageNumber
     *
     * @return ImageContainer[]
     */
    public function setImagesNumbers($imageContainers, $currentPageNumber)
    {
        $result = [];
        if ($imageContainers) {
            $totalImagesCount = $this->getTotalImagesCount();
            foreach ($imageContainers as $k => $imageContainer) {
                if ($imageContainer instanceof ImageContainer) {
                    $number = (self::PAGE_SIZE - $k)
                        + (($totalImagesCount - self::PAGE_SIZE) - (($currentPageNumber - 1) * self::PAGE_SIZE));
                    $imageContainer->number = $number;
                    $result[$number] = $imageContainer;
                }
            }
        }

        return $result;
    }
}
