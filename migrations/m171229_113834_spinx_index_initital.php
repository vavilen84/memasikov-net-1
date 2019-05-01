<?php

use yii\db\Migration;

class m171229_113834_spinx_index_initital extends Migration
{
    public function safeUp()
    {
        $this->createTable('sphinx_index',	[
            'index_name' => 'varchar(255) null default null',
            'last_doc_id' => 'varchar(255) null default null',
            'updated' => 'int(11) null default null'
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8');

        $this->insert('sphinx_index', [
            'index_name' => 'image'
        ]);
    }

    public function safeDown()
    {
        echo "m171229_113834_spinx_index_initital cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171229_113834_spinx_index_initital cannot be reverted.\n";

        return false;
    }
    */
}
