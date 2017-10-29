<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m171029_092158_create_users_table extends Migration
{
    private $tableName = '{{%app_user}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned(),
            'username' => $this->string(32)->notNull()->unique(),
            'email' => $this->string(128)->notNull()->unique(),
            'passwordHash' => $this->string(60),
            'status' => $this->smallInteger(1)->unsigned(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);
        $this->createIndex('user_ind1', $this->tableName, 'username', true);
        $this->createIndex('user_ind2', $this->tableName, 'email', true);
        $this->createIndex('user_ind3', $this->tableName, 'status');
        $this->createIndex('user_ind4', $this->tableName, 'created_at');
        $this->createIndex('user_ind5', $this->tableName, 'updated_at');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('user_ind1', $this->tableName);
        $this->dropIndex('user_ind2', $this->tableName);
        $this->dropIndex('user_ind3', $this->tableName);
        $this->dropIndex('user_ind4', $this->tableName);
        $this->dropIndex('user_ind5', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
