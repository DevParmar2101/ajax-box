<?php

use yii\db\Migration;

/**
 * Class m220627_105214_alter_multiple_distance_table
 */
class m220627_105214_alter_multiple_distance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $query = <<<EOF
ALTER TABLE `multiple_distance` ADD `user_id` INT(11) NOT NULL AFTER `created_at`; 
EOF;
        $this->execute($query);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220627_105214_alter_multiple_distance_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220627_105214_alter_multiple_distance_table cannot be reverted.\n";

        return false;
    }
    */
}
