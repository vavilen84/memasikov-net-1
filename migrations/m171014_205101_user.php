<?php

use yii\db\Migration;

class m171014_205101_user extends Migration
{
    public function safeUp()
    {
        $this->createTable('user',	[
            'id' => 'int(11) unsigned null default null AUTO_INCREMENT',
            'nickname' => 'varchar(255) null default null',
            'email' => 'varchar(255) null default null',
            'password' => 'varchar(255) null default null',
            'status' => 'int(11) null default null',
            'role' => 'int(11) null default null',
            'PRIMARY KEY (`id`)'
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1');
    }

    public function safeDown()
    {
        $this->dropTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171014_205101_user cannot be reverted.\n";

        return false;
    }
    */
}
