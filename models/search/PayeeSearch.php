<?php

namespace app\models\search;

use app\models\Payee;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class PayeeSearch extends Payee
{
    public function rules()
    {
        return [
            [['id','payee','status','created_at','updated_at'], 'string'],
            [['id','payee','status','created_at','updated_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Payee::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
                ->andFilterWhere(['like', 'payee', $this->payee]);

        return $dataProvider;
    }
}
