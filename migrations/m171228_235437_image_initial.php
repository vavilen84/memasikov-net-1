<?php

use yii\db\Migration;

class m171228_235437_image_initial extends Migration
{
    public function safeUp()
    {
        $this->createTable('image',	[
            'id' => 'int(11) unsigned null default null AUTO_INCREMENT',
            'uid' => 'varchar(255) null default null',
            'ext' => 'varchar(255) null default null',
            'tags' => 'varchar(255) null default null',
            'created' => 'int(11) null default null',
            'updated' => 'int(11) null default null',
            'PRIMARY KEY (`id`)'
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1');
    }

    public function safeDown()
    {
        echo "m171228_235437_image_initial cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171228_235437_image_initial cannot be reverted.\n";

        return false;
    }
    */
}
