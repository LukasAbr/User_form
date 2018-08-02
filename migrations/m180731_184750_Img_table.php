<?php

use yii\db\Migration;

/**
 * Class m180731_184750_Img_table
 */
class m180731_184750_Img_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('images', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'img_path' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180731_184750_Img_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180731_184750_Img_table cannot be reverted.\n";

        return false;
    }
    */
}
