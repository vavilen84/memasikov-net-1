<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    public $description = '';
    public $totalImagesText = '';
    public $title = '';
    public $ogImage = '';
    public $heading = '';

    public function behaviors()
    {
        return [

        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function init()
    {
        parent::init();
        $this->setDefaults();
    }

    protected function setDefaults()
    {
        $this->layout = 'fixed';
        Yii::$app->base->setTotalImagesCount();
        $this->totalImagesText = Yii::$app->base->getTotalImagesText();
        $this->description = $this->totalImagesText;
        $this->ogImage = Yii::$app->base->getDefaultOgImageUrl();
    }
}
