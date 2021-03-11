<?php
namespace app\models;
use Yii;
use app\models\User;
use yii\base\Model;
class Authorize extends Model
{

public $password;
public $authorization_status;
public $id;



public function rules()
    {
        return [

            [['password','authorization_status','id'], 'required'],
            [['password'], 'string'],
            [['password'],'validatePassword']
        	
        ];
    }

public function validatePassword()
    {
        /* @var $user User */
        $user = Yii::$app->user->identity;
        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError('password', 'The password you provided is incorrect.');
        }
    }
public function attributeLabels()
    {
        return [
            'password' => 'Password',
            'authorization_status' => 'Approval status',
            
        ];
    }




}
 