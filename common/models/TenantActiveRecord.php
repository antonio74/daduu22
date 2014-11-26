<?php
 
namespace common\models;

use Yii;


class TenantActiveRecord extends \yii\db\ActiveRecord
{
 

    //saving model->id_tenant to all tables automatic
    public function beforeSave($insert)
    {
        $tenant = $this->getTenant();
        $this->id_tenant = Yii::$app->session['tenant'];
        return parent::beforeSave($insert);
    }
 
    /*  Filtro per tenant di competenza dell'utente utilizzando anche il nome
     *  della tabella per eliminare  ambiguità nelle join di newrubricaSearch
     */
	public static function find()
	{
    	return parent::find()->where([ parent::tableName().'.id_tenant' => Yii::$app->session['tenant']]);
	}


    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $tenant = $this->getTenant();
            if ($this->id_tenant == Yii::$app->session['tenant'])
                return true;
        }
        return false;
    }

 	public function getTenant()
 	{
 		return Yii::$app->session['tenant'];
 	}

 }