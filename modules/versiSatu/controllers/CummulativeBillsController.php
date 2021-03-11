<?php

namespace app\modules\versiSatu\controllers;

use app\components\Controller;
use app\models\CummulativeBills;
use yii\web\NotFoundHttpException;
use app\models\search\CummulativeBillsSearch;
use app\models\search\BankStatementSearch;
use app\components\Helpers;
use Yii;
use kartik\mpdf\Pdf;
use arturoliveira\ExcelView;
use yii2tech\spreadsheet\Spreadsheet;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use app\models\Authorize;
use ruskid\csvimporter\CSVImporter;
use ruskid\csvimporter\CSVReader;
use ruskid\csvimporter\ImportInterface;
use ruskid\csvimporter\MultipleImportStrategy;
use ruskid\csvimporter\BaseImportStrategy;

class CummulativeBillsController extends Controller
{
    public function actionIndex()
    {
        $search['CummulativeBillsSearch'] = Yii::$app->request->queryParams;
        $searchModel  = new CummulativeBillsSearch();
        $dataProvider = $searchModel->search($search);
        return $this->apiCollection([
            'count'      => $dataProvider->count,
            'dataModels' => $dataProvider->models,
        ], $dataProvider->totalCount);
    }

    public function actionCreate()
    {
        $dataRequest['CummulativeBills'] = Yii::$app->request->getBodyParams();
        $model = new CummulativeBills();
        if($model->load($dataRequest)) {
            $file = $_FILES['bills'];
            $model->bills = new UploadedFile([
                'name' => $file['name'],
                'tempName' => $file['tmp_name'],
                'type' => $file['type'],
                'size' => $file['size'],
                'error' => $file['error'],
                ]);
            $baseName = Helpers::randomString();
            $newfile = $baseName.'.'.$model->bills->extension;
            if ($model->bills->saveAs(Yii::getAlias('@webroot').'/bills/'. $newfile)) {
                $importer = new CSVImporter();
            $importer->setData(new CSVReader([
                'filename' => Yii::getAlias('@webroot').'/bills/'. $newfile,
                'fgetcsvOptions' => [
                    'delimiter' => ','
                ]
            ]));
            $importer->import(new MultipleImportStrategy([
            'tableName' => CummulativeBills::tableName(),
            'className' => CummulativeBills::className(),
            'configs' => [
                    [
                        'attribute' => 'payee',
                        'value' => function ($line) {
                            return $line[0];
                        },
                    ],
                    [
                        'attribute' => 'category',
                        'value' => function ($line) {
                             return $line[1];
                        },
                    ],
                    [
                        'attribute' => 'work_details',
                        'value' => function ($line) {
                            return $line[2];
                        },
                    ],
                    [
                        'attribute' => 'lpo_number',
                        'value' => function ($line) {
                            return $line[3];
                        },
                    ],
                    [
                        'attribute' => 'plo_sum',
                        'value' => function ($line) {
                            return $line[4];
                        },
                    ],
                    [
                        'attribute' => 'invoice_number',
                        'value' => function ($line) {
                            return $line[5];
                        },
                    ],
                    [
                        'attribute' => 'date_recorded',
                        'value' => function ($line) {
                            return $line[6];
                        },
                    ],
                    [
                        'attribute' => 'start_date',
                        'value' => function ($line) {
                            return $line[7];
                        },
                    ],
                    [
                        'attribute' => 'end_date',
                        'value' => function ($line) {
                            return $line[8];
                        },
                    ],
                    [
                        'attribute' => 'completion_status',
                        'value' => function ($line) {
                            return $line[9];
                        },
                    ],
                    [
                        'attribute' => 'cumulative_amount_invoiced',
                        'value' => function ($line) {
                            return $line[10];
                        },
                    ],
                    [
                        'attribute' => 'amount_paid',
                        'value' => function ($line) {
                            return $line[11];
                        },
                    ],
                    [
                        'attribute' => 'outstanding_amount',
                        'value' => function ($line) {
                            return $line[12];
                        },
                    ],
                    [
                        'attribute' => 'verified',
                        'value' => function ($line) {
                            return $line[13];
                        },
                    ],
                    [
                        'attribute' => 'comments',
                        'value' => function ($line) {
                            return $line[14];
                        },
                    ],
                    [
                        'attribute' => 'support_documents',
                        'value' => function ($line) {
                            return $line[15];
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
        $dataRequest['CummulativeBills'] = Yii::$app->request->getBodyParams();
        $model= CummulativeBills::findOne(['bills_id'=>$id]);
        if($model->load($dataRequest)) {
            $model->status = 10;
            $model->created_by = Yii::$app->user->identity->username; 
            $model->save(false);
            return $this->apiUpdated($model);
        }

        return $this->apiValidate($model->errors);
    }
    public function actionExport($id) {  
        $searchModel = new CummulativeBillsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $payee = (new \yii\db\Query())->select(['payee'])->from('payee')->where(['id' => $id])->one();
        $dataProvider->query->having(['payee' => $payee['payee']]);
        $exporter = new Spreadsheet(['dataProvider' => $dataProvider,
             'columns' => [
                [
                    'attribute' => 'payee',
                    'label' => 'Payee',
                    'content' => function($model){
                        return $model->payee;
                    }
                ],
                [
                    'attribute' => 'category',
                    'label' => 'Category',
                    'content' => function($model){
                        return $model->category;
                    }
                ],
                [
                    'attribute' => 'work_details',
                    'label' => 'Work details',
                    'content' => function($model){
                        return $model->work_details;
                    }
                ],
                [
                    'attribute' => 'lpo_number',
                    'label' => 'Contract/LPO/LSO No.',
                    'content' => function($model){
                        return $model->lpo_number;
                    }
                ],
                [
                    'attribute' => 'plo_sum',
                    'label' => 'Contract/LPO/LSO/ Sum',
                    'content' => function($model){
                        return $model->plo_sum;
                    }
                ],
                [
                    'attribute' => 'invoice_number',
                    'label' => 'Invoice No.',
                    'content' => function($model){
                        return $model->invoice_number;
                    }
                ],
                [
                    'attribute' => 'date_recorded',
                    'label' => 'Date recorded',
                    'content' => function($model){
                        return $model->date_recorded;
                    }
                ],
                [
                    'attribute' => 'start_date',
                    'label' => 'Start date',
                    'content' => function($model){
                        return $model->start_date;
                    }
                ],
                [
                    'attribute' => 'end_date',
                    'label' => 'End date',
                    'content' => function($model){
                        return $model->end_date;
                    }
                ],
                [
                    'attribute' => 'completion_status',
                    'label' => 'Completion status',
                    'content' => function($model){
                        return $model->completion_status;
                    }
                ],
                [
                    'attribute' => 'cumulative_amount_invoiced',
                    'label' => 'Cummulative amount invoiced',
                    'content' => function($model){
                        return $model->cumulative_amount_invoiced;
                    }
                ],
                [
                    'attribute' => 'amount_paid',
                    'label' => 'Amount Paid',
                    'content' => function($model){
                        return $model->amount_paid;
                    }
                ],
                [
                    'attribute' => 'outstanding_amount',
                    'label' => 'Outstanding amount',
                    'content' => function($model){
                        return $model->outstanding_amount;
                    }
                ],
                [
                    'attribute' => 'verified',
                    'label' => 'Verified',
                    'content' => function($model){
                        return $model->verified;
                    }
                ],
                [
                    'attribute' => 'comments',
                    'label' => 'Comments',
                    'content' => function($model){
                        return $model->comments;
                    }
                ],
                [
                    'attribute' => 'support_documents',
                    'label' => 'Support documents',
                    'content' => function($model){
                        return $model->support_documents;
                    }
                ],
              ],
    ]);
        return $exporter->send('items.xlsx');
    }
    public function actionDownload($id) {  
        $searchModel = new BankStatementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $payee = (new \yii\db\Query())->select(['payee'])->from('payee')->where(['id' => $id])->one();
        $dataProvider->query->having(['payee' => $payee['payee']]);
        $exporter = new Spreadsheet(['dataProvider' => $dataProvider,
             'columns' => [
                [
                    'attribute' => 'lpo_number',
                    'label' => 'LPO number',
                    'content' => function($model){
                        return $model->lpo_number;
                    }
                ],
                [
                    'attribute' => 'transaction_date',
                    'label' => 'Transaction date',
                    'content' => function($model){
                        return $model->transaction_date;
                    }
                ],
                [
                    'attribute' => 'refference_no',
                    'label' => 'Refference number',
                    'content' => function($model){
                        return $model->refference_no;
                    }
                ],
                [
                    'attribute' => 'payee',
                    'label' => 'Payee',
                    'content' => function($model){
                        return $model->payee;
                    }
                ],
                [
                    'attribute' => 'transaction_details',
                    'label' => 'Transaction number',
                    'content' => function($model){
                        return $model->transaction_details;
                    }
                ],
                [
                    'attribute' => 'dr_amount',
                    'label' => 'Debit amount',
                    'content' => function($model){
                        return $model->dr_amount;
                    }
                ],
                [
                    'attribute' => 'cr_amount',
                    'label' => 'Credit amount',
                    'content' => function($model){
                        return $model->cr_amount;
                    }
                ],
                [
                    'attribute' => 'net_amount',
                    'label' => 'Net amount',
                    'content' => function($model){
                        return $model->net_amount;
                    }
                ]
              ],
    ]);
        return $exporter->send('items.xlsx');
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
        if(($model = CummulativeBills::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Resource not found');
        }
    }
}
