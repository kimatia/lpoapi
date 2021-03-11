<?php

namespace app\modules\versiSatu\controllers;

use app\components\Controller;
use app\models\BankStatement;
use yii\web\NotFoundHttpException;
use app\models\search\BankStatementSearch;
use app\components\Helpers;
use Yii;
use yii\web\UploadedFile;
use app\models\Authorize;
use ruskid\csvimporter\CSVImporter;
use ruskid\csvimporter\CSVReader;
use ruskid\csvimporter\ImportInterface;
use ruskid\csvimporter\MultipleImportStrategy;
use ruskid\csvimporter\BaseImportStrategy;

class BankStatementController extends Controller
{
    public function actionIndex()
    {
        $search['BankStatementSearch'] = Yii::$app->request->queryParams;
        $searchModel  = new BankStatementSearch();
        $dataProvider = $searchModel->search($search);
        return $this->apiCollection([
            'count'      => $dataProvider->count,
            'dataModels' => $dataProvider->models,
        ], $dataProvider->totalCount);
    }

   public function actionCreate()
    {
        $dataRequest['BankStatement'] = Yii::$app->request->getBodyParams();
        $model = new BankStatement();
        if($model->load($dataRequest)) {
            $file = $_FILES['statement'];
            $model->statement = new UploadedFile([
                'name' => $file['name'],
                'tempName' => $file['tmp_name'],
                'type' => $file['type'],
                'size' => $file['size'],
                'error' => $file['error'],
                ]);
            $baseName = Helpers::randomString();
            $newfile = $baseName.'.'.$model->statement->extension;
            if ($model->statement->saveAs(Yii::getAlias('@webroot').'/bills/'. $newfile)) {
                $importer = new CSVImporter();
            $importer->setData(new CSVReader([
                'filename' => Yii::getAlias('@webroot').'/bills/'. $newfile,
                'fgetcsvOptions' => [
                    'delimiter' => ','
                ]
            ]));
            $importer->import(new MultipleImportStrategy([
            'tableName' => BankStatement::tableName(),
            'className' => BankStatement::className(),
            'configs' => [
                    [
                        'attribute' => 'serial_number',
                        'value' => function ($line) {
                            return $line[0];
                        },
                    ],
                    [
                        'attribute' => 'transaction_date',
                        'value' => function ($line) {
                             return $line[1];
                        },
                    ],
                    [
                        'attribute' => 'refference_no',
                        'value' => function ($line) {
                            return $line[2];
                        },
                    ],
                    [
                        'attribute' => 'payee',
                        'value' => function ($line) {
                            return $line[3];
                        },
                    ],
                    [
                        'attribute' => 'transaction_details',
                        'value' => function ($line) {
                            return $line[4];
                        },
                    ],
                    [
                        'attribute' => 'dr_amount',
                        'value' => function ($line) {
                            return $line[5];
                        },
                    ],
                    [
                        'attribute' => 'cr_amount',
                        'value' => function ($line) {
                            return $line[6];
                        },
                    ],
                    [
                        'attribute' => 'bank_balance',
                        'value' => function ($line) {
                            return $line[7];
                        },
                    ]
                ],         
            ]));
            }
            return $this->apiUpdated($model);
        }

        return $this->apiValidate($model->errors);
    }
    public function actionUpdate($id)
    {
        $dataRequest['BankStatement'] = Yii::$app->request->getBodyParams();
        $model= BankStatement::findOne(['statement_id'=>$id]);
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
        if(($model = BankStatement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Resource not found');
        }
    }
}
