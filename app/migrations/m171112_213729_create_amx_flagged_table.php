<?php

use yii\db\Migration;

/**
 * Handles the creation of table `amx_flagged`.
 */
class m171112_213729_create_amx_flagged_table extends Migration
{
    private $tableName = '{{%flagged}}';
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'fid' => $this->primaryKey()->unsigned()->notNull(),
            'player_ip' => $this->string(16)->null(),
            'player_id' => $this->string(32)->null(),
            'player_nick' => $this->string(100)->null(),
            'admin_ip' => $this->string(16)->null(),
            'admin_id' => $this->string(32)->null(),
            'admin_nick' => $this->string(100)->null(),
            'reason' => $this->string(100)->null(),
            'created' => $this->integer()->unsigned()->null(),
            'length' => $this->integer()->unsigned()->null(),
            'server_ip' => $this->string(22)->null()
        ]);
        $this->createIndex('amx_flgd_ind1', $this->tableName, 'player_ip');
        $this->createIndex('amx_flgd_ind2', $this->tableName, 'player_id');
        $this->createIndex('amx_flgd_ind3', $this->tableName, 'player_nick');
        $this->createIndex('amx_flgd_ind4', $this->tableName, 'admin_ip');
        $this->createIndex('amx_flgd_ind5', $this->tableName, 'admin_id');
        $this->createIndex('amx_flgd_ind6', $this->tableName, 'admin_nick');
        $this->createIndex('amx_flgd_ind7', $this->tableName, 'created');
        $this->createIndex('amx_flgd_ind8', $this->tableName, 'server_ip');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('amx_flgd_ind1', $this->tableName);
        $this->dropIndex('amx_flgd_ind2', $this->tableName);
        $this->dropIndex('amx_flgd_ind3', $this->tableName);
        $this->dropIndex('amx_flgd_ind4', $this->tableName);
        $this->dropIndex('amx_flgd_ind5', $this->tableName);
        $this->dropIndex('amx_flgd_ind6', $this->tableName);
        $this->dropIndex('amx_flgd_ind7', $this->tableName);
        $this->dropIndex('amx_flgd_ind8', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
