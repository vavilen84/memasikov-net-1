<?php
namespace app\components;

use app\containers\BaseImageContainer;
use app\containers\AuthorContainer;
use app\containers\FileContainer;
use app\containers\AuthorImageContainer;
use app\containers\ImageContainer;
use app\containers\UserImageContainer;

use Yii;
use yii\base\Component;
use app\models\db as Models;

class BaseComponentData extends Component
{
    const HTTP_SCHEME = 'http://';
    const HTTPS_SCHEME = 'https://';
    const USER_ADMIN_ROLE = 1;
    const BASE_FOLDER = '/var/www/memasikov.net';
    const WEB_FOLDER = '/web';
    const IMAGE_UPLOAD_FOLDER = '/uploads';
    const AUTHOR_IMAGE_UPLOAD_FOLDER = '/author/uploads';
    const USER_IMAGE_EXT = 'png';
    const PNG_EXT = 'png';
    const JPG_EXT = 'jpg';
    const SELF_DOMEN = 'https://memasikov.net';
    const SELF_LOCAL_DOMEN = 'http://memasikov.net.local';
    const IMAGE_INDEX = 'images';
    const USER_IMAGE_INDEX = 'user_images';
    const PAGE_SIZE = 30;
    const ALL_TAG = 'все';
    const UPLOAD_HASH = 'sdvhР45rtG9.=H,';
    const UPLOAD_MEM_HASH = 'sdv234hР43455rtG9.=H,';
    const MAX_SITEMAP_URLS = 50000;
    const MAX_MATCHES = 100000;
    const BASE_IMAGE_FOLDER = '/var/www/memasikov.net/web/base_image';
    const FALSE_FOLDERS = ['.', '..'];
    const BASE_IMAGE_URL = '/base_image';
    const AUTHOR_VASYA_LOZKIN = 1;
    const AUTHORES = [
        self::AUTHOR_VASYA_LOZKIN => [
            'domen' => 'http://vasya-lozhkin.ru',
            'url' => 'vasya-lozkin',
            'name' => 'Вася Ложкин',
            'tags' => 'картинки , котики , живопись'
        ]
    ];
    const BASE_IMAGES = [
        1 => [
            'id' => 1,
            'filename' => 'base_image_1.png',
            'description' => 'нельзя так просто',
            'width' => 600,
            'height' => 354
        ],
        2 => [
            'id' => 2,
            'filename' => 'base_image_2.png',
            'description' => 'вжух',
            'width' => 600,
            'height' => 369
        ],
        3 => [
            'id' => 3,
            'filename' => 'base_image_3.png',
            'description' => 'умный негр',
            'width' => 600,
            'height' => 342
        ],
        4 => [
            'id' => 4,
            'filename' => 'base_image_4.png',
            'description' => 'хоба',
            'width' => 600,
            'height' => 500
        ],
        5 => [
            'id' => 5,
            'filename' => 'base_image_5.png',
            'description' => 'агутин',
            'width' => 600,
            'height' => 400
        ],
        6 => [
            'id' => 6,
            'filename' => 'base_image_6.png',
            'description' => 'гордый волк',
            'width' => 600,
            'height' => 600
        ],
        7 => [
            'id' => 7,
            'filename' => 'base_image_7.png',
            'description' => 'карл',
            'width' => 600,
            'height' => 400
        ],
        8 => [
            'id' => 8,
            'filename' => 'base_image_8.png',
            'description' => 'безысходность',
            'width' => 800,
            'height' => 450
        ],
        9 => [
            'id' => 9,
            'filename' => 'base_image_9.png',
            'description' => 'остров проклятых',
            'width' => 604,
            'height' => 518
        ],
        10 => [
            'id' => 10,
            'filename' => 'base_image_10.png',
            'description' => 'подозрительность',
            'width' => 603,
            'height' => 452
        ],
        11 => [
            'id' => 11,
            'filename' => 'base_image_11.png',
            'description' => 'гриффин',
            'width' => 440,
            'height' => 440
        ],
        12 => [
            'id' => 12,
            'filename' => 'base_image_12.png',
            'description' => 'мудрец',
            'width' => 440,
            'height' => 440
        ],
        13 => [
            'id' => 13,
            'filename' => 'base_image_13.png',
            'description' => 'мудрая мысль',
            'width' => 600,
            'height' => 400
        ],
        14 => [
            'id' => 14,
            'filename' => 'base_image_14.png',
            'description' => 'задумчивая обезьяна',
            'width' => 600,
            'height' => 400
        ],
        15 => [
            'id' => 15,
            'filename' => 'base_image_15.png',
            'description' => 'мало',
            'width' => 600,
            'height' => 400
        ],
        16 => [
            'id' => 16,
            'filename' => 'base_image_16.png',
            'description' => 'плачущий человечек',
            'width' => 600,
            'height' => 400
        ],
        17 => [
            'id' => 17,
            'filename' => 'base_image_17.png',
            'description' => 'ничоси',
            'width' => 600,
            'height' => 400
        ],
        18 => [
            'id' => 18,
            'filename' => 'base_image_18.png',
            'description' => 'удивленный котик',
            'width' => 609,
            'height' => 439
        ],
        19 => [
            'id' => 19,
            'filename' => 'base_image_19.png',
            'description' => 'очки ннада',
            'width' => 500,
            'height' => 485
        ],
        20 => [
            'id' => 20,
            'filename' => 'base_image_20.png',
            'description' => 'динозавр',
            'width' => 600,
            'height' => 600
        ],
        21 => [
            'id' => 21,
            'filename' => 'base_image_21.png',
            'description' => 'сэр а вы знаете что',
            'width' => 600,
            'height' => 686
        ],
        22 => [
            'id' => 22,
            'filename' => 'base_image_22.png',
            'description' => 'удивленный котик',
            'width' => 540,
            'height' => 393
        ],
        23 => [
            'id' => 23,
            'filename' => 'base_image_23.png',
            'description' => 'а что если я скажу',
            'width' => 400,
            'height' => 412
        ],
        24 => [
            'id' => 24,
            'filename' => 'base_image_24.png',
            'description' => 'угрюмый кот',
            'width' => 500,
            'height' => 563
        ],
        25 => [
            'id' => 25,
            'filename' => 'base_image_25.png',
            'description' => 'без уважения',
            'width' => 596,
            'height' => 380
        ],
        26 => [
            'id' => 26,
            'filename' => 'base_image_26.png',
            'description' => 'facepalm',
            'width' => 640,
            'height' => 526
        ],
        27 => [
            'id' => 27,
            'filename' => 'base_image_27.png',
            'description' => 'не надо так',
            'width' => 470,
            'height' => 373
        ],
        28 => [
            'id' => 28,
            'filename' => 'base_image_28.png',
            'description' => 'серьезный кот',
            'width' => 460,
            'height' => 407
        ],
    ];

