<?php
   use yii\helpers\Html;
   use yii\widgets\ActiveForm;
   use yii\widgets\Pjax;
   
?>
<div class="row">
    <div class="col-lg-7">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
        </script>
        <h2>Калькулятор стоимости доставки сырья</h2>
        <?php
        $form = ActiveForm::begin([
            'id' => 'logistic-form',
            'enableAjaxValidation' => true,
            'options' => [
                'onsubmit' => 'return false'
            ]
        ]);

        echo $form->field($myForm, 'month')->dropDownList($months, ['prompt' => 'Месяц...']);
        echo $form->field($myForm, 'tonnage')->dropDownList($tonnages, ['prompt' => 'Грузоподъемность...']);
        echo $form->field($myForm, 'type')->dropDownList($types, ['prompt' => 'Тип...']);
        ?>

        <div class="form-group">
            <?= Html::submitButton('Рассчитать', ['class' => 'btn btn-primary']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<div class="row p-5">
    <div id="print"></div>
</div>
