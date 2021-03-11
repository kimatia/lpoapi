<?php

namespace app\models;

use yii\db\ActiveRecord;

class BankStatement extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%bank_statement}}';
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
            [['statement_id','serial_number','transaction_date','refference_no','payee','transaction_details','dr_amount','cr_amount','bank_balance','status','created_at','updated_at'], 'required'],
            ['statement_id', 'string', 'max' => 50],
            ['serial_number', 'string', 'max' => 50],
            ['transaction_date', 'string', 'max' => 50],
            ['refference_no','string','max' => 50],
            ['payee','string','max' => 50],
            ['transaction_details','string','max' => 50],
            ['dr_amount','string','max' => 50],
            ['cr_amount', 'string', 'max' => 50],  
            ['bank_balance', 'string', 'max' => 50],
            ['status','string','max' => 50],
            ['created_at', 'string', 'max' => 50],  
            ['updated_at', 'string', 'max' => 50],
            ['created_by', 'string', 'max' => 50],
        ];
    }
}