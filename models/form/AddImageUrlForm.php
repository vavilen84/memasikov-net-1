<?php
namespace app\models\form;

use Yii;
use yii\base\Model;

class AddImageUrlForm extends Model
{
    public $url;
    public $tags;

    public function rules()
    {
        return [
            ['url', 'required'],
            ['url', 'url'],
            ['tags', 'safe']
        ];
    }

    public function save()
    {
        return Yii::$app->base->saveImageByUrl($this->url, $this->tags);
    }
}