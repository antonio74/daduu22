<?php

namespace common\models;

use Yii;
use common\models\Gruppicontatti;

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
class Newrubrica extends \yii\db\ActiveRecord
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


    /*
    * 
    */
    public function afterSave($insert, $changedAttributes)
    {
        $connection = \Yii::$app->db;
        // if not a new contact, delete all groups 
        if(!$insert){
            Gruppicontatti::deleteAll('id_contatto = :id', [ ':id' => $this->id ]);
        }

        $gruppi = $this->gruppi;
        $lenght = count($gruppi);
        $contatti = array_fill(0, $lenght, $this->id);
        $gruppicontatti= array_map(null, $contatti, $gruppi);
        $connection->createCommand()->batchInsert('gruppicontatti', ['id_contatto', 'id_gruppo'], $gruppicontatti )->execute();

    }



    public function stringaGruppi()
    {
        $nomiGruppi = Gruppo::getGruppi();
        $gruppi = "";
        foreach ($this->gruppi as $key => $idGruppo) {
            if ($gruppi!==""){
                $gruppi = $gruppi.", ";
            }
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
