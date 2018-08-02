<?php

use yii\db\Migration;

/**
 * Class m180731_183111_Programming_Languages_table
 */
class m180731_183111_Programming_Languages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('p_lang', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);
        
        $this->createTable('user2p_lang', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'p_lang_id' => $this->integer(),
        ]);
        
        $this->execute("INSERT INTO `p_lang`(`id`, `title`) VALUES (1,'PHP'),(2,'CSS'),(3,'HTML'),(4,'JavaScript'),(5,'JAVA');");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180731_183111_Programming_Languages_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180731_183111_Programming_Languages_table cannot be reverted.\n";

        return false;
    }
    */
}
