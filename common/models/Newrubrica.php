<?php

namespace common\models;

use Yii;

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
    public $gruppi = array();

    public static function tableName()
    {
        return 'newrubrica';
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
    public function getIdCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'id_categoria']);
    }



    public function afterSave($insert)
    {
        $gruppi = $this->gruppi;
        $connection = \Yii::$app->db;
        // if not a new contact, delete all groups 
        if(!$insert){
            $sql = $connection->createCommand("DELETE FROM gruppicontatti WHERE id_contatto = $this->id")->execute();
        }
        foreach ($gruppi as $key => $gruppo) {
            $sql = $connection->createCommand()->insert('gruppicontatti', ['id_contatto' => $this->id, 'id_gruppo' => $gruppo])->execute();
        }
    }



    public function getCheckedGroups(){
        $connection = \Yii::$app->db;
        $id = $this->id;
        $sql = $connection->createCommand("SELECT id_gruppo FROM gruppicontatti WHERE id_contatto = $id")->queryColumn();
        return $sql;

    }

}
