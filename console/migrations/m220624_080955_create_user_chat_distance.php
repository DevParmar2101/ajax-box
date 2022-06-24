<?php

use yii\db\Migration;

/**
 * Class m220624_080955_create_user_chat_distance
 */
class m220624_080955_create_user_chat_distance extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $query = <<<EOF
CREATE TABLE `chat_box`.`user_chat_distance` ( 
    `id` INT(11) NOT NULL AUTO_INCREMENT ,
    `km_from` DECIMAL(15,2) NOT NULL , 
    `km_to` DECIMAL(15,2) NOT NULL ,
    `min_order_price` DECIMAL(15,2) NOT NULL , 
    `delivery_price` DECIMAL(15,2) NOT NULL ,
    `user_id` INT(11) NOT NULL ,
    PRIMARY KEY (`id`)) ENGINE = InnoDB;
EOF;
    $this->execute($query);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220624_080955_create_user_chat_distance cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220624_080955_create_user_chat_distance cannot be reverted.\n";

        return false;
    }
    */
}
