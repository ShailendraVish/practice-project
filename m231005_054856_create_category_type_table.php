<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%connectivity_type}}`.
 */
class m231005_054856_create_category_type_table extends  \components\migration\Migration {
    public $tableName = 'category_type';
    public $modelName = 'CategoryType';
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
            'name' => $this->string(255)->notNull()->unique(),
            'code' => $this->string(50)->notNull()->unique(),
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
