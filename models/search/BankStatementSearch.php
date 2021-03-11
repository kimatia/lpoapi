<?php

namespace app\models\search;

use app\models\BankStatement;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class BankStatementSearch extends BankStatement
{
    public function rules()
    {
        return [
            [['statement_id','serial_number','transaction_date','refference_no','payee','transaction_details','dr_amount','cr_amount','bank_balance','status','created_at','updated_at'], 'string'],
            [['statement_id','serial_number','transaction_date','refference_no','payee','transaction_details','dr_amount','cr_amount','bank_balance','status','created_at','updated_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = BankStatement::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'transaction_date' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'statement_id' => $this->statement_id,
        ]);

        $query->andFilterWhere(['like', 'statement_id', $this->statement_id])
                ->andFilterWhere(['like', 'serial_number', $this->serial_number])
                ->andFilterWhere(['like', 'transaction_date', $this->transaction_date])
                ->andFilterWhere(['like', 'refference_no', $this->refference_no])
                ->andFilterWhere(['like', 'payee', $this->payee])
                ->andFilterWhere(['like', 'transaction_details', $this->transaction_details])
                ->andFilterWhere(['like', 'dr_amount', $this->dr_amount])
                ->andFilterWhere(['like', 'cr_amount', $this->cr_amount])
                ->andFilterWhere(['like', 'bank_balance', $this->bank_balance])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andFilterWhere(['like', 'created_at', $this->created_at])
                ->andFilterWhere(['like', 'updated_at', $this->updated_at]);

        return $dataProvider;
    }
}
