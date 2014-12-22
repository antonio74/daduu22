<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "groups".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property Usersgroups[] $usersgroups
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersgroups()
    {
        return $this->hasMany(Usersgroups::className(), ['id_group' => 'id']);
    }


    public static function getGroups()
    {
        $queryGruppi = Groups::find()->asArray()->all(); 
        $arrayGruppi = ArrayHelper::map($queryGruppi, 'id', 'name');
        return $arrayGruppi;
    }
}
