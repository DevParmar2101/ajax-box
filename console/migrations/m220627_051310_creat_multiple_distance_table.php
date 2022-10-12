<?php

use yii\db\Migration;

/**
 * Class m220627_051310_creat_multiple_distance_table
 */
class m220627_051310_creat_multiple_distance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $query =<<<EOF
CREATE TABLE `multiple_distance` (
    `id` INT(11) NOT NULL AUTO_INCREMENT ,
     `name` VARCHAR(125) NOT NULL ,
      `price` DECIMAL(15,2) NOT NULL ,
       `uuid` VARCHAR(255) NOT NULL ,
        `created_at` TIMESTAMP NOT NULL , 
--         `updated_at` TIMESTAMP NOT NULL , 
        PRIMARY KEY (`id`)) ENGINE = InnoDB;
EOF;
        $this->execute($query);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220627_051310_creat_multiple_distance_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220627_051310_creat_multiple_distance_table cannot be reverted.\n";

        return false;
    }
    */
}
