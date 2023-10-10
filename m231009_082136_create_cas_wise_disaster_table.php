<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%connectivity_type}}`.
 */
class m231009_082136_create_cas_wise_disaster_table extends  \components\migration\Migration {
    public $tableName = 'cas_wise_disaster';
    public $modelName = 'CasWiseDisaster';
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
            'disaster_alter_id' => $this->integer()->notNull(),
            'cas_id' => $this->integer(),
            'effective' => $this->date(),
            'expired' => $this->date(),
            'template' => $this->string(),
            'cas_account_count' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(0),
            /**/
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull()->defaultValue(0)
        ]);
        $this->addForeignKey(
            'fk-disaster_alter_id',
            '{{%cas_wise_disaster}}',
            'disaster_alter_id',
            '{{%disaster_alter}}',
            'id',
            'CASCADE'
        );
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
