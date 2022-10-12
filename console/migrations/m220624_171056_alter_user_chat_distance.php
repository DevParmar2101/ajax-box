<?php

use yii\db\Migration;

/**
 * Class m220624_171056_alter_user_chat_distance
 */
class m220624_171056_alter_user_chat_distance extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $query =<<<EOF
ALTER TABLE `user_chat_distance` ADD FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; 
EOF;
        $this->execute($query);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220624_171056_alter_user_chat_distance cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220624_171056_alter_user_chat_distance cannot be reverted.\n";

        return false;
    }
    */
}
