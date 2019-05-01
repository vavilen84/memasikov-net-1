<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use app\components\Base;

class SitemapController extends Controller
{
    protected $domen;
    protected $lastmod;
    protected $result;

    public function actionCreate()
    {
        $this->setParams();
        $this->collectData();
        Yii::$app->console->createSitemapXmlFile($this->result);
    }

    protected function collectData()
    {
        $this->addMainPage();
//        $this->addTags();
        $this->addAuthors();
//        $this->addPages();
    }

    protected function setParams()
    {
        $this->domen = Yii::$app->base->getSelfDomen();
        $this->lastmod = Yii::$app->console->getLastmod();
        $this->result = [];
    }

    protected function addMainPage()
    {
        $this->result[] = [
            'loc' => $this->domen,
            'priority' => 1,
            'changefreq' => 'daily',
            'lastmod' => $this->lastmod
        ];
    }

    protected function addTags()
    {
        $tagsList = Yii::$app->base->getTagsList();
        foreach ($tagsList as $tag) {
            $this->result[] = [
                'loc' => $this->domen . '/' . $tag,
                'priority' => 0.8,
                'changefreq' => 'daily',
                'lastmod' => $this->lastmod
            ];
        }
    }

    protected function addAuthors()
    {
        foreach(Yii::$app->base->getAuthorsContainers() as $container){
            $this->result[] = [
                'loc' => $this->domen . '/' .$container->url,
                'priority' => 0.8,
                'changefreq' => 'daily'
            ];
        }

    }

    protected function addPages()
    {
        $this->result[] = [
            'loc' => $this->domen . '/mem',
            'priority' => 0.5,
            'changefreq' => 'daily'
        ];
    }

    protected function addImages()
    {
        $query = Yii::$app->base->getImagesBaseQuery();
        $images = $query->limit(Base::MAX_SITEMAP_URLS)->all();
        foreach ($images as $image) {
            $this->result[] = [
                'loc' => $this->domen . '/image/' . $image['uid'],
                'priority' => 0.5,
                'changefreq' => 'never'
            ];
        }
    }
}
