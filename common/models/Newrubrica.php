<?php

namespace common\models;

use Yii;
use common\models\Gruppicontatti;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "newrubrica".
 *
 * @property integer $id
 * @property string $cognome
 * @property string $nome
 * @property string $mobile
 * @property string $email
 * @property integer $id_categoria
 *
 * @property Gruppicontatti[] $gruppicontattis
 * @property Categoria $idCategoria
 */
class Newrubrica extends TenantActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'newrubrica';
    }

    // Array of group's ids to which contact belong
    public $gruppi = array();


    /**
     * @inheritdoc
     */    
    public function afterFind()
    {
        //$newrubricas=$this->find()->where(['nome'=>'Antonio']);
        $this->gruppi = $this->getGruppiContattis()->select('id_gruppo')->column();
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cognome', 'nome', 'email', 'gruppi'], 'required'],
            [['id_categoria'], 'integer'],
            [['cognome', 'nome', 'mobile', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cognome' => Yii::t('app', 'Cognome'),
            'nome' => Yii::t('app', 'Nome'),
            'mobile' => Yii::t('app', 'Mobile'),
            'email' => Yii::t('app', 'Email'),
            'id_categoria' => Yii::t('app', 'Categoria'),
        ];
    }

    

    /**
     *
     * @return ActiveQuery - Questa funzione  rappresenta una relazione  che restituisce i dettagli del 
     *                       gruppo relativo ad un contatto attraverso la tabella pivot gruppicontatti.
     */
    public function getGruppis()
    {
        return $this->hasMany(Gruppo::className(), ['id' => 'id_gruppo'])->via('gruppicontattis');
    }

    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGruppicontattis()
    {
        return $this->hasMany(Gruppicontatti::className(), ['id_contatto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'id_categoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTenant()
    {
        return $this->hasOne(Tenants::className(), ['id' => 'id_tenant']);
    }

    /*
    * 
    */
    public function afterSave($insert, $changedAttributes)
    {
        $connection = \Yii::$app->db;
        $queryTuttiGruppi = $this->getGruppis()->asArray()->all();
        $arrayTuttiGruppi = ArrayHelper::map($queryTuttiGruppi, 'id', 'nome');        
        // if not a new contact, delete all groups 
        if(!$insert){
            Gruppicontatti::deleteAll('id_contatto = :id', [ ':id' => $this->id ]);
        }

        $gruppiSelezionati = $this->gruppi;
        $gruppiScrittura = Gruppo::getGruppi();
        // aggiunge i gruppi di cui fa parte il contatto e che non ho il permesso di modificare 
        foreach ($arrayTuttiGruppi as $key => $value) {
            if(!array_key_exists($key, $gruppiScrittura))
                array_push($gruppiSelezionati, $key);
        }
        $lenght = count($gruppiSelezionati);       
        $contatti = array_fill(0, $lenght, $this->id);
        $gruppicontatti= array_map(null, $contatti, $gruppiSelezionati);
        $connection->createCommand()->batchInsert('gruppicontatti', ['id_contatto', 'id_gruppo'], $gruppicontatti )->execute();

    }



    public function stringaGruppi()
    {
        $nomiGruppi = Gruppo::getAllGruppi();
        $gruppi = "";
        foreach ($this->gruppi as $key => $idGruppo) {
            if ($gruppi!==""){
                $gruppi = $gruppi.", ";
            }
            if(array_key_exists($idGruppo, $nomiGruppi))
                $gruppi = $gruppi.$nomiGruppi[$idGruppo];
        }
        return $gruppi;
    }




    /************************************ Eliminata: Trovata soluzione utilizzando getGruppiContattis
    public function getCheckedGroups(){
        $connection = \Yii::$app->db;
        $id = $this->id;
        $sql = $connection->createCommand("SELECT id_gruppo FROM gruppicontatti WHERE id_contatto = $id")->queryColumn();
        return $sql;

    }
    */

}
