<?php

namespace app\modules\versiSatu\controllers;

use app\components\Controller;
use app\models\Payee;
use yii\web\NotFoundHttpException;
use app\models\search\PayeeSearch;
use app\components\Helpers;
use Yii;

class PayeeController extends Controller
{
    public function actionIndex()
    {
        $search['PayeeSearch'] = Yii::$app->request->queryParams;
        $searchModel  = new PayeeSearch();
        $dataProvider = $searchModel->search($search);
        return $this->apiCollection([
            'count'      => $dataProvider->count,
            'dataModels' => $dataProvider->models,
        ], $dataProvider->totalCount);
    }

    public function actionCreate()
    {
        $dataRequest['Payee'] = Yii::$app->request->getBodyParams();
        $model = new Payee();
        if($model->load($dataRequest)) {
            $model->status = 10;
            $model->created_by = Yii::$app->user->identity->username; 
            $model->save(false);
            return $this->apiCreated($model);
        }

        return $this->apiValidate($model->errors);
    }
    public function actionUpdate($id)
    {
        $dataRequest['Payee'] = Yii::$app->request->getBodyParams();
        $model= Payee::findOne(['id'=>$id]);
        if($model->load($dataRequest)) {
            $model->status = 10;
            $model->created_by = Yii::$app->user->identity->username; 
            $model->save(false);
            return $this->apiUpdated($model);
        }

        return $this->apiValidate($model->errors);
    }
    public function actionView($id)
    {
        return $this->apiItem($this->findModel($id));
    }

    public function actionDelete($id)
    {
        if($this->findModel($id)->delete()) {
            return $this->apiDeleted(true);
        }
        return $this->apiDeleted(false);
    }

    protected function findModel($id)
    {
        if(($model = Payee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Resource not found');
        }
    }
}
