<?php

use yii\db\Migration;

/**
 * Handles the creation of table `amx_reasons_to_set`.
 */
class m171112_213803_create_amx_reasons_to_set_table extends Migration
{
    private $tableName = '{{%reasons_to_set}}';
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'setid' => $this->integer()->unsigned()->notNull(),
            'reasonid' => $this->integer()->unsigned()->notNull(),
        ]);
        $this->addForeignKey(
            'amx_rsnts_ibfk1',
            $this->tableName,
            'setid',
            '{{%reasons_set}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'amx_rsnts_ibfk2',
            $this->tableName,
            'reasonid',
            '{{%reasons}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('amx_rsnts_ibfk1', $this->tableName);
        $this->dropForeignKey('amx_rsnts_ibfk2', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
