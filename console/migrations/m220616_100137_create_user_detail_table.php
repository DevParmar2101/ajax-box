<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_detail}}`.
 */
class m220616_100137_create_user_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $query = <<<EOF
CREATE TABLE `user_detail` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `first_name` varchar(50) NOT NULL,
 `last_name` varchar(50) NOT NULL,
 `age` varchar(5) NOT NULL,
 `mobile_number` varchar(15) NOT NULL,
 `user_id` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
EOF;
        $this->execute($query);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_detail}}');
    }
}
