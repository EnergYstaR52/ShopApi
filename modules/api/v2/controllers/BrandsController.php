<?php


namespace app\modules\api\v2\controllers;


use app\modules\api\v2\service\UserService;
use app\modules\api\v2\repository\BrandsRepository;
use yii\rest\Controller;

class BrandsController extends Controller
{
    protected function verbs()
    {
        return [
            'index' => ['GET'],
        ];
    }

    public function actionIndex()
    {
        $userService = new UserService();
        $userId = $userService->checkIndentity();
        if ($userId) {
            $brands = (new BrandsRepository())->findByUserId($userId);
        } else {
            $brands = (new BrandsRepository())->findAll();
        }
        return $this->asJson([
            count($brands),
            $brands
        ]);
    }
}