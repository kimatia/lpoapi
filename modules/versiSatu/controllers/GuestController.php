<?php

namespace app\modules\versiSatu\controllers;

use app\components\Controller;
use app\models\forms\RegisterForm;
use app\models\forms\ChangePassword;
use app\models\forms\ResetPasswordForm;
use yii\filters\AccessControl;
use app\models\forms\LoginForm;
use Yii;

class GuestController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'login', 'register'],
                        'allow' => true,
                    ],

                ],
            ]
        ];
    }

    /**
     * @SWG\Definition(
     *   definition="About",
     *   type="object",
     *   required={"name", "description", "version", "baseUrl"},
     *   allOf={
     *     @SWG\Schema(
     *       @SWG\Property(property="name", type="string", description="Name App"),
     *       @SWG\Property(property="description", type="string", description="Detail Information App"),
     *       @SWG\Property(property="version", type="string", description="Version APP"),
     *       @SWG\Property(property="baseUrl", type="string", description="Base Url APP")
     *     )
     *   }
     * )
     */
    public function actionIndex()
    {
        $params = Yii::$app->params;
        return [
            'name' => $params['name'],
            'description' => $params['description'],
            'version' => $params['version'],
            'baseUrl' => $this->baseUrl()
        ];
    }

    /**
     * Login
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $dataRequest['LoginForm'] = Yii::$app->request->post();
        $model = new LoginForm();
        if ($model->load($dataRequest) && ($result = $model->login())) {
            return $this->apiItem($result);
        }

        return $this->apiValidate($model->errors);
    }

    /**
     * Register
     *
     * @return mixed
     */
    public function actionRegister()
    {
        $dataRequest['RegisterForm'] = Yii::$app->request->getBodyParams();
        $model = new RegisterForm();
        if ($model->load($dataRequest)) {
            if ($user = $model->register()) {
                return $this->apiCreated($user);
            }
        }

        return $this->apiValidate($model->errors);
    }
}
