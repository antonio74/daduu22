<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "categoria".
 *
 * @property integer $id
 * @property string $nome
 * @property string $descrizione
 *
 * @property Newrubrica[] $newrubricas
 */
class Categoria extends TenantActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['descrizione'], 'string'],
            [['nome'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nome' => Yii::t('app', 'Nome'),
            'descrizione' => Yii::t('app', 'Descrizione'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewrubricas()
    {
        return $this->hasMany(Newrubrica::className(), ['id_categoria' => 'id']);
    }

     /**
     * @return an array with id and name of categories 
     */
    public static function getCategorie()
    {
        $queryCategorie = Categoria::find()->asArray()->all(); 
        $arrayCategorie = ArrayHelper::map($queryCategorie, 'id', 'nome'); 
        return $arrayCategorie;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTenant()
    {
        return $this->hasOne(Tenants::className(), ['id' => 'id_tenant']);
    }


}
