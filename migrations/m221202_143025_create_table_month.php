<?php

use yii\db\Migration;

/**
 * Class m221202_143025_create_table_month
 */
class m221202_143025_create_table_month extends Migration
{
    const TABLE_NAME = 'month';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->CreateTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->notNull()
        ]);

        $month = [
            1 => 'январь',
            2 => 'февраль',
            3 => 'август',
            4 => 'сентябрь',
            5 => 'октябрь',
            6 => 'ноябрь'
        ];

        foreach ($month as $id => $name) {
            $this->insert(self::TABLE_NAME, [
                'id' => $id,
                'name' => $name
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
