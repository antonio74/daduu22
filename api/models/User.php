<?php
namespace api\models;


class User extends \common\models\User 
{
	public function rules()
    {
        return [

        	['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\api\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
           
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\api\models\User', 'message' => 'This email address has already been taken.']
            
        ];
    }

}