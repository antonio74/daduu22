<?php
namespace frontend\models;

use common\models\User;
use common\models\Usersgroups;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $id_tenant;
    public $groups;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['id_tenant', 'safe'],
            ['groups', 'safe'],            
        ];
    }

    /**
     * Signs user up and store it in related tenant if is setted up or '1' by default.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            if($this->id_tenant != null)
                $user->id_tenant = $this->id_tenant;            
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();
            $group = new Usersgroups();
            $group->id_user = $user->id;
            $group->id_group = $this->groups;
            $group->save();
            return $user;
        }

        return null;
    }
}
