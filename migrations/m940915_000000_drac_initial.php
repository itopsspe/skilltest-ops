<?php

use yii\db\Migration;

class m940915_000000_drac_initial extends Migration
{
    public function up()
    {
        $initialAuth = Yii::$app->params['initial_auth'];

        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        if (Yii::$app->db->getTableSchema($initialAuth['application_log'], true) !== null) {
            $this->dropTable($initialAuth['application_log']);
        }
        
        $this->createTable($initialAuth['application_log'], [
            'id' => $this->bigPrimaryKey(),
            'level' => $this->integer(11),
            'category' => $this->string(255),
            'log_time' => $this->double(),
            'prefix' => $this->text(),
            'message' => $this->text(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ], $tableOptions);

        $this->createIndex($initialAuth['application_log'].'_level_key', $initialAuth['application_log'], 'level');
        $this->createIndex($initialAuth['application_log'].'_category_key', $initialAuth['application_log'], 'category');

        if (Yii::$app->db->getTableSchema($initialAuth['assignment'], true) !== null) {
            $this->dropTable($initialAuth['assignment']);
        }

        $this->createTable($initialAuth['assignment'], [
            'item_name' => $this->string(64)->notNull(),
            'user_id' => $this->string(64)->notNull(),
            'created_at' => $this->integer(11),
            'PRIMARY KEY ([[item_name]], [[user_id]])'
        ], $tableOptions);

        $this->createIndex($initialAuth['assignment'].'_user_id_key', $initialAuth['assignment'], 'user_id');

        if (Yii::$app->db->getTableSchema($initialAuth['item'], true) !== null) {
            $this->dropForeignKey('auth_assignment_auth_item_drac_1', $initialAuth['assignment']);
            
            $this->dropTable($initialAuth['item']);
        }

        $this->createTable($initialAuth['item'], [
            'name' => $this->string(64)->notNull(),
            'type' => $this->smallInteger(6)->notNull(),
            'description' => $this->text(),
            'rule_name' => $this->string(64),
            'data' => $this->binary(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'PRIMARY KEY ([[name]])'
        ], $tableOptions);

        $this->createIndex($initialAuth['item'].'_rule_name_key', $initialAuth['item'], 'rule_name');
        $this->createIndex($initialAuth['item'].'_type_key', $initialAuth['item'], 'type');

        if (Yii::$app->db->getTableSchema($initialAuth['item_child'], true) !== null) {
            $this->dropTable($initialAuth['item_child']);
        }

        $this->createTable($initialAuth['item_child'], [
            'parent' => $this->string(64)->notNull(),
            'child' => $this->string(64)->notNull(),
            'PRIMARY KEY ([[parent]], [[child]])'
        ], $tableOptions);

        $this->createIndex($initialAuth['item_child'].'_child_key', $initialAuth['item_child'], 'child');
        
        if (Yii::$app->db->getTableSchema($initialAuth['rule'], true) !== null) {
            $this->dropTable($initialAuth['rule']);
        }

        $this->createTable($initialAuth['rule'], [
            'name' => $this->string(64)->notNull(),
            'data' => $this->binary(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY ([[name]])',
        ], $tableOptions);

        if (Yii::$app->db->getTableSchema($initialAuth['menu'], true) !== null) {
            $this->dropTable($initialAuth['menu']);
        }

        $this->createTable($initialAuth['menu'], [
            'id' => $this->bigPrimaryKey(),
            'name' => $this->string(128)->notNull(),
            'parent' => $this->integer(),
            'route' => $this->string(255),
            'order' => $this->integer(),
            'icon' => $this->string(55),
            'data' => $this->text()
        ], $tableOptions);

        $this->createIndex($initialAuth['menu'].'_parent_key', $initialAuth['menu'], 'parent');

        if (Yii::$app->db->getTableSchema($initialAuth['user'], true) !== null) {
            $this->dropTable($initialAuth['user']);
        }

        $this->createTable($initialAuth['user'], [
            'id' => $this->bigPrimaryKey(),
            'name' => $this->string(255)->notNull(),
            'username' => $this->string(32)->notNull(),
            'email' => $this->string(190)->notNull(),
            'auth_key' => $this->string(32),
            'password_hash' => $this->string(255)->notNull(),
            'password_reset_token' => $this->string(255),
            'status' => $this->string(15)->notNull(),
            'last_login_datetime' => $this->dateTime()->defaultValue('0000-00-00 00:00:00'),
            'created_datetime' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_datetime' => $this->dateTime()->defaultValue('0000-00-00 00:00:00')
        ], $tableOptions);

        $this->createIndex($initialAuth['user'].'_username_key', $initialAuth['user'], 'username', true);
        $this->createIndex($initialAuth['user'].'_user_key', $initialAuth['user'], ['id', 'name', 'username', 'email'], true);

        $this->createTable('under_maintenance', [
            'id' => $this->primaryKey(),
            'status' => $this->string(128)->notNull(),
            'updated_at' => $this->dateTime()->defaultValue('0000-00-00 00:00:00')
        ], $tableOptions);

        $this->createIndex('under_maintenance'.'_setting_key', 'under_maintenance', ['id', 'status', 'updated_at']);
    }

    public function down()
    {
        $initialAuth = Yii::$app->params['initial_auth'];

        $this->dropTable($initialAuth['application_log']);
        $this->dropTable($initialAuth['assignment']);
        $this->dropTable($initialAuth['item']);
        $this->dropTable($initialAuth['item_child']);
        $this->dropTable($initialAuth['rule']);
        $this->dropTable($initialAuth['menu']);
        $this->dropTable($initialAuth['user']);
    }

    protected function buildFkClause($delete = '', $update = '')
    {
        return implode(' ', ['', $delete, $update]);
    }
}
