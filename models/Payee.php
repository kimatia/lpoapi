<?php

namespace app\models;

use yii\db\ActiveRecord;

class Payee extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%payee}}';
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
            [['id','payee','status','created_at','updated_at'], 'required'],
            ['id', 'string', 'max' => 50],
            ['payee', 'string', 'max' => 50],
            ['status','string','max' => 50],
            ['created_at', 'string', 'max' => 50],  
            ['updated_at', 'string', 'max' => 50],
            ['created_by', 'string', 'max' => 50],
        ];
    }
}