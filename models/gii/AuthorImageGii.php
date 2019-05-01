<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "author_image".
 *
 * @property integer $id
 * @property string $uid
 * @property string $ext
 * @property string $tags
 * @property integer $created
 * @property string $created_text
 * @property string $description
 * @property string $title
 * @property integer $author_id
 * @property string $page_url
 */
class AuthorImageGii extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'author_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'author_id'], 'integer'],
            [['description', 'page_url'], 'string'],
            [['uid', 'ext', 'tags', 'created_text', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'ext' => 'Ext',
            'tags' => 'Tags',
            'created' => 'Created',
            'created_text' => 'Created Text',
            'description' => 'Description',
            'title' => 'Title',
            'author_id' => 'Author ID',
            'page_url' => 'Page Url',
        ];
    }
}
