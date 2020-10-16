<?php


namespace app\modules\api\v2\repository;


use app\modules\api\v2\service\UserService;
use yii\db\Query;

class BrandsRepository
{
    private $table;
    private $queryBuilder;
    public function __construct() {
        $this->table = 'brands';
        $this->queryBuilder = new Query;
    }

    public function findAll() : ?array
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->table)
            ->all();
    }

    public function findByUserId(string $user_id) : ?array
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->table)
            ->leftJoin('users2brands', 'brands.brand_id = users2brands.brand_id')
            ->where('users2brands.user_id=:user_id', [':user_id' => $user_id])
            ->andWhere('users2brands.status=1')
            ->all();
    }

    public function findIdsByUserId(string $userId) : ?array
    {
        return $this->queryBuilder
            ->select('id')
            ->from($this->table)
            ->leftJoin('users2brands', 'brands.brand_id = users2brands.brand_id')
            ->where('users2brands.user_id=:user_id', [':user_id' => $userId])
            ->andWhere('users2brands.status=1')
            ->column();
    }

}