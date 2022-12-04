<?php

use yii\db\Migration;

/**
 * Class m221202_143037_create_table_price
 */
class m221202_143037_create_table_price extends Migration
{
    const TABLE_NAME = 'price';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->CreateTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'month_id' => $this->integer()->notNull(),
            'tonnage_id' => $this->integer()->notNull(),
            'type_id' => $this->integer()->notNull(),
            'value' => $this->integer()->defaultValue(0)->notNull(),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->notNull()
        ]);

        $prices = [
            1 => [
                1 => [1 => 125, 2 => 121, 3 => 137, 4 => 126, 5 => 124, 6 => 128],
                2 => [1 => 145, 2 => 118, 3 => 119, 4 => 121, 5 => 122, 6 => 147],
                3 => [1 => 136, 2 => 137, 3 => 141, 4 => 137, 5 => 131, 6 => 143],
                4 => [1 => 138, 2 => 142, 3 => 117, 4 => 124, 5 => 147, 6 => 112]
            ],
    
            2 => [
                1 => [1 => 121, 2 => 137, 3 => 124, 4 => 137, 5 => 122, 6 => 125],
                2 => [1 => 118, 2 => 121, 3 => 145, 4 => 147, 5 => 143, 6 => 145],
                3 => [1 => 137, 2 => 124, 3 => 136, 4 => 143, 5 => 112, 6 => 136],
                4 => [1 => 142, 2 => 131, 3 => 138, 4 => 112, 5 => 117, 6 => 138]
            ],
    
            3 => [
                1 => [1 => 137, 2 => 125, 3 => 124, 4 => 122, 5 => 137, 6 => 121],
                2 => [1 => 147, 2 => 145, 3 => 145, 4 => 143, 5 => 119, 6 => 118],
                3 => [1 => 112, 2 => 136, 3 => 136, 4 => 112, 5 => 141, 6 => 137],
                4 => [1 => 122, 2 => 138, 3 => 138, 4 => 117, 5 => 117, 6 => 142]
            ]
        ];

        foreach ($prices as $typeId => $priceData) {
            foreach ($priceData as $tonnageId => $monthData) {
                foreach ($monthData as $monthId => $value) {
                    $this->insert(self::TABLE_NAME, [
                        'type_id' => $typeId,
                        'tonnage_id' => $tonnageId,
                        'month_id' => $monthId,
                        'value' => $value
                    ]);
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221202_143037_create_table_price cannot be reverted.\n";

        return false;
    }
    */
}
