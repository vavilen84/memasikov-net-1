<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $uid
 * @property string $ext
 * @property string $tags
 * @property integer $created
 * @property integer $updated
 */
class ImageGii extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'updated'], 'integer'],
            [['uid', 'ext', 'tags'], 'string', 'max' => 255],
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
            'updated' => 'Updated',
        ];
    }
}
