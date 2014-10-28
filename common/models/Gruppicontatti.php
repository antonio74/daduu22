<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gruppicontatti".
 *
 * @property integer $id
 * @property integer $id_contatto
 * @property integer $id_gruppo
 *
 * @property Gruppo $idGruppo
 * @property Newrubrica $idContatto
 */
class Gruppicontatti extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gruppicontatti';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_contatto', 'id_gruppo'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_contatto' => Yii::t('app', 'Id Contatto'),
            'id_gruppo' => Yii::t('app', 'Id Gruppo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGruppo()
    {
        return $this->hasOne(Gruppo::className(), ['id' => 'id_gruppo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdContatto()
    {
        return $this->hasOne(Newrubrica::className(), ['id' => 'id_contatto']);
    }
}
