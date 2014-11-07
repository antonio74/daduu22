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

	public function fields()
	{
		if(isset($_GET['expand']) && $_GET['expand']=='categoria'){
			return ['id', 'cognome', 'nome', 'mobile', 'email' ];
		}
		else {
			return ['id', 'cognome', 'nome', 'mobile', 'email', 'id_categoria' ];
		}
	}


	/**
	 * Esempio: http://host/newrubrica?expand=categoria, gruppis
	 * @return l'oggetto con cui è in relazione utilizzando l'omonima funzione del Model ( getCategoria, getGruppi )
	 */
    public function extraFields()
    {
        return ['categoria', 'gruppis'];
    }

}