<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%connectivity_type}}`.
 */
class m231009_044948_create_disaster_alter_table extends  \components\migration\Migration {
    public $tableName = 'disaster_alter';
    public $modelName = 'DisasterAlter';
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        try {
            $this->dropTableIfExists($this->tableName);
        } catch (Exception $ex) {
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'identifier' => $this->string()->unique(),
            'headline' => $this->string(),
            'contact' => $this->string(),
            'severity' => $this->string(),
            'parameter' => $this->string(),
            'user_count' => $this->integer()->defaultValue(0),
            'sent_user_count' => $this->integer()->defaultValue(0),
            'effective' => $this->date(),
            'expired' => $this->date(),
            'event' => $this->json(),
            'meta_data' => 'JSON',
            // 'subscriber_account' => $this->integer(),
            // 'name' => $this->string(255)->notNull()->unique(),
            // 'code' => $this->string(50)->notNull()->unique(),
            /**/
            'description' => $this->string(1000)->null()->defaultExpression('null'),
            'status' => $this->integer(2)->notNull()->defaultValue(app\models\Status::ACTIVE),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull()->defaultValue(0)
        ]);
        $this->createIndex(
            'idx-' . $this->tableName . '-status',
            $this->tableName,
            ['status']
        );

        $this->createPermission();
    }

    public function callcreatePermission() {
        $this->createPermission();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->removePermission();
        $this->dropTableForcefully();
    }
}
