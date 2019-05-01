<?php

use yii\db\Migration;

class m180106_050321_author_image_initial extends Migration
{
    public function safeUp()
    {
        $this->createTable('author_image',	[
            'id' => 'int(11) unsigned null default null AUTO_INCREMENT',
            'uid' => 'varchar(255) null default null',
            'ext' => 'varchar(255) null default null',
            'tags' => 'varchar(255) null default null',
            'created' => 'int(11) null default null',
            'created_text' => 'varchar(255) null default null',
            'description' => 'text',
            'title' => 'varchar(255) null default null',
            'author_id' => 'int(11) null default null',
            'page_url' => 'text',
            'PRIMARY KEY (`id`)'
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1');
    }

    public function safeDown()
    {
        echo "m180106_050321_author_image_initial cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180106_050321_author_image_initial cannot be reverted.\n";

        return false;
    }
    */
}
