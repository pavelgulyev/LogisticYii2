<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use yii\widgets\ActiveForm;
use app\models\ContactForm;
use app\models\CalculatorData;
use app\models\CalculatorForm;
use app\models\MyClassAjax;
use yii\console\widgets\Table;
use app\models\repositories\DataRepository;

class CalculatorController extends Controller
{
   
    public function actionIndex()
    {
        $repository = new DataRepository();
        $months = $repository->findMonths();
        $types = $repository->findTypes();
        $tonnages = $repository->findTonnages();
        
        $myform = new CalculatorForm;
        if(Yii::$app->request->isAjax && $myform->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($myform);
        }
        return $this->render('form', [
            'myForm' => $myform,
            'months' => $months,
            'tonnages' => $tonnages,
            'types' => $types,
        ]);
    }
    /**
     * Печать ответа после ajax-запроса на расчет
     */
    public function actionFill()
    {
        $myForm = new CalculatorForm;

        $repository = new DataRepository();

        $months = $repository->findMonths();
        $tonnages = $repository->findTonnages();
        $types = $repository->findTypes();
        $prices = $repository->findPriceAll();


        if ($myForm->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            $type = $types[$myForm->type];
            $month = $months[$myForm->month];
            $tonnage = $tonnages[$myForm->tonnage];

            $price = $repository->findPriceOneByParamsId($myForm->type, $myForm->tonnage, $myForm->month)['value'];
            $table = $this->makeTable($myForm->type);
            $message =  $this->viewResult($price, $type, $table, $tonnage, $month);

            Yii::$app->response->format = Response::FORMAT_JSON;

            return [
                'message' => $message,
            ];
        }
    }

    /**
     * Генерация таблицы
     * @param int $type - номер типа товара
     */
    private function makeTable($type)
    {
        $repository = new DataRepository();
        $months = $repository->findMonths();
        $tonnages = $repository->findTonnages();

        // использование расширения 'Tlr' для вывода таблицы
        $table = new Table;
        $table->class('table table-bordered table-striped');
        $row = $table->header()->row();
        $row->cell('Месяцы');

        foreach ($months as $monthItem) {
            $row->cell($monthItem);
        }

        foreach ($tonnages as $keyton => $ton) {
            $row = $table->body()->row();
            $row->cell($ton);
            foreach ($months as $keymon => $mon) {
                $row->cell($repository->findPriceOneByParamsId($type, $keyton, $keymon)['value']);
            }
        }

        return $table->render();
    }

    /**
     * Отображение данных, полученных из формы
     * @return string возвращает html разметку, отправляемую на форму
     */
    private function viewResult($price, $type, $table, $tonnage, $month)
    {
        $text = "Полученные данные: месяц - " . $month . ", тоннаж - " . $tonnage . ", тип сырья - " . $type;
        $text = $text . "<h3 style = 'color: red'> Цена доставки товара - " . $price . "</h3>";
        return $text . $table;
    }
}
    
