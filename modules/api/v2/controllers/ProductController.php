<?php


namespace app\modules\api\v2\controllers;


use app\modules\api\v2\repository\ProductRepository;
use yii\rest\Controller;
use Yii;

class ProductController extends Controller
{
    protected function verbs()
    {
        return [
            'index' => ['GET'],
        ];
    }

    public function actionIndex()
    {
        $request = Yii::$app->request->bodyParams;
        $products = (new ProductRepository())->findByFilters($request['filters'], $request['offset'], $request['limit']);
        return $this->asJson([
            ['products' => $products],
        ]);
    }
}