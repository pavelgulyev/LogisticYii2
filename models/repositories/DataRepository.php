<?php

namespace app\models\repositories;

use yii\db\Expression;
use yii\db\Query;

class DataRepository
{
    public function findMonths(): array
    {
        $data = (new Query())->select(['*'])
            ->from('month')
            ->all();

        $result = [];

        foreach ($data as $month) {
            $result[$month['id']] = $month['name'];
        }

        return $result;
    }

    public function findTonnages(): array
    {
        $data = (new Query())->select(['*'])
            ->from('tonnage')
            ->all();

        $result = [];

        foreach ($data as $tonnage) {
            $result[$tonnage['id']] = $tonnage['value'];
        }

        return $result;
    }

    public function findTypes(): array
    {
        $data = (new Query())->select(['*'])
            ->from('type')
            ->all();

        $result = [];

        foreach ($data as $type) {
            $result[$type['id']] = $type['name'];
        }

        return $result;
    }

    public function findMonthById(int $id): array
    {
        $data = (new Query())->select(['*'])
            ->from('month')
            ->where(['id' => $id])
            ->one();

        return $data;
    }

    public function findTonnageById(int $id): array
    {
        $data = (new Query())->select(['*'])
            ->from('tonnage')
            ->where(['id' => $id])
            ->one();

        return $data;
    }

    public function findTypeById(int $id): array
    {
        $data = (new Query())->select(['*'])
            ->from('type')
            ->where(['id' => $id])
            ->one();
        return $data;
    }

    public function findPriceAll(): array
    {
        $data = (new Query())->select([
            'p.*',
            'monthName' => 'm.name',
            'tonnageValue' => 'tn.value',
            'typeName' => 'tp.name'
        ])
            ->from(['p' => 'price'])
            ->leftJoin(['m' => 'month'], ['m.id' => new Expression('p.month_id')])
            ->leftJoin(['tn' => 'tonnage'], ['tn.id' => new Expression('p.tonnage_id')])
            ->leftJoin(['tp' => 'type'], ['tp.id' => new Expression('p.type_id')])
            ->all();

        return $data;
    }

    public function findPriceOneByParamsId($typeId, $tonnageId, $monthId): array
    {
        $data = (new Query())->select(['*'])
            ->from(['p' => 'price'])
            ->where([
                'month_id' => $monthId,
                'tonnage_id' => $tonnageId,
                'type_id' => $typeId
            ])
            ->one();

        return $data;
    }
}