<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_address}}`.
 */
class m220616_100859_create_user_address_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       $query =<<<EOF
CREATE TABLE `chat_box`.`user_address` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `city` VARCHAR(155) NOT NULL , `state` VARCHAR(155) NOT NULL , `post_code` VARCHAR(11) NOT NULL , `address` TEXT NOT NULL , `landmark` VARCHAR(225) NOT NULL , `status` TINYINT(1) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
EOF;
    $this->execute($query);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_address}}');
    }
}
