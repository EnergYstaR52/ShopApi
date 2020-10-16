<?php


namespace app\modules\api\v2\repository;


use app\modules\api\v2\models\Set;
use yii\db\ActiveRecord;
use yii\db\Query;

class OrderRepository
{
    private $table;
    private $queryBuilder;
    private $model;

    public function __construct() {
        $this->queryBuilder = new Query;
        $this->model = new Set();
        $this->table = $this->model::tableName();
    }

    public function findByById(string $id) : ?ActiveRecord
    {
        return $this->model::findOne(['order_id' => $id]);
    }
}