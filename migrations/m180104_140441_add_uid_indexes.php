<?php

use yii\db\Migration;

class m180104_140441_add_uid_indexes extends Migration
{
    public function safeUp()
    {
        $this->createIndex('uid', 'image', 'uid', true);
    }

    public function safeDown()
    {
        echo "m180104_140441_add_uid_indexes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180104_140441_add_uid_indexes cannot be reverted.\n";

        return false;
    }
    */
}
