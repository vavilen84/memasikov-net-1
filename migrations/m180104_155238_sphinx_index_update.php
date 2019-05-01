<?php

use yii\db\Migration;

class m180104_155238_sphinx_index_update extends Migration
{
    public function safeUp()
    {
        $this->insert('sphinx_index', [
            'index_name' => 'user_image'
        ]);
    }

    public function safeDown()
    {
        echo "m180104_155238_sphinx_index_update cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180104_155238_sphinx_index_update cannot be reverted.\n";

        return false;
    }
    */
}
