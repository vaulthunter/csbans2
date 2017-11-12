<?php

use yii\db\Migration;

/**
 * Handles the creation of table `amx_serverinfo`.
 */
class m171112_213805_create_amx_serverinfo_table extends Migration
{
    private $tableName = '{{%serverinfo}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'timestamp' => $this->integer()->unsigned()->null(),
            'hostname' => $this->string(100)->null(),
            'address' => $this->string(64)->null(),
            'gametype' => $this->string(16)->null(),
            'rcon' => $this->string(64)->null(),
            'amxban_version' => $this->string(12)->null(),
            'amxban_motd' => $this->string()->null(),
            'motd_delay' => $this->smallInteger(5)->unsigned()->notNull()->defaultValue(10),
            'amxban_menu' => $this->smallInteger(3)->unsigned()->notNull()->defaultValue(1),
            'reasons' => $this->integer()->unsigned()->null(),
            'timezone_fixx' => $this->integer()->notNull()->defaultValue(0)
        ]);
        $this->createIndex('amx_srvr_ind1', $this->tableName, 'timestamp');
        $this->createIndex('amx_srvr_ind2', $this->tableName, 'hostname');
        $this->createIndex('amx_srvr_ind3', $this->tableName, 'address');
        $this->createIndex('amx_srvr_ind4', $this->tableName, 'gametype');
        $this->addForeignKey(
            'amx_srvr_ibfk1',
            $this->tableName,
            'reasons',
            '{{%reasons}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('amx_srvr_ind1', $this->tableName);
        $this->dropIndex('amx_srvr_ind2', $this->tableName);
        $this->dropIndex('amx_srvr_ind3', $this->tableName);
        $this->dropIndex('amx_srvr_ind4', $this->tableName);
        $this->dropForeignKey('amx_srvr_ibfk1', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
