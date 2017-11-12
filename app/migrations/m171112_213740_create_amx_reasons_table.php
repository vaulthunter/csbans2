<?php

use yii\db\Migration;

/**
 * Handles the creation of table `amx_reasons`.
 */
class m171112_213740_create_amx_reasons_table extends Migration
{
    private $tableName = '{{%reasons}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'reason' => $this->string(100)->notNull(),
            'static_bantime' => $this->integer()->unsigned()->notNull()->defaultValue(0)
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
