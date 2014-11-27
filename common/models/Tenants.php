<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tenants".
 *
 * @property integer $id
 * @property string $nome
 *
 * @property Categoria[] $categorias
 * @property Gruppo[] $gruppos
 * @property Newrubrica[] $newrubricas
 * @property User[] $users
 */
class Tenants extends \yii\db\ActiveRecord
{


    public $tenantUsers = array();


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tenants';
    }


    /**
     * @inheritdoc
     */    
    public function afterFind()
    {
        //$newrubricas=$this->find()->where(['nome'=>'Antonio']);
        $this->tenantUsers = $this->getUsers()->select('id')->column();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 255],
            [['tenantUsers'], 'safe']
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategorias()
    {
        return $this->hasMany(Categoria::className(), ['id_tenant' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGruppos()
    {
        return $this->hasMany(Gruppo::className(), ['id_tenant' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewrubricas()
    {
        return $this->hasMany(Newrubrica::className(), ['id_tenant' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id_tenant' => 'id']);
    }


    /**
     * Generate the first user when create a tenant
     * @return 
     */
    public function afterSave($insert, $changedAttributes)
    {
        $connection = \Yii::$app->db;
        // if not a new contact, delete all groups 
        /*if(!$insert){
            Gruppicontatti::deleteAll('id_contatto = :id', [ ':id' => $this->id ]);
        }*/

        $tenantUsers = $this->tenantUsers;

        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@libero.it';
        $user->id_tenant = $this->id;
        $user->setPassword('admin');
        $user->generateAuthKey();
        $user->save();

        /*if($tenantUsers != null){
            foreach ($tenantUsers as $value) {
                $u = User::findOne($value);
                $u->id_tenant = $this->id;
                $u->update();
            }
        }*/

    }


    /** 
     * Generate the usernames string of the current tenant
     */
    public function usernamesToString()
    {
        $users = User::getUsers();
        $usernames = "";
        foreach ($this->tenantUsers as $key => $idUser) {
            if ($usernames !== ""){
                $usernames = $usernames.", ";
            }
            $usernames = $usernames.$users[$idUser];
        }
        return $usernames;
    }
}
