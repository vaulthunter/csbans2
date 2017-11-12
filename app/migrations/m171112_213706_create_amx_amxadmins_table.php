<?php

use yii\db\Migration;

/**
 * Handles the creation of table `amx_amxadmins`.
 */
class m171112_213706_create_amx_amxadmins_table extends Migration
{
    private $tableName = '{{%amxadmins}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'username' => $this->string(32)->null(),
            'password' => $this->string(64)->null(),
            'access' => $this->string(26)->null(),
            'flags' => $this->string(10)->null(),
            'steamid' => $this->string(32)->notNull(),
            'nickname' => $this->string(32)->null(),
            'icq' => $this->string(10)->null(),
            'ashow' => $this->boolean()->notNull()->unsigned()->defaultValue(true),
            'created' => $this->integer()->unsigned()->notNull(),
            'expired' => $this->integer()->unsigned()->null(),
            'days' => $this->smallInteger()->unsigned()->null(),
        ]);
        $this->createIndex('amx_admins_ind1', $this->tableName, 'username');
        $this->createIndex('amx_admins_ind2', $this->tableName, 'steamid', true);
        $this->createIndex('amx_admins_ind3', $this->tableName, 'nickname');
        $this->createIndex('amx_admins_ind4', $this->tableName, 'icq');
        $this->createIndex('amx_admins_ind5', $this->tableName, 'ashow');
        $this->createIndex('amx_admins_ind6', $this->tableName, 'created');
        $this->createIndex('amx_admins_ind7', $this->tableName, 'expired');
        $this->createIndex('amx_admins_ind8', $this->tableName, 'days');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('amx_admins_ind1', $this->tableName);
        $this->dropIndex('amx_admins_ind2', $this->tableName);
        $this->dropIndex('amx_admins_ind3', $this->tableName);
        $this->dropIndex('amx_admins_ind4', $this->tableName);
        $this->dropIndex('amx_admins_ind5', $this->tableName);
        $this->dropIndex('amx_admins_ind6', $this->tableName);
        $this->dropIndex('amx_admins_ind7', $this->tableName);
        $this->dropIndex('amx_admins_ind8', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
