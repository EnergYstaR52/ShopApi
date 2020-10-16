<?php


namespace app\modules\api\v2\models;


use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'products';
    }
}