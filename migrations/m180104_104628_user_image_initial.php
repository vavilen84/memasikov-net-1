<?php

use yii\db\Migration;

class m180104_104628_user_image_initial extends Migration
{
    public function safeUp()
    {
        $this->createTable('user_image',	[
            'id' => 'int(11) unsigned null default null AUTO_INCREMENT',
            'uid' => 'varchar(255) null default null',
            'created' => 'int(11) null default null',
            'status' => 'int(11) null default null',
            'user_id' => 'int(11) null default null',
            'json' => 'text',
            'base_image_id' => 'int(11) null default null',
            'PRIMARY KEY (`id`)'
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1');
        $this->createIndex('uid', 'user_image', 'uid', true);
    }

    public function safeDown()
    {
        echo "m180104_104628_user_image_initial cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180104_104628_user_mem_initial cannot be reverted.\n";

        return false;
    }
    */
}
