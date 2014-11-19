<?php
namespace api\models;


class Newrubrica extends \common\models\Newrubrica 
{	

	/**
	 *
	 * @return ActiveQuery - Questa funzione  rappresenta una relazione  che restituisce i dettagli del 
	 *						 gruppo relativo ad un contatto attraverso la tabella pivot gruppicontatti.
	 */
	public function getGruppis()
    {
        return $this->hasMany(Gruppo::className(), ['id' => 'id_gruppo'])->via('gruppicontattis');
    }

    // Quando è impostato il parametro GET expand=categoria elimina il campo superfluo id_categoria
	public function fields()
	{
		$fields = parent::fields();
		if(isset($_GET['expand'])){
			$param=explode(',', $_GET['expand']);
			foreach ($param as $key => $field)
				if(trim($field) == 'categoria')
					unset($fields['id_categoria']);
		}		
		return $fields;
	}


	/**
	 * Esempio: http://host/newrubrica?expand=categoria, gruppis
	 * @return l'oggetto con cui è in relazione utilizzando le omonime funzioni del Model ( getCategoria, getGruppis )
	 */
    public function extraFields()
    {
        return ['categoria', 'gruppis'];
    }

}