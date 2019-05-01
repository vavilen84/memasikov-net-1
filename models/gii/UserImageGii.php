<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "user_image".
 *
 * @property integer $id
 * @property string $uid
 * @property integer $created
 * @property integer $status
 * @property integer $user_id
 * @property string $json
 * @property integer $base_image_id
 */
class UserImageGii extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'status', 'user_id', 'base_image_id'], 'integer'],
            [['json'], 'string'],
            [['uid'], 'string', 'max' => 255],
            [['uid'], 'unique'],
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
            'created' => 'Created',
            'status' => 'Status',
            'user_id' => 'User ID',
            'json' => 'Json',
            'base_image_id' => 'Base Image ID',
        ];
    }
}