    public function getTagsList()
    {
        return [
            'баяны' => 'retro',
            'живопись' => 'painting',
            'задумчивое' => 'wistful',
            'картинки' => 'pictures',
            'котики' => 'cats',
            'мемасики' => 'mems',
            'мимишечки' => 'mimi',
            'природа' => 'nature',
            'сказочное' => 'fairytale',
            'фото' => 'photo',
//            'день рождения',
//            'история',
//            'металл',
//            'многабукав',
//            'мотивация',
//            'мудрые мысли',
//            'музыка',
//            'новый год',
//            'программисты',
//            'спорт',
//            'средние века',
//            'FFFFUUUUUUU',
        ];
    }

    public function getMetakeywords()
    {
        $result = 'фото , новые фото , фото 2018, фото года, мемы, мемы картинки, живопись, картиники, прикольные картинки , ';
        $tags = $this->getTagsList();
        shuffle($tags);
        foreach ($tags as $tag) {
            $result .= $this->getTagDescription($tag) . ' , ';
        }
        $result .= date('Y');

        return $result;
    }

    public function getTitle()
    {
        return 'Мемы , картинки , живопись , фото - memasikov.net';
    }

    public function getTagDescription($tag)
    {
        $tag = trim($tag);
        if (empty($tag)) {
            return '';
        }
        switch (trim($tag)) {
            case 'баяны':
                return 'Баяны , ретро мемы , каждый день новые картинки';
                break;
            case 'живопись':
                return 'Живопись , картины , каждый день новые картины';
                break;
            case 'задумчивое':
                return 'Задумчивые картинки , мемы , фото , каждый день новые картинки';
                break;
            case 'картинки':
                return 'Красивые и интересные картинки , каждый день новые картинки';
                break;
            case 'котики':
                return 'Мемы с котиками , каждый день новые котики';
                break;
            case 'мемасики':
                return 'Смешные и интересные мемы , каждый день новые мемы';
                break;
            case 'мимишечки':
                return 'Мимишные мемы , каждый день новые мемы';
                break;
            case 'природа':
                return 'Фото , картинки и изображения природы , каждый день новые фото';
                break;
            case 'сказочное':
                return 'Сказочные картинки , каждый день новые картинки';
                break;
            case 'фото':
                return 'Красивые и интересные фото , каждый день новые фото';
                break;
        }
    }

    public function getPageNumberText()
    {
        $page = Yii::$app->request->getQueryParam('page');
        if (empty($page)) {
            return;
        }

        return ' Страница ' . $page;
    }

    public function getBadWords()
    {
        return include('data/bad_words.php');
    }

    public function getBadWordsPattern($word)
    {
        return '/(' . $word . ')/';
    }

