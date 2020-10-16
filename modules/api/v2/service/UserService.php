<?php


namespace app\modules\api\v2\service;

use app\modules\api\v2\repository\UserRepository;
use sizeg\jwt\JwtHttpBearerAuth;
use yii;

class UserService
{
    public $userRepository;

    public function __construct() {
       $this->userRepository = new UserRepository();
    }

    public function checkIndentity() :?string
    {
       $request = Yii::$app->request;
       $authHeader = $request->getHeaders()->get('Authorization');
       $jwtAuth = new JwtHttpBearerAuth();
       if ($token = $jwtAuth->loadToken($authHeader)) {
           return $token->getClaim('uid');
       }
       return null;
   }
}