<?php
namespace api\models;


class Gruppicontatti extends \common\models\Gruppicontatti
{
	public function fields()
	{
		//$fields=array();
		$fields[]='id';
		if(isset($_GET['expand'])){
			$expand=explode(', ', $_GET['expand']);
			if(count($expand)>1){
				if($expand[0]!='idContatto' && $expand[1]!='idContatto')
					$fields[]='id_contatto';
				if($expand[0]!='idGruppo' && $expand[1]!='idGruppo')
					$fields[]='id_gruppo';		
				return $fields;
			}
			else {
				if($expand[0]!='idContatto')
					$fields[]='id_contatto';
				if($expand[0]!='idGruppo')
					$fields[]='id_gruppo';		
				return $fields;
			}
		}
	
		return ['id', 'id_contatto', 'id_gruppo' ];
	}

    public function extraFields()
    {
        return ['idContatto', 'idGruppo'];
    }	
}