<?php
namespace api\models;


class Newrubrica extends \common\models\Newrubrica 
{

	public function fields()
{
    return ['id', 'cognome'];
}
	public function extraFields()
{
    return ['categoria'];
}

}