    public function getUniqueName()
    {
        $salt = 'All you need is love';
        return hash_hmac('md5', uniqid(rand(), 1), $salt);
    }

    public function getSelfDomen()
    {
        return empty(Yii::$app->params['is_production']) ? self::SELF_LOCAL_DOMEN : self::SELF_DOMEN;
    }

    public function getPageUrlByAuthorId($authorId)
    {
        if (!empty(self::AUTHORES[$authorId])) {
            return $this->getSelfDomen() . '/author/' . self::AUTHORES[$authorId]['url'];
        } else {
            return $this->getSelfDomen();
        }
    }

    public function saveImageModel($params)
    {
        $model = new Models\Image();
        $model->tags = $params['tags'];
        $model->created = time();
        $model->uid = $params['uid'];
        $model->ext = $params['ext'];
        $model->save();

        return $model;
    }

    public function getImageContainerFromModel(Models\Image $model)
    {
        $container = new ImageContainer();

        $container->id = $model->id;
        $container->uid = $model->uid;
        $container->ext = $model->ext;
        $container->tags = $model->tags;
        $container->created = $model->created;
        $container->updated = $model->updated;

        return $container;
    }

    public function saveAuthorImageModel($params)
    {
        $model = new Models\AuthorImage();

        $model->uid = $params['uid'];
        $model->ext = self::JPG_EXT;
        $model->tags = $params['tags'];
        $model->created = time();
        $model->created_text = $params['created_text'];
        $model->title = $params['title'];
        $model->author_id = self::AUTHOR_VASYA_LOZKIN;
        $model->page_url = $params['page_url'];
        $model->save();

        return $model;
    }

    public function getAuthorImageContainerFromModel(Models\AuthorImage $model)
    {
        $container = new AuthorImageContainer();

        $container->id = $model->id;
        $container->uid = $model->uid;
        $container->ext = $model->ext;
        $container->tags = $model->tags;
        $container->created = $model->created;
        $container->createdText = $model->created_text;
        $container->description = $model->description;
        $container->title = $model->title;
        $container->authorId = $model->author_id;
        $container->pageUrl = $model->page_url;

        return $container;
    }

    public function saveUserImageModel($params)
    {
        $model = new Models\UserImage();

        $model->uid = $this->getUniqueName();
        $model->created = time();
        $model->user_id = Yii::$app->user->getId();
        $model->json = $params['json'];
        $model->base_image_id = $params['base_image_id'];
        $model->save();

        return $model;
    }

    public function getUserImageContainerFromModel(Models\UserImage $model)
    {
        $container = new UserImageContainer();

        $container->id = $model->id;
        $container->uid = $model->uid;
        $container->created = $model->created;
        $container->status = $model->status;
        $container->userId = $model->user_id;
        $container->json = $model->json;
        $container->baseImageId = $model->base_image_id;

        return $container;
    }

    public function getFileContainer($params)
    {
        $container = new FileContainer();
        $container->uid = $params['uid'];
        $container->ext = $params['ext'];

        return $container;
    }

    public function getUserImageContainerFromSphinxResult($data)
    {
        $container = new UserImageContainer();

        $container->id = $data['id'];
        $container->uid = $data['uid'];
        $container->created = $data['created'];
        $container->status = $data['status'];
        $container->userId = $data['user_id'];
        $container->json = $data['json'];
        $container->baseImageId = $data['base_image_id'];

        return $container;
    }

    public function getImageContainerFromSphinxResult($data)
    {
        $container = new ImageContainer();

        $container->id = $data['id'];
        $container->uid = $data['uid'];
        $container->ext = $data['ext'];
        $container->tags = $data['tags'];
        $container->created = $data['created'];
        $container->updated = $data['updated'];

        return $container;
    }

    /**
     * @param $id
     * @return BaseImageContainer|void
     */
    public function getBaseImageContainer($id)
    {
        if (!empty(Base::BASE_IMAGES[$id])) {
            $data = Base::BASE_IMAGES[$id];
            $container = new BaseImageContainer();
            $container->id = $data['id'];
            $container->filename = $data['filename'];
            $container->description = $data['description'];
            $container->width = $data['width'];
            $container->height = $data['height'];

            return $container;
        }
    }

    public function getAuthorContainer($id)
    {
        if (!empty(self::AUTHORES[$id])) {
            $container = new AuthorContainer();

            $container->id = $id;
            $container->name = self::AUTHORES[$id]['name'];
            $container->url = self::AUTHORES[$id]['url'];
            $container->tags = self::AUTHORES[$id]['tags'];
            $container->domen = self::AUTHORES[$id]['domen'];

            return $container;
        }
    }

    public function getAuthorsContainers()
    {
        $result = [];
        foreach (self::AUTHORES as $id => $v) {
            $result[] = $this->getAuthorContainer($id);
        }

        return $result;
    }
}