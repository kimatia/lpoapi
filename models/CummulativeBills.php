<?php

namespace app\models;

use yii\db\ActiveRecord;

class CummulativeBills extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%pending_bills}}';
    }
     public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ]; 
    }

    public function rules()
    {
        return [
            [['bills_id','payee','category','work_details','lpo_number','plo_sum','invoice_number','date_recorded','start_date','end_date','completion_status','cumulative_amount_invoiced','amount_paid','outstanding_amount','verified','comments','support_documents','bills','status','created_at','updated_at'], 'required'],
            ['bills_id', 'string', 'max' => 50],
            ['payee', 'string', 'max' => 50],
            ['category', 'string', 'max' => 50],
            ['work_details','string','max' => 50],
            ['lpo_number','string','max' => 50],
            ['plo_sum','string','max' => 50],
            ['invoice_number','string','max' => 50],
            ['date_recorded', 'string', 'max' => 50],  
            ['start_date', 'string', 'max' => 50],
            ['end_date', 'string', 'max' => 50],
            ['completion_status', 'string', 'max' => 50],
            ['cumulative_amount_invoiced', 'string', 'max' => 50],
            ['amount_paid', 'string', 'max' => 50],
            ['outstanding_amount','string','max' => 50],
            ['verified','string','max' => 50],
            ['comments','string','max' => 50],
            ['support_documents','string','max' => 50],
            ['bills','file'],
            ['status','string','max' => 50],
            ['created_at', 'string', 'max' => 50],  
            ['updated_at', 'string', 'max' => 50],
            ['created_by', 'string', 'max' => 50],
        ];
    }
}