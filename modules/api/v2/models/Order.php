<?php


namespace app\modules\api\v2\models;


use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    public static function tableName()
    {
        return 'orders';
    }

    public function getProducts()
    {
        return $this->hasMany(new Product(), ['product_id' => 'product_id'])
            ->viaTable('orders_products', ['order_id' => 'id']);
    }
}