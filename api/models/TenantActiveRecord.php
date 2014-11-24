<?php
 
class TenantActiveRecord extends ActiveRecord
{
 

    //saving model->id_tenant to all tables automatic
    public function beforeSave()
    {
        $tenant = $this->getTenant();
        $this->id_tenant = $tenant;
        return parent::beforeSave();
    }
 

 	public function getTenant()
 	{
 		return Yii::$app->session['tenant'];
 	}


 }