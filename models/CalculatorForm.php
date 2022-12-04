<?php

namespace app\models;
use yii\base\Model;

/**
 * CalculatorForm - модель моей формы
 * 
 * @property int $month выбранный месяц
 * @property int $tonnage выбранный тоннаж
 * @property int $type выбранный тип
 */
class CalculatorForm extends Model
{
    public $month;
    public $tonnage;
    public $type;

    /**
     * @return array валидация
     */
    public function rules()
    {
        return [
            [['month', 'tonnage', 'type'], 'required', 'message' => 'Значение {attribute} не задано'],
            [['month', 'tonnage', 'type'], 'safe']
        ];
    }

    /**
     * @return array мои labels
     */
    public function attributeLabels()
    {
        return [
            'type' => 'Выберите тип',
            'tonnage' => 'Выберите тоннаж',
            'month' => 'Выберите месяц',
        ];
    }
}
