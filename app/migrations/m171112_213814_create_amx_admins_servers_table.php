<?php

use yii\db\Migration;

/**
 * Handles the creation of table `amx_admins_servers`.
 */
class m171112_213814_create_amx_admins_servers_table extends Migration
{
    private $tableName = '{{%admins_servers}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'admin_id' => $this->integer()->unsigned()->notNull(),
            'server_id' => $this->integer()->unsigned()->notNull(),
            'custom_flags' => $this->string(26)->null(),
            'use_static_bantime' => "enum('yes','no') NOT NULL DEFAULT 'yes'"
        ]);
        $this->addPrimaryKey('amx_adm_srv_ind1', $this->tableName, ['admin_id', 'server_id']);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropPrimaryKey('amx_adm_srv_ind1', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
