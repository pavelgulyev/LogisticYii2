<?php

use yii\db\Migration;

/**
 * Class m221202_143015_create_table_tonnage
 */
class m221202_143015_create_table_tonnage extends Migration
{
    const TABLE_NAME = 'tonnage';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->CreateTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'value' => $this->integer()->notNull(),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->notNull()
        ]);

        $tonnages = [
            1 => 25,
            2 => 50,
            3 => 75,
            4 => 100
        ];

        foreach ($tonnages as $id => $value) {
            $this->insert(self::TABLE_NAME, [
                'id' => $id,
                'value' => $value
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }    
}
