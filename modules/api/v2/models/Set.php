<?php


namespace app\modules\api\v2\models;


use yii\db\ActiveRecord;

class Set extends ActiveRecord
{
    public static function tableName()
    {
        return 'sets';
    }

    public function getProducts()
    {
        return $this->hasMany(new Product(), ['product_id' => 'product_id'])
            ->viaTable('sets_products', ['set_id' => 'id']);
    }
}