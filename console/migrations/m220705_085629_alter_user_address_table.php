<?php

use yii\db\Migration;

/**
 * Class m220705_085629_alter_user_address_table
 */
class m220705_085629_alter_user_address_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220705_085629_alter_user_address_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220705_085629_alter_user_address_table cannot be reverted.\n";

        return false;
    }
    */
}
