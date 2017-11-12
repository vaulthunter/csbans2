<?php

use yii\db\Migration;

/**
 * Handles the creation of table `amx_bans`.
 */
class m171112_213807_create_amx_bans_table extends Migration
{
    private $tableName = '{{%bans}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'bid' => $this->primaryKey()->unsigned()->notNull(),
            'player_ip' => $this->string(16)->null(),
            'player_id' => $this->string(32)->null(),
            'player_nick' => $this->string(64)->null(),
            'admin_ip' => $this->string(16)->null(),
            'admin_id' => $this->string(32)->null(),
            'admin_nick' => $this->string(64)->null(),
            'ban_type' => $this->string(5)->null(),
            'ban_reason' => $this->string(100)->null(),
            'cs_ban_reason' => $this->string(100)->null(),
            'ban_created' => $this->integer()->unsigned()->null(),
            'ban_length' => $this->integer()->unsigned()->null(),
            'server_ip' => $this->string(64)->null(),
            'server_name' => $this->string(100)->null(),
            'ban_kicks' => $this->smallInteger(4)->unsigned()->notNull()->defaultValue(0),
            'expired' => $this->integer()->unsigned()->notNull()->defaultValue(0),
            'imported' => $this->boolean()->unsigned()->notNull()->defaultValue(0),
        ]);
        $this->createIndex('amx_bans_ind1', $this->tableName, 'player_ip');
        $this->createIndex('amx_bans_ind2', $this->tableName, 'player_id');
        $this->createIndex('amx_bans_ind3', $this->tableName, 'player_nick');
        $this->createIndex('amx_bans_ind4', $this->tableName, 'admin_ip');
        $this->createIndex('amx_bans_ind5', $this->tableName, 'admin_id');
        $this->createIndex('amx_bans_ind6', $this->tableName, 'admin_nick');
        $this->createIndex('amx_bans_ind7', $this->tableName, 'ban_type');
        $this->createIndex('amx_bans_ind8', $this->tableName, 'ban_reason');
        $this->createIndex('amx_bans_ind9', $this->tableName, 'ban_created');
        $this->addForeignKey(
            'amx_bans_ibfk1',
            $this->tableName,
            'server_ip',
            '{{%serverinfo}}',
            'address',
            'SET NULL',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('amx_bans_ibfk1', $this->tableName);
        $this->dropIndex('amx_bans_ind1', $this->tableName);
        $this->dropIndex('amx_bans_ind2', $this->tableName);
        $this->dropIndex('amx_bans_ind3', $this->tableName);
        $this->dropIndex('amx_bans_ind4', $this->tableName);
        $this->dropIndex('amx_bans_ind5', $this->tableName);
        $this->dropIndex('amx_bans_ind6', $this->tableName);
        $this->dropIndex('amx_bans_ind7', $this->tableName);
        $this->dropIndex('amx_bans_ind8', $this->tableName);
        $this->dropIndex('amx_bans_ind9', $this->tableName);
        $this->dropTable('amx_bans');
    }
}
