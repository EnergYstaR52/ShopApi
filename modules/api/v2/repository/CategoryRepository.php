<?php


namespace app\modules\api\v2\repository;


use yii\db\Query;

class CategoryRepository
{
    private $table;
    private $queryBuilder;

    public function __construct() {
        $this->table = 'categories';
        $this->queryBuilder = new Query;
    }

    public function findAll() : ?array
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->table)
            ->all();
    }
}