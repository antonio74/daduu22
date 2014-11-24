<?php
 
namespace common\models;

use Yii;


class TenantActiveRecord extends \yii\db\ActiveRecord
{
 

    //saving model->id_tenant to all tables automatic
    public function beforeSave($insert)
    {
        $tenant = $this->getTenant();
        $this->id_tenant = $tenant;
        return parent::beforeSave($insert);
    }
 

	public static function find()
	{
		//$tenant = $this->getTenant();
    	return parent::find()->where(['newrubrica.id_tenant' => Yii::$app->session['tenant']]);
	}



    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $tenant = $this->getTenant();
            if ($this->tenant == $tenant)
                return true;
        }
        return false;
    }


 	public function getTenant()
 	{
 		return Yii::$app->session['tenant'];
 	}

 }