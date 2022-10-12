<?php

use yii\db\Migration;

/**
 * Class m220617_063945_add_user_id_in_user_address_table
 */
class m220617_063945_add_user_id_in_user_address_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $query =<<<EOF
ALTER TABLE `user_address` ADD `user_id` INT(11) NOT NULL AFTER `status`; 
EOF;
        $this->execute($query);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220617_063945_add_user_id_in_user_address_table cannot be reverted.\n";

        return false;
    }
}
