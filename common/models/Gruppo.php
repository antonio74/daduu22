<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "gruppo".
 *
 * @property integer $id
 * @property string $nome
 * @property string $descrizione
 *
 * @property Gruppicontatti[] $gruppicontattis
 */
class Gruppo extends TenantActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gruppo';
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
    public function getGruppicontattis()
    {
        return $this->hasMany(Gruppicontatti::className(), ['id_gruppo' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTenant()
    {
        return $this->hasOne(Tenants::className(), ['id' => 'id_tenant']);
    }

    /**
     * @return array of group's names
     */    
    public static function getGruppi()
    {
        $queryGruppi = Gruppo::find()->asArray()->all(); 
        $arrayGruppi = ArrayHelper::map($queryGruppi, 'id', 'nome');
        return $arrayGruppi;
    }


}
