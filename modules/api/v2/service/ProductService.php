<?php


namespace app\modules\api\v2\service;


use app\modules\api\v2\repository\ProductRepository;

class ProductService
{
    protected $productRepository;
    protected $userId;

    public function __construct($userId = null) {
        $this->productRepository = new ProductRepository();
        $this->userId = $userId;
    }
}