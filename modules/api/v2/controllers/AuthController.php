<?php


namespace app\modules\api\v2\controllers;
use app\modules\api\v2\repository\UserRepository;
use sizeg\jwt\Jwt;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\rest\Controller;
use yii\web\HttpException;

class AuthController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => [
                'login',
            ],
        ];

        return $behaviors;
    }

    protected function verbs()
    {
        return [
            'login' => ['POST'],
        ];
    }

    public function actionLogin()
    {
        $request = Yii::$app->request->bodyParams;
        $userRepository = new UserRepository();
        if (!isset($request['phone_number'])) {
            throw new HttpException(403,'Заполните поле номер телефона');
        }
        $user = $userRepository->findByPhone($request['phone_number']);
        if (empty($user)) {
            throw new HttpException(403,'Неверное имя пользователя или пароль');
        }
        /** @var Jwt $jwt */
        $jwt = Yii::$app->jwt;
        $signer = $jwt->getSigner('HS256');
        $key = $jwt->getKey();
        $time = time();
        $token = $jwt->getBuilder()
            ->expiresAt($time + 36000)// Configures the expiration time of the token (exp claim)
            ->withClaim('uid', $user['user_id'])// Configures a new claim, called "uid"
            ->getToken($signer, $key); // Retrieves the generated token

        return $this->asJson([
            'token' => (string)$token,
            $user
        ]);
    }
}