<?php

use yii\db\Migration;

/**
 * Handles the creation of table `amx_logs`.
 */
class m171112_213717_create_amx_logs_table extends Migration
{
    private $tableName = '{{%logs}}';
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'timestamp' => $this->integer()->unsigned()->null(),
            'ip' => $this->string(16)->null(),
            'username' => $this->string(32)->null(),
            'action' => $this->string(64)->null(),
            'remarks' => $this->string()->null()
        ]);
        $this->createIndex('amx_logs_ind1', $this->tableName, 'timestamp');
        $this->createIndex('amx_logs_ind2', $this->tableName, 'ip');
        $this->createIndex('amx_logs_ind3', $this->tableName, 'username');
        $this->createIndex('amx_logs_ind4', $this->tableName, 'action');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('amx_logs_ind1', $this->tableName);
        $this->dropIndex('amx_logs_ind2', $this->tableName);
        $this->dropIndex('amx_logs_ind3', $this->tableName);
        $this->dropIndex('amx_logs_ind4', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
