<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\base\BaseObject;
class CalculatorData extends BaseObject
{
    const MY_CLASS = "result";
    // private  $Schrot = ["январь" => ["25"=>125,"50"=> 145,"75"=> 136,"100"=>  138], 
    // "февраль" => ["25"=>121,"50"=>  118,"75"=>  137, "100"=> 142], 
    // "август" => ["25"=>137,"50"=>  119,"75"=>  141,"100"=>  117],
    // "сентябрь" => ["25"=>126,"50"=>  121,"75"=>  137,"100"=>  120], 
    // "октябрь" => ["25"=>124,"50"=>  122,"75"=>  131,"100"=>  147], 
    // "ноябрь" => ["25"=>128,"50"=>  147,"75"=>  143, "100"=> 112]
    // ];
    // private  $cake = ["январь" => ["25"=>121,"50"=>  118,"75"=>  137,"100"=> 142], 
    // "февраль" => ["25"=>137, "50"=> 121,"75"=>  124,"100"=> 131], 
    // "август" => ["25"=>124,"50"=>  145,"75"=>  136,"100"=> 138],
    // "сентябрь" => ["25"=>137,"50"=>  147,"75"=>  143,"100"=> 112], 
    // "октябрь" => ["25"=>122,"50"=>  143,"75"=>  112,"100"=> 117], 
    // "ноябрь" => ["25"=>125,"50"=>  145,"75"=>  136,"100"=> 138]
    // ];
    // private   $soy = ["январь" => ["25"=>137,"50"=>  147,"75"=>  112,"100"=> 122], 
    // "февраль" => ["25"=>125,"50"=>  145,"75"=>  136,"100"=> 138], 
    // "август" => ["25"=>124,"50"=>  145,"75"=>  136,"100"=> 138],
    // "сентябрь" => ["25"=>122,"50"=>  143,"75"=>  112,"100"=> 117], 
    // "октябрь" => ["25"=>137,"50"=>  119,"75"=>  141,"100"=> 117], 
    // "ноябрь" => ["25"=>121,"50"=>  118,"75"=>  137,"100"=> 142]
    // ];
    // public $month;
    // public $tonnage;
    // public $type;
    // public $result;
    public $months = [
        1 => 'Январь',
        2 => 'Февраль',
        3 => 'Август',
        4 => 'Сентябрь',
        5 => 'Октябрь',
        6 => 'Ноябрь'
        ];
    
        public $tonnages = [
        25 => 25,
        50 => 50,
        75 => 75,
        100 => 100
        ];
        
        public $types = [
        1 => 'Шрот',
        2 => 'Жмых',
        3 => 'Соя'
        ];
    
        public $prices = [
            1 => [
                25 => [1 => 125, 2 => 121, 3 => 137, 4 => 126, 5 => 124, 6 => 128],
                50 => [1 => 145, 2 => 118, 3 => 119, 4 => 121, 5 => 122, 6 => 147],
                75 => [1 => 136, 2 => 137, 3 => 141, 4 => 137, 5 => 131, 6 => 143],
                100 => [1 => 138, 2 => 142, 3 => 117, 4 => 124, 5 => 147, 6 => 112]
            ],
        
            2 => [
                25 => [1 => 121, 2 => 137, 3 => 124, 4 => 137, 5 => 122, 6 => 125],
                50 => [1 => 118, 2 => 121, 3 => 145, 4 => 147, 5 => 143, 6 => 145],
                75 => [1 => 137, 2 => 124, 3 => 136, 4 => 143, 5 => 112, 6 => 136],
                100 => [1 => 142, 2 => 131, 3 => 138, 4 => 112, 5 => 117, 6 => 138]
            ],
                
            3 => [
                25 => [1 => 137, 2 => 125, 3 => 124, 4 => 122, 5 => 137, 6 => 121],
                50 => [1 => 147, 2 => 145, 3 => 145, 4 => 143, 5 => 119, 6 => 118],
                75 => [1 => 112, 2 => 136, 3 => 136, 4 => 112, 5 => 141, 6 => 137],
                100 => [1 => 122, 2 => 138, 3 => 138, 4 => 117, 5 => 117, 6 => 142]
            ]
        ];
    public function rules()
    {
        return [
            [['month', 'type', 'tonnage'], 'required'],
            
        ];
    }
    public function getResult()
    {    
       
            switch($this->type){
            case "шрот":
                $this->result = $this->Schrot[$this->month][$this->tonnage];
                break;
            case "жмых":
                $this->result = $this->cake[$this->month][$this->tonnage];
                break;
            case "соя":
                $this->result = $this->soy[$this->month][$this->tonnage];
                break;
            } 
        
        return $this->result;
        
    }
    public function getSchrot(){
        return $this->Schrot;
    }
    public function getCake(){
        return $this->cake;
    }
    public function getSoy(){
        return $this->soy;
    }
     /**
     * Генерация таблицы
     * @param int $type - номер типа товара
     */
    public function makeTable($type)
    {
        /*$table = new Table;
        $table->class('table table-bordered table-striped');
        $row = $table->header()->row();
        $row->cell('Месяц');
        
        foreach ($this->months as $monthItem) {
             $row->cell($monthItem);
        }

        foreach ($this->tonnages as $keyTonnage => $tonnageItem) {
            $row = $table->body()->row();
            $row->cell($tonnageItem);
                for($i = 0; $i < 6; $i++) {
                    $row->cell($this->prices[$type][$keyTonnage][$i]);
                }
        }
        return $table->render();*/

        $myData = new CalculatorData;

        $str = "<h3>Таблица расчёта стоимости:</h3>
        <table class='table'>
            <h5>- " . $myData->types[$type] . "</h5>
                <thead class='thead-dark'>
                    <tr>
                        <th style='text-align: left' scope='col'>
                            Тоннаж
                        </th>";
        foreach ($myData->months as $keym => $mon) {
            $str = $str . "<th scope='col'>" . $mon . "</th>";
        }

        $str = $str . "</tr></thead><tbody>";

        foreach ($myData->tonnages as $keyton => $ton) {
            $str = $str . "<tr> <th scope='row'>" . $ton . "</th>";
            foreach ($myData->prices[$type][$keyton] as $keyp => $price) {
                $str = $str . "<td>" . $price . "</td>";
            }
            $str = $str . "</tr>";
        }
        $str = $str . "</tbody>
        </table>";

        return $str;
    }

    /**
     * Отображение данных, полученных из формы
     * @param int $prices - стоимость перевозки
     * @param string $type - тип перевозимого товара
     * @param string $table - таблица, сгенерированная по типу
     * 
     * @return string возвращает html разметку, отправляемую на форму
     */
    public function viewResult($price, $type, $table, $tonnage, $month)
    {
        $text = "Полученные данные: месяц - " . $month . ", тоннаж - " . $tonnage . ", тип сырья - " . $type;
        $text = $text . "<h3 style = 'color: red'> Цена доставки товара - " . $price . "</h3>";
        return $text . $table;
    }
}