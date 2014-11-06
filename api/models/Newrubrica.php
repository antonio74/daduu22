<?php
namespace api\models;


class Newrubrica extends \common\models\Newrubrica 
{	

	public function fields()
	{
		if(isset($_GET['expand']) && $_GET['expand']=='categoria'){
			return ['id', 'cognome', 'nome', 'mobile', 'email' ];
		}
		else {
			return ['id', 'cognome', 'nome', 'mobile', 'email', 'id_categoria' ];
		}
	}


    public function extraFields()
    {
        return ['categoria'];
    }

}