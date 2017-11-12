<?php

use yii\db\Migration;

/**
 * Handles the creation of table `amx_reasons_set`.
 */
class m171112_213753_create_amx_reasons_set_table extends Migration
{
    private $tableName = '{{%reasons_set}}';
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'setname' => $this->string(32)->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
