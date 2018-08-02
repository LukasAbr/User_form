<?php

use yii\db\Migration;

/**
 * Class m180731_181231_User_table
 */
class m180731_181231_User_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Users', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'birth_date' => $this->date(),
            'gender' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'interested_in_p' => $this->tinyInteger(1)->notNull()->defaultValue(1)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180731_181231_User_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180731_181231_User_table cannot be reverted.\n";

        return false;
    }
    */
}
