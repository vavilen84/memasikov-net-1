<?php

use yii\db\Migration;

class m171230_021820_add_default_users extends Migration
{
    public function safeUp()
    {
        $this->insert('user', [
            'id' => 1,
            'nickname' => 'vavilen84',
            'email' => 'admin@example.com',
            'password' => '1bc01ca7348a372d7430b73717c049b3',
            'role' => 1
        ]);
        $this->insert('user', [
            'id' => 2,
            'nickname' => 'milonega',
            'email' => 'admin@example.com',
            'password' => 'd6da6162e15d30a93d8c7eb8b4c768fd',
            'role' => 1
        ]);
    }

    public function safeDown()
    {
        echo "m171230_021820_add_default_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171230_021820_add_default_users cannot be reverted.\n";

        return false;
    }
    */
}
