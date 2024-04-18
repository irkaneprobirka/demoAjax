<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $full_name
 * @property string $login
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property int $role_id
 * @property string $auth_key
 *
 * @property Application[] $applications
 * @property Role $role
 */
class RegisterForm extends Model
{

    public string $full_name = '';
    public string $login = '';
    public string $email = '';
    public string $phone = '';
    public string $password = '';
    public string $password_repeat = '';
    public bool $rules = false;

    public function rules()
    {
        return [
            [['full_name', 'login', 'email', 'phone', 'password', 'password_repeat'], 'required'],
            [['full_name', 'login', 'email', 'phone', 'password'], 'string', 'max' => 255],
            [['login'], 'unique', 'targetClass' => User::class],
            ['login', 'match', 'pattern' => '/^[a-zA-Z0-9\-]+$/'],
            ['password', 'match', 'pattern' => '/^[a-zA-Z0-9]+$/'],
            ['full_name', 'match', 'pattern' => '/^[а-яёА-ЯЁ\s\-]+$/u'],
            ['phone', 'match', 'pattern' => '/^\+7\(\d{3}\)\-\d{3}(\-\d{2}){2}$/'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['password', 'string', 'min' => 8], 
            ['rules', 'required', 'requiredValue' => 1, 'message' => 'Соглашение с правилами - должно быть отмечено'],
            ['email', 'email']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'ФИО',
            'login' => 'Логин',
            'email' => 'Email',
            'phone' => 'Телефон',
            'password' => 'Пароль',
            'password_repeat' => 'Повтор пароля',
            'rules' => 'Соглашение с правилами',
            'auth_key' => 'Auth Key',
        ];
    }

    public function registerUser()
    {
        if ($this->validate()) {
            $user = new User();
            $user->attributes = $this->attributes;
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->role_id = 2;

            if (!$user->save()) {
                return VarDumper::dump($user->errors, 10, true);
                die;
            }
        }

        return $user ?? false;
    }
}
