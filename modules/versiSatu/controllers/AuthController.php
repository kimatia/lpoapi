<?php

namespace app\modules\versiSatu\controllers;

use app\components\Controller;
use app\models\forms\ResetPasswordForm;
use Yii;

class AuthController extends Controller
{
    public function actionMe()
    {
        $user = Yii::$app->user->identity;
        /* remove token */
        unset($user['token']);

        return $this->apiItem($user);
    }
    public function actionChange()
    {
        $model = new ResetPasswordForm();
        $dataRequest['ResetPasswordForm'] = Yii::$app->request->post();
            //Yii::$app->response->format= Response::FORMAT_JSON;
            if ($model->load($dataRequest) && ($result = $model->change())) {
            return $this->apiItem($result);
        }
        return $this->apiValidate($model->errors);

    }
}
