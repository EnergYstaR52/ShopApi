<?php

namespace app\modules\api\v2\controllers;

use app\modules\api\v2\repository\SetRepository;
use yii\rest\Controller;
use Yii;

class SetController extends Controller
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
        $set = (new SetRepository())->findByProductId($request['product_id']);
        return $this->asJson([
            ['set' => $set],
            ['products' => $set->products],
        ]);
    }
}