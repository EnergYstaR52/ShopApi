<?php


namespace app\modules\api\v2\repository;

use Yii;
use yii\db\Query;

class UserRepository
{
    private $table;
    private $queryBuilder;
    public function __construct() {
        $this->table = 'users';
        $this->queryBuilder = new Query;
    }

    public function findByPhone(string $phone)
    {
        return $this->queryBuilder
               ->select('*')
               ->from($this->table)
               ->where(['phone_number' => $phone])
               ->one();
    }

    public function findById(string $id)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->table)
            ->where(['user_id' => $id])
            ->one();
    }

}