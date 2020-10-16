<?php


namespace app\modules\api\v2\repository;


use app\modules\api\v2\models\Set;
use yii\db\ActiveRecord;
use yii\db\Query;

class SetRepository
{
    private $table;
    private $queryBuilder;
    private $model;

    public function __construct() {
        $this->queryBuilder = new Query;
        $this->model = new Set();
        $this->table = $this->model::tableName();
    }

    public function findByProductId(string $id) : ?ActiveRecord
    {
       return $this->model::findOne(['main_product_id' => $id]);
    }

    public function findByFilters(array $filters) :? array
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->table)
            ->filterWhere($filters)
            ->all();
    }

    public function findForEmployee()
    {

    }


}
