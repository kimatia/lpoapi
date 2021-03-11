<?php

namespace app\models\search;

use app\models\CummulativeBills;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CummulativeBillsSearch extends CummulativeBills
{
    public function rules()
    {
        return [
            [['bills_id','payee','category','work_details','lpo_number','plo_sum','invoice_number','date_recorded','start_date','end_date','completion_status','cumulative_amount_invoiced','amount_paid','outstanding_amount','verified','comments','support_documents','bills','status','created_at','updated_at'], 'string'],
            [['bills_id','payee','category','work_details','lpo_number','plo_sum','invoice_number','date_recorded','start_date','end_date','completion_status','cumulative_amount_invoiced','amount_paid','outstanding_amount','verified','comments','support_documents','bills','status','created_at','updated_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CummulativeBills::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'payee' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'bills_id' => $this->bills_id,
        ]);

        $query->andFilterWhere(['like', 'bills_id', $this->bills_id])
                ->andFilterWhere(['like', 'payee', $this->payee])
                ->andFilterWhere(['like', 'category', $this->category])
                ->andFilterWhere(['like', 'work_details', $this->work_details])
                ->andFilterWhere(['like', 'lpo_number', $this->lpo_number])
                ->andFilterWhere(['like', 'plo_sum', $this->plo_sum])
                ->andFilterWhere(['like', 'invoice_number', $this->invoice_number])
                ->andFilterWhere(['like', 'date_recorded', $this->date_recorded])
                ->andFilterWhere(['like', 'start_date', $this->start_date])
                ->andFilterWhere(['like', 'end_date', $this->end_date])
                ->andFilterWhere(['like', 'completion_status', $this->completion_status])
                ->andFilterWhere(['like', 'cumulative_amount_invoiced', $this->cumulative_amount_invoiced])
                ->andFilterWhere(['like', 'amount_paid', $this->amount_paid])
                ->andFilterWhere(['like', 'outstanding_amount', $this->outstanding_amount])
                ->andFilterWhere(['like', 'verified', $this->verified])
                ->andFilterWhere(['like', 'comments', $this->comments])
                ->andFilterWhere(['like', 'support_documents', $this->support_documents])
                ->andFilterWhere(['like', 'completion_status', $this->completion_status])
                ->andFilterWhere(['like', 'bills', $this->bills])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andFilterWhere(['like', 'created_at', $this->created_at])
                ->andFilterWhere(['like', 'updated_at', $this->updated_at]);

        return $dataProvider;
    }
}
