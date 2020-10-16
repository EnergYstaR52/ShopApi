<?php


namespace app\modules\api\v2\repository;


use app\modules\api\v2\models\Product;
use yii\db\Query;

class ProductRepository
{
    private $table;
    private $queryBuilder;
    private $model;

    public function __construct() {
        $this->queryBuilder = new Query;
        $this->model = new Product();
        $this->table = $this->model::tableName();
    }

    public function findAll() : ?array
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->table)
            ->all();
    }

    public function findByUserBrands(string $user_id) : ?array
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->table)
            ->leftJoin('users2brands', 'brands.brand_id = users2brands.brand_id')
            ->where('users2brands.user_id=:user_id', [':user_id' => $user_id])
            ->andWhere('users2brands.status=1')
            ->all();
    }

    public function findById(string $id) :?array
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->table)
            ->where('id=:id', [':id' => $id])
            ->one();
    }

    public function findByFilters(array $filters, int $offset = null, int $limit = 20) :? array
    {
        var_dump($filters);
        $mainQuerry =  $this->queryBuilder
            ->select('*')
            ->from($this->table)
            ->offset($offset)
            ->limit($limit);
        if (!empty($filters['materials'])) {
        $subMaterialQuerry= (new Query())->select('product_id')->from('products_materials')->where(['in','material_id', $filters['materials']]);
            $mainQuerry->andWhere(['in','product_id', $subMaterialQuerry]);
        }
        if (!empty($filters['materials']))
       return $mainQuerry->all();

    }

    public function findForEmployee()
    {

    }


